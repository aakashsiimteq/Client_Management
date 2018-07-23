<?php

namespace App\Http\Controllers;

use App\Http\Managers\CustomInvoiceManager;
use Illuminate\Http\Request;
use App\CustomInvoice;
use App\CustomInvoiceItem;
use Session;
use DB;

class CustomInvoiceController extends Controller
{
    private $customInvoicemanager;
    public function __construct(CustomInvoiceManager $customInvoiceManager)
    {
        $this->middleware('auth');
        $this->customInvoicemanager = $customInvoiceManager;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Custom invoice';
        $page_description = 'Custom invoice listing';

        $custom_invoices = CustomInvoice::all()->where('invoice_status', '=', 'Open');

        return view('invoice.custom', compact('page_title', 'page_description', 'custom_invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Custom Invoice';
        $page_description = 'Make custom invoice';

        $custom_invoice_number = CustomInvoice::max('custom_invoice_number');
        if($custom_invoice_number == null){
            $custom_invoice_number = "CINV1001";
        }else{
            $custom_invoice_number = (int)(substr($custom_invoice_number,4));
            $custom_invoice_number = $custom_invoice_number + 1;
            $custom_invoice_number = "CINV".$custom_invoice_number;

        }

        return view('invoice.custom-create', compact('page_title', 'page_description', 'custom_invoice_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page_title = 'Custom invoice';
        $page_description = 'Custom invoice listing';

        //dd($request->all());

        $custom_invoice = new CustomInvoice();
        $custom_invoice->custom_customer_name = $request->custom_customer_name;
        $custom_invoice->custom_invoice_number = $request->custom_invoice_number;
        $custom_invoice->project_type = $request->project_type;
        $custom_invoice->project_title = $request->project_title;
        $custom_invoice->project_per_hour_cost = $request->project_per_hour_cost;
        $custom_invoice->project_estimate_cost = $request->project_estimate_cost;
        $custom_invoice->project_final_cost = $request->project_final_cost;
        $custom_invoice->invoice_reference = $request->invoice_reference;
        $custom_invoice->invoice_total_amount = $request->invoice_total_amount;
        $custom_invoice->invoice_grand_total = $request->invoice_grand_total;
        $custom_invoice->invoice_date = $request->invoice_date;
        $custom_invoice->invoice_paid_amount = 0;
        $custom_invoice->invoice_unpaid_amount = $request->invoice_grand_total;
        $custom_invoice->invoice_copy_type = $request->invoice_copy_type;
        $custom_invoice->invoice_billing_address = $request->invoice_billing_address;
        $custom_invoice->project_desc = $request->project_desc;
        $custom_invoice->invoice_comments = $request->invoice_comments;
        $custom_invoice->save();

        Session::flash('invoiced', 'Successfully invoiced');
        return redirect()->route('custom-invoice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Custom invoice';
        $page_description = 'Edit Custom invoice';
        $custom_invoice = CustomInvoice::find($id);
        return view('invoice.custom-edit', compact('custom_invoice', 'page_title', 'page_description'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_type = $request->get('update_type');
        $custom_invoice_id = $request->get('custom_invoice_id');
        $custom_invoice_status = $request->get('invoice_status');
        if($update_type == 'from_invoice_index') {
            $c_invoice = CustomInvoice::find($custom_invoice_id);
            $c_invoice->invoice_status = $custom_invoice_status;
            $c_invoice->save();
        } else {
            $custom_invoice = CustomInvoice::find($id);
            $custom_invoice->custom_customer_name = $request->custom_customer_name;
            $custom_invoice->custom_invoice_number = $request->custom_invoice_number;
            $custom_invoice->project_type = $request->project_type;
            $custom_invoice->project_title = $request->project_title;
            $custom_invoice->project_per_hour_cost = $request->project_per_hour_cost;
            $custom_invoice->project_estimate_cost = $request->project_estimate_cost;
            $custom_invoice->project_final_cost = $request->project_final_cost;
            $custom_invoice->invoice_reference = $request->invoice_reference;
            $custom_invoice->invoice_total_amount = $request->invoice_total_amount;
            $custom_invoice->invoice_grand_total = $request->invoice_grand_total;
            $custom_invoice->invoice_date = $request->invoice_date;
            $custom_invoice->invoice_paid_amount = 0;
            $custom_invoice->invoice_unpaid_amount = $request->invoice_grand_total;
            $custom_invoice->invoice_copy_type = $request->invoice_copy_type;
            $custom_invoice->invoice_billing_address = $request->invoice_billing_address;
            $custom_invoice->project_desc = $request->project_desc;
            $custom_invoice->invoice_comments = $request->invoice_comments;
            $custom_invoice->save();
        }
        Session::flash('invoiced', 'Successfully updated');
        return redirect()->route('custom-invoice.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $custom_invoice = CustomInvoice::find($id);
        $custom_invoice->delete();

        Session::flash('deleted', 'Deleted successfully.');
        return redirect()->route('custom-invoice.index');
    }
}
