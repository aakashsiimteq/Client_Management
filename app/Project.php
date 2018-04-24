<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'project_id';
    protected $fillable = ['project_number','customer_id','project_name','project_type','project_details','project_status','project_start_date','project_end_date','project_per_hour_cost','project_estimate_cost'];

}
