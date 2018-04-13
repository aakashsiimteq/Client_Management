<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $page_title = 'Customer';
      $page_description = 'View Customer';
      $customers = Customer::all();
      return view('customer.index',compact('page_title','page_description', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Customer';
        $page_description = 'Create customer';
        return view('customer.create',compact('page_title','page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->customer_type = $request->customer_type;
        $customer->customer_abn_no = $request->customer_abn_no;
        $customer->customer_email = $request->customer_email;
        $customer->customer_contact_no = $request->customer_contact_no;
        $customer->customer_physical_address = $request->customer_physical_address;
        $customer->customer_billing_address = $request->customer_billing_address;
        $customer->save();

        Session::flash('success', 'Registered successfully!');

        return redirect()->route('customer.index');

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
