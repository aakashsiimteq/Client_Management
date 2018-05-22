<?php

namespace App\Http\Controllers;

use App\PaymentReceive;
use Illuminate\Http\Request;
use DB;

class PaymentReceiveController extends Controller
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
        $page_title = 'Payment Receive';
        $page_description = 'Accounts';

        $payments = DB::table('payment_receives as pr')
            ->leftJoin('customers as c', 'c.customer_number', '=', 'pr.customer_id')
            ->leftJoin('invoices as iv', 'iv.invoice_id', '=', 'pr.invoice_id')
            ->where('payment_status', '=', 'Pending')
            ->select(['customer_name', 'pr.payment_id','iv.invoice_id','invoice_number', 'invoice_grand_total','iv.created_at', 'invoice_paid_amount', 'invoice_due_amount'])
            ->get();
        return view('accounts.payrecv.index', compact('page_description', 'page_title', 'payments'));
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
        //
    }
}
