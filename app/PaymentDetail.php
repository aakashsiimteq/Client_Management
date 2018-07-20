<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    protected $table = 'payment_details';
    protected $primaryKey = 'payment_details_id';
    public $timestamps = true;

    protected $fillable = [
      'customer_id', 'project_id', 'project_final_amount',
      'project_paid_amount', 'project_due_amount',
      'last_amount_paid_on', 'payment_status', 'payment_method', 'payment_comment'
    ];

    protected $hidden = [];
}
