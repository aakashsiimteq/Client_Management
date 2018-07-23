<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
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
      $page_title = 'Customer';
      $page_description = 'Customer listing';
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
        $cust_no = Customer::max('customer_number');
                        
        if($cust_no == NULL){
            $cust_no = "101";
        
        }else{
            $cust_no = $cust_no + 1;
        }
        return view('customer.create',compact('page_title','page_description','cust_no'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existingEmail = Customer::where('customer_email', '=', $request->customer_email)->first();

        if(empty($existingEmail) == false) {
            Session::flash('exists', "Could not register successfully! $request->customer_email is already exists.");
            return redirect()->back();
        } else {
            $customer = new Customer();
            $customer->customer_number = $request->customer_no;
            $customer->customer_name = $request->customer_name;
            $customer->customer_type = $request->customer_type;
            $customer->customer_abn_no = $request->customer_abn_no;
            $customer->customer_email = $request->customer_email;
            $customer->customer_contact_no = $request->customer_contact_no;
            $customer->customer_physical_address = $request->customer_physical_address;
            $customer->customer_billing_address = $request->customer_billing_address;
            $customer->save();

            Session::flash('registered', 'Registered successfully!');

            return redirect()->route('customer.index');
        }
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
        $page_title = 'Customer';
        $page_description = 'Edit customer';
        $customer = Customer::find($id);
        return view('customer.edit_customer', compact('page_title','page_description'))->withCustomer($customer);
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
        $customer = Customer::find($id);
        $customer->customer_number = $request->customer_no;
        $customer->customer_name = $request->customer_name;
        $customer->customer_type = $request->customer_type;
        $customer->customer_abn_no = $request->customer_abn_no;
        $customer->customer_email = $request->customer_email;
        $customer->customer_contact_no = $request->customer_contact_no;
        $customer->customer_physical_address = $request->customer_physical_address;
        $customer->customer_billing_address = $request->customer_billing_address;
        $customer->save();

        Session::flash('updated', 'Updated successfully!');

        return redirect()->route('customer.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        Session::flash('deleted', 'Deleted successfully!');

        return redirect()->route('customer.index');
    }
}
