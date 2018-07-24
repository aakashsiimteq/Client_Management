<?php

namespace App\Http\Managers;


use App\Invoice;

class InvoiceManager
{
    public static function getBaseQuery() {
        $qry = Invoice::with([])
                ->leftJoin('customers', 'customers.customer_number', '=', 'invoices.customer_id')
                ->leftJoin('projects', 'projects.project_number', '=', 'invoices.project_id');
        return $qry;
    }
}