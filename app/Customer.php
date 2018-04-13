<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use App\Project;

class Customer extends Model
{
    
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';
    protected $fillable = ['customer_number','customer_name','customer_type','customer_abn_no','customer_email','customer_contact_no','customer_physical_address','customer_billing_address'];

    public function invoice() {
        return $this->hasMany(Invoice::class, 'customer_id', 'customer_id');
    }

    public function project() {
        return $this->hasMany(Project::class, 'customer_id', 'customer_id');
    }
}
