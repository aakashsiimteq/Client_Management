<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Customer;
use App\Invoice;
use Session;
use DB;
class InvoiceForProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $page_title = 'Invoice';
        $page_description = 'Make Invoice';

        $invoice_number = Invoice::max('invoice_number');
                        
        if($invoice_number == null){
            $invoice_number = "1001";
        
        }else{
            $invoice_number = $invoice_number + 1;
        }

        $project = Project::find($id);
        $customer = Customer::where('customers.customer_number', '=', $project->customer_id)->first();
        $invoice = Invoice::where('project_id', '=', $project->project_number)->first();
        if(!empty($invoice)) {
            Session::flash('invoiced', "Invoice is already made. You can find here. The invoice id is $invoice->invoice_number");
            return redirect()->route('invoice.index');
        } else {
            $new_invoice = new Invoice();
            $new_invoice->invoice_number = $invoice_number;
            $new_invoice->customer_id = $customer->customer_number;
            $new_invoice->project_id = $project->project_number;
            $new_invoice->invoice_final_cost = $project->project_estimate_cost;
            $final_cost = ($project->project_estimate_cost * 10);
            $gst_amount = $final_cost / 100;
            $new_invoice->invoice_grand_total = $project->project_estimate_cost + $gst_amount;
            $new_invoice->invoice_gst_rate = 10;
            $new_invoice->invoice_status = 'Open';
            $new_invoice->invoice_date = date('Y/m/d');
            $new_invoice->invoice_billing_address = $customer->customer_billing_address;
            $new_invoice->save();

            $customer_invoice = DB::table('invoices')
                                ->leftJoin('customers', 'customers.customer_number', '=', 'invoices.customer_id')
                                ->leftJoin('projects', 'projects.project_number', '=', 'invoices.project_id')
                                ->where('invoices.invoice_id', '=', $new_invoice->invoice_id)
                                ->first();
            $invoice = Invoice::find($customer_invoice->invoice_id);
        return view('invoice.create', compact('page_title', 'page_description', 'customer_invoice', 'invoice'));
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
