<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Project;
use App\Customer;
use App\CustomInvoice;
use Session;
use DB;
use PDF;

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

        $invoice_number = Invoice::max('invoice_number');

        if($invoice_number == null){
            $invoice_number = "INV101";
        
        }else{
            $invoice_number = (int)(substr($invoice_number,3));
            $invoice_number = $invoice_number + 1;
            $invoice_number = "INV".$invoice_number;
        }

        $custom_invoice_number = CustomInvoice::max('custom_invoice_number');
        
        if($custom_invoice_number == null){
            $custom_invoice_number = "CINV1001";
        
        }else{
            $custom_invoice_number = (int)(substr($custom_invoice_number, 4));
            $custom_invoice_number = $custom_invoice_number + 1;
            $custom_invoice_number = "CINV".$custom_invoice_number;
        }

        $invoices = DB::table('invoices')
                    ->leftJoin('customers', 'customers.customer_number', '=', 'invoices.customer_id')
                    ->leftJoin('projects', 'projects.project_number', '=', 'invoices.project_id')
                    ->where('invoice_status', '=', 'Open')
                    ->get();
        return view('invoice.index', compact('invoices', 'page_title', 'page_description', 'invoice_number', 'custom_invoice_number'));
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
        return view('invoice.edit', compact('customer_invoice', 'invoice', 'page_title', 'page_description'));
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
        $invoice->invoice_final_cost = $request->project_estimate_cost;
        $invoice->invoice_grand_total = $request->invoice_grand_total;
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

    public function getPrintView(Request $request)
    {
        $invoice_id = $request->invoice_id;
        // $invoice = Invoice::where('invoice_number','=',$invoice_id)->get();
        $invoice_data = DB::table('invoices')
                     ->leftJoin('projects', 'projects.project_number', '=', 'invoices.project_id')
                     ->leftJoin('customers', 'customers.customer_number', '=', 'invoices.customer_id')
                     ->where('invoice_number', '=', $invoice_id)
                     ->first();
        $view = view('invoice.print')->with('invoice_data',$invoice_data);
        return $view;
    }

    public function getInvoiceprint(Request $request) {
		$pdfName = "Invoice";
		$view = $this->getPrintView($request);
		if ($view != false) {
			$contents = $view->render();
			PDF::SetTitle('Siimteq Technologies Invoice');
			PDF::AddPage();
			PDF::writeHTML($contents);
			PDF::Output("$pdfName.pdf", 'I');
		} else {
			return "this is fails";
		}
	}
}
