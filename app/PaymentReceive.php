<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentReceive extends Model
{
    protected $table = 'payment_receives';
    protected $primaryKey = 'payment_id';
    public $timestamps = true;

    protected $fillable = [
        'customer_id', 'project_id', 'invoice_id',
        'invoice_final_amount', 'invoice_paid_amount',
        'invoice_due_amount', 'last_amount_paid_on'
    ];

    protected $hidden = [];
}
