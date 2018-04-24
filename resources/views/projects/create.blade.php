@extends('layout.index') @section('title', 'Project')

@section('content')
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Register Project</h3>
  </div>
  <div class="panel-body">
    {!! Form::open(['action' => 'ProjectController@store', 'method' => 'POST']) !!}
    <div class="row">
    <div class="col-md-4">
        {{Form::label('project_no', 'Project no.')}}
        {{Form::text('project_no', 12 ,['class' => 'form-control', 'for' => 'project_no', 'readonly'=>'true'])}}
    </div>
    <div class="col-md-8">
        {{Form::label('customer_id', 'Customer Name')}}
        {{Form::text('customer_id', null ,['class' => 'form-control'])}}
    </div>
    
</div>

<div class="row" style="margin-top:2%;">
    <div class="col-md-4">
        {{Form::label('project_type', 'Project Type')}}
        {{Form::text('project_type', "" ,['class' => 'form-control', 'for' => 'project_type'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('project_name', 'Project Name')}}
        {{Form::text('project_name', null ,['class' => 'form-control', 'for' => 'project_name'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('project_status', 'Project Status')}}
        {{Form::text('project_status', "",['class' => 'form-control', 'for' => 'project_status'])}} 
        
    </div>
</div>

<div class="row" style="margin-top:2%;">
    <div class="col-md-12">
        {{Form::label('project_details', 'Project Details')}}
        {{Form::textarea('project_details', null ,['class' => 'form-control', 'for' => 'project_type'])}}
    </div>
    
</div>

<div class="row" style="margin-top:2%;">
    <div class="col-md-4">
        {{Form::label('project_start_date', 'Start Date')}}
        {{Form::date('project_start_date', null ,['class' => 'form-control', 'for' => 'project_start_date'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('project_end_date', 'End Date')}}
        {{Form::date('project_end_date', null ,['class' => 'form-control', 'for' => 'project_end_date'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('project_per_hour_cost', 'Per Hour Cost')}}
        {{Form::number('project_per_hour_cost', null ,['class' => 'form-control', 'for' => 'project_per_hour_cost'])}}
        
    </div>
</div>
<div class="row" style="margin-top:2%;">
    <div class="col-md-4">
        {{Form::label('project_estimate_cost', 'Total Estimated Cost')}}
        {{Form::number('project_estimate_cost', null ,['class' => 'form-control', 'for' => 'project_estimate_cost'])}}
    </div>
</div>
        
    <div class="row" style="margin-top:2%;">
        <div class="col-md-12">
            {{Form::submit('Add', ['class' => 'btn btn-primary btn-block'])}}
        </div>
    </div>


    {!! Form::close() !!}
  </div>
</div>

@endsection
 