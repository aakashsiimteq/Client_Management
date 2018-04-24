@extends('layout.index') @section('title', 'Project')
@php
    $project_number = 'PR'.$project_number;
@endphp
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
        {{Form::text('project_no', $project_number ,['class' => 'form-control', 'for' => 'project_no', 'readonly'=>'true'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('customer_id', 'Customer no.')}}
        {{Form::text('customer_id', $customer->customer_number ,['class' => 'form-control'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('customer_name', 'Customer name')}}
        {{Form::text('customer_name', $customer->customer_name ,['class' => 'form-control'])}}
    </div>
</div>

<div class="row" style="margin-top:2%;">
    <div class="col-md-4">
        {{Form::label('project_type', 'Project Type')}}
        {{Form::select('project_type', ['Website' => 'Website', 'Software' => 'Software', 'Web service' => 'Web service', 'Cloud' => 'Cloud', 'Other' => 'Other'], null ,['class' => 'form-control'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('project_name', 'Project Name')}}
        {{Form::text('project_name', null ,['class' => 'form-control', 'for' => 'project_name'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('project_status', 'Project Status')}}
        {{Form::select('project_status', ['On going' => 'On going', 'Complete' => 'Complete'], null ,['class' => 'form-control'])}}
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
            {{Form::submit('Create', ['class' => 'btn btn-primary btn-block'])}}
        </div>
    </div>


    {!! Form::close() !!}
  </div>
</div>

@endsection
 