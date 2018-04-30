<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomInvoiceItem extends Model
{
    protected $table = 'custom_invoice_items';
    protected $primaryKey = 'custom_invoice_item_id';
    protected $fillable = ['custom_invoice_number','custom_invoice_product_name','custom_invoice_product_quantity','custom_invoice_product_cost'];
}
