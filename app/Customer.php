<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';

    protected $fillable = ['customer_number','customer_name','customer_type','customer_abn_no','customer_email','customer_contact_no','customer_physical_address','customer_billing_address'];
}
