<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $primaryKey = 'invoice_id';
    protected $fillable = ['invoice_number','customer_id','project_id','invoice_gst_rate','invoice_final_cost','invoice_date','invoice_status','invoice_copy_type','invoice_payment_terms','invoice_billing_address', 'invoice_comments'];
}
