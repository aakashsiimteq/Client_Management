<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchParam extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'search',
        'search_by_customer', 'search_by_status',
        'search_by_invoice_no', 'search_by_start_date',
        'search_by_end_date'
    ];

    public function __construct() {
        parent::__construct();
    }
}
