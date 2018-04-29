<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Project;
use App\Customer;
use Session;
use DB;

class InvoiceController extends Controller
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
        $page_title = 'Invoice';
        $page_description = 'Invoice listing';
        $invoices = DB::table('invoices')
                    ->leftJoin('customers', 'customers.customer_number', '=', 'invoices.customer_id')
                    ->leftJoin('projects', 'projects.project_number', '=', 'invoices.project_id')
                    ->get();
        return view('invoice.index', compact('invoices', 'page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Invoice';
        $page_description = 'Make Invoice';
        return view('invoice.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $page_description = 'Edit invoice';
        $invoice = Invoice::find($id);
        $project = Project::where('project_number', '=', $invoice->project_id);
        $customer = Customer::where('customer_number', '=', $invoice->customer_id);
        $customer_invoice = DB::table('invoices')
                     ->leftJoin('projects', 'projects.project_number', '=', 'invoices.project_id')
                     ->leftJoin('customers', 'customers.customer_number', '=', 'invoices.customer_id')
                     ->where('invoice_id', '=', $id)
                     ->first();
        return view('invoice.edit', compact('customer_invoice', 'invoice'));
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
        $invoice = Invoice::find($id);
        $invoice->invoice_gst_rate = $request->invoice_gst_rate;
        $invoice->invoice_reference = $request->invoice_reference;
        $invoice->invoice_comments = $request->invoice_comments;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->invoice_billing_address = $request->invoice_billing_address;
        $invoice->invoice_copy_type = $request->invoice_copy_type;
        $invoice->invoice_final_cost = $request->invoice_grand_total;
        $invoice->save();

        Session::flash('updated', 'Invoice updated successfully');
        return redirect()->route('invoice.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();
        Session::flash('invoice_deleted', 'Invoice deleted successfully');
        return redirect()->route('invoice.index');
    }
}
