<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\CustomInvoice;
use App\Invoice;
use App\Project;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = '';
        $page_description = '';
        $project_count = Project::get()->count();
        $invoice_count = Invoice::get()->count();
        $custom_invoice_count = CustomInvoice::get()->count();
        $customer_count = Customer::get()->count();
        return view('dashboard', compact('page_title', 'page_description', 'project_count', 'invoice_count', 'custom_invoice_count', 'customer_count'));
    }
}
