<?php

namespace App\Http\Managers;


use App\CustomInvoice;

class CustomInvoiceManager
{
    public static function getCustomInvoiceStatus() {
        $status = CustomInvoice::all()->pluck('invoice_status')->toArray();
        return $status;
    }
}