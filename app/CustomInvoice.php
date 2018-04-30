<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomInvoice extends Model
{
    protected $table = 'custom_invoices';
    protected $primaryKey = 'custom_invoice_id';
    protected $fillable = ['custom_invoice_number','custom_customer_name','custom_customer_address'];
}
