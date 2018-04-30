<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomInvoice;
use App\CustomInvoiceItem;
use Session;
use DB;

class CustomInvoiceController extends Controller
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
        $page_title = 'Custom invoice';
        $page_description = 'Custom invoice listing';
        $unique_invoice = CustomInvoice::all();
        $custom_invoices = DB::table('custom_invoices as ci')
                            ->leftJoin('custom_invoice_items as cii', 'cii.custom_invoice_number', '=', 'ci.custom_invoice_number')
                            ->get();
        
        $custom_invoice_number = CustomInvoice::max('custom_invoice_number');

        if($custom_invoice_number == null){
            $custom_invoice_number = "1001";
        
        }else{
            $custom_invoice_number = $custom_invoice_number + 1;
        }

        return view('invoice.custom', compact('page_title', 'page_description', 'custom_invoices', 'unique_invoice', 'custom_invoice_number'));
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
        $page_title = 'Custom invoice';
        $page_description = 'Custom invoice listing';

        $custom_invoice_number = CustomInvoice::max('custom_invoice_number');
        
        if($custom_invoice_number == null){
            $custom_invoice_number = "1001";
        
        }else{
            $custom_invoice_number = $custom_invoice_number + 1;
        }

        $total_amount = 0;

        for ($item=0; $item <count($request->product_cost) ; $item++) { 
            $total_amount = $total_amount + $request->product_cost[$item];
        }

        $custom_invoice = new CustomInvoice();
        $custom_invoice->custom_invoice_number = $custom_invoice_number;
        $custom_invoice->custom_customer_name = $request->custom_customer_name;
        $custom_invoice->custom_customer_address = $request->custom_customer_address;
        $custom_invoice->custom_invoice_amount = $total_amount;
        $custom_invoice->save();
        
        for ($item=0; $item <count($request->product_name) ; $item++) { 
            $custom_invoice_item = new CustomInvoiceItem();
            $custom_invoice_item->custom_invoice_number = $custom_invoice_number;    
            $custom_invoice_item->custom_invoice_product_name = $request->product_name[$item];
            $custom_invoice_item->custom_invoice_product_quantity = $request->product_quantity[$item];
            $custom_invoice_item->custom_invoice_product_cost = $request->product_cost[$item];
            $custom_invoice_item->save();
        }

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
        //
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
        $custom_invoice = CustomInvoice::find($id);
        $custom_invoice_items = CustomInvoiceItem::where('custom_invoice_number', '=', $custom_invoice->custom_invoice_number)->get();
        $custom_invoice_items->delete();
        $custom_invoice->delete();

        Session::flash('deleted', 'Deleted successfully.');
        return redirect()->route('custom-invoice.index');
    }
}
