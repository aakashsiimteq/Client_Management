<?php

namespace App;

use Carbon\Carbon;

class SearchParamInvoice extends SearchParam
{
    public static function prepareSearch($qry, $search_params) {
        if(!empty($search_params['search_by_customer'])) {
            $qry = $qry->where('invoices.customer_id','=', $search_params['search_by_customer']);
        }
        if(!empty($search_params['search_by_status'])) {
            $qry = $qry->where('invoice_status','=', $search_params['search_by_status']);
        }
        if(!empty($search_params['search_by_start_date']) and !empty($search_params['search_by_end_date'])) {
            $qry = $qry->whereBetween('invoices.created_at', [Carbon::parse($search_params['search_by_start_date']), Carbon::parse($search_params['search_by_end_date'])]);
        } else {
            if(!empty($search_params['search_by_start_date'])) {
                $qry = $qry->where('invoices.created_at', Carbon::parse($search_params['search_by_start_date']));
            }
            if(!empty($search_params['search_by_end_date'])) {
                $qry = $qry->where('invoices.created_at','=', Carbon::parse($search_params['search_by_end_date']));
            }
        }
        return $qry;
    }
}