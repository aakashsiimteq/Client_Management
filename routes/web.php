<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/items', function () {
    return view('invoice.items');
});
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::resource('customer', 'CustomerController');
Route::resource('project', 'ProjectController');
Route::resource('invoice', 'InvoiceController');
Route::resource('customer-project', 'ProjectForCustomerController');
Route::resource('project-invoice', 'InvoiceForProjectController');
Route::resource('custom-invoice', 'CustomInvoiceController');
Route::get('print','InvoiceController@getPrintView');

