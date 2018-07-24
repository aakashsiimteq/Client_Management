<?php

namespace App\Http\Managers;


use App\PaymentReceive;

class PaymentReceiveManager
{
    public static function getBaseQuery() {
        $qry = PaymentReceive::with([])
            ->leftJoin('customers as c', 'c.customer_number', '=', 'payment_receives.customer_id')
            ->leftJoin('invoices as iv', 'iv.invoice_id', '=', 'payment_receives.invoice_id')
            ->where('payment_status', '=', 'Pending');
        return $qry;
    }
}