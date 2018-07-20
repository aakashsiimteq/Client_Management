<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/items', function () {
    return view('invoice.items');
});
Auth::routes();
Route::get('/dashboard', 'HomeController@index')->name('home');
Route::prefix('admin')->group(function () {
    Route::resource('customer', 'CustomerController');
    Route::resource('project', 'ProjectController');
    Route::resource('invoice', 'InvoiceController');
    Route::resource('customer-project', 'ProjectForCustomerController');
    Route::resource('project-invoice', 'InvoiceForProjectController');
    Route::resource('custom-invoice', 'CustomInvoiceController');
    Route::resource('payment-receive', 'PaymentReceiveController');
    Route::get('print','InvoiceController@getPrintView');
});


