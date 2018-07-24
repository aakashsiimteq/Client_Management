<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Managers\PaymentReceiveManager;
use App\Invoice;
use App\PaymentDetail;
use App\PaymentReceive;
use App\SearchParamPaymentReceive;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class PaymentReceiveController extends Controller
{
    private $prcvManager;
    public function __construct(PaymentReceiveManager $paymentReceiveManager)
    {
        $this->middleware('auth');
        $this->prcvManager = $paymentReceiveManager;
    }

    public function index(Request $request)
    {
        $page_title = 'Payment Receive';
        $page_description = 'Accounts';
        $search_command = $request->get('search');
        $customers = Customer::all();
        $lookupcustomers = array();
        foreach ($customers as $k => $v) {
            $lookupcustomers[$v->customer_number] = $v->customer_name;
        }
        $invoices = null;
        if($search_command == 'command_search') {
            $invoices = $this->prcvManager::getBaseQuery();
            $prepareSearch = new SearchParamPaymentReceive();
            $prepareSearch->fill($request->all());
            $preparedSearch = $prepareSearch::prepareSearch($invoices, $prepareSearch);
            $invoices = $preparedSearch->select(['customer_name', 'payment_receives.payment_id','iv.invoice_id','invoice_number', 'invoice_grand_total','iv.created_at', 'invoice_paid_amount', 'invoice_due_amount'])->get();
        }
        return view('accounts.payrecv.index', compact('page_description', 'page_title', 'invoices', 'lookupcustomers'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $date = $request->get('date');
        $res = false;
        $invoices = $request->get('inv_amount');
        $invoice_ids = array_keys($invoices);

        $invs = Invoice::whereIn('invoice_id', $invoice_ids)->get();

        foreach ($invs as $inv) {
            $received_amount = $request->get("invoice_$inv->invoice_id");
            if ($inv->invoice_grand_total < floatval($received_amount)) {
                Session::flash('grater_received', 'Received amount should not be grater than invoiced amount!');
                return redirect()->back();
            }
            $payment = PaymentReceive::with([])
                ->where('project_id', $inv->project_id)->first();
            $payment->invoice_paid_amount = $payment->invoice_paid_amount + floatval($received_amount);
            $payment->invoice_due_amount = $payment->invoice_due_amount -  floatval($received_amount);
            if($payment->invoice_due_amount == 0) {
                $payment->payment_status = 'Complete';
            }
            $res = $payment->save();

            $paymentDetails = new PaymentDetail();
            $paymentDetails->customer_id = $inv->customer_id;
            $paymentDetails->project_id = $inv->project_id;
            $paymentDetails->project_final_amount = $inv->invoice_grand_total;
            $paymentDetails->project_paid_amount = floatval($received_amount);
            $paymentDetails->project_due_amount = $payment->invoice_due_amount;
            $paymentDetails->payment_method = $request->get('paymentmethod');
            $paymentDetails->payment_comment = $request->get('comments');
            if($date == null) {
                $paymentDetails->last_amount_paid_on = date('Y-m-d');
            } else {
                $paymentDetails->last_amount_paid_on = Carbon::parse($date)->format('Y-m-d');
            }
            if($paymentDetails->project_due_amount == 0) {
                $paymentDetails->payment_status = 'Complete';
            }
            $res = $paymentDetails->save();

            if($payment->payment_status == 'Complete') {
                $inv->invoice_status = 'Close';
                $res = $inv->save();
            }

        }
        if($res == true) {
            Session::flash('received', 'Payment received successfully!');
        } else {
            Session::flash('not_received', 'Payment could not received successfully!');
        }
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
