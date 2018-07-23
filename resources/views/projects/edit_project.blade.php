@extends('layout.index') @section('title', 'Project')

@section('content')
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Project</h3>
  </div>

  <div class="panel-body">
    {!! Form::model($project, ['route' => ['project.update', $project->project_id], 'method' => 'PUT']) !!}
    <div class="row">
    <div class="col-md-4">
        {{Form::label('project_no', 'Project no.')}}
        {{Form::text('project_no', $project->project_number ,['class' => 'form-control', 'for' => 'project_no', 'readonly'=>'true'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('customer_id', 'Customer no.')}}
        {{Form::text('customer_id', $project->customer_number ,['class' => 'form-control','for' => 'customer_id','placeholder' => 'Customer Id','readonly' => 'true'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('customer_name', 'Customer name')}}
        {{Form::text('customer_name', $project->customer_name ,['class' => 'form-control','required' => 'true'])}}
    </div>
</div>

<div class="row" style="margin-top:2%;">
    <div class="col-md-4">
        {{Form::label('project_type', 'Project Type')}}
        {{Form::select('project_type', ['Website' => 'Website', 'Software' => 'Software', 'Web service' => 'Web service', 'Cloud' => 'Cloud', 'Computer Maintenance' => 'Computer Maintenance', 'Network Installation' => 'Network Installation','Other' => 'Other'], null ,['class' => 'form-control','required' => 'true'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('project_name', 'Project Name')}}
        {{Form::text('project_name', $project->project_name ,['class' => 'form-control', 'for' => 'project_name','required' => 'required'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('project_status', 'Project Status')}}
        {{Form::select('project_status', ['In Progress' => 'In Progress', 'Complete' => 'Complete'], null ,['class' => 'form-control','required' => 'true'])}}
    </div>
</div>

<div class="row" style="margin-top:2%;">
    <div class="col-md-12">
        {{Form::label('project_details', 'Project Details')}}
        {{Form::textarea('project_details', $project->project_details ,['class' => 'form-control', 'for' => 'project_type'])}}
    </div>

</div>

<div class="row" style="margin-top:2%;">
    <div class="col-md-4">
        {{Form::label('project_start_date', 'Start Date')}}
        {{Form::date('project_start_date', $project->project_start_date ,['class' => 'form-control', 'for' => 'project_start_date','required' => 'true', 'id'=>'project_start_date'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('project_end_date', 'End Date')}}
        {{Form::date('project_end_date', $project->project_end_date ,['class' => 'form-control', 'for' => 'project_end_date', 'id'=>'project_end_date'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('project_per_hour_cost', 'Per Hour Cost')}}
        {{Form::number('project_per_hour_cost', number_format($project->project_per_hour_cost, 2) ,['class' => 'form-control', 'for' => 'project_per_hour_cost','required' => 'true','onkeypress' => 'return isNumberKey(event)', 'id' => 'project_per_hour_cost'])}}

    </div>
</div>
<div class="row" style="margin-top:2%;">
    <div class="col-md-4">
        {{Form::label('project_estimate_cost', 'Project Cost')}}
        {{Form::number('project_estimate_cost', number_format($project->project_estimate_cost, 2) ,['class' => 'form-control', 'for' => 'project_estimate_cost','required' => 'true'])}}
    </div>
</div>

<div class="row" style="margin-top:2%;">
    <div class="col-md-6">
        {{Form::submit('Update', ['class' => 'btn btn-primary btn-block'])}}
    </div>
    <div class="col-md-6">
        {!!Html::linkRoute('project.index', 'Cancel', null,['class' => 'btn btn-danger btn-block'])!!}
    </div>
</div>

    {!! Form::close() !!}
  </div>
</div>

@endsection

@push('body_scripts')
    <script>
        $('#project_per_hour_cost').keyup(function () {
            var perHourCost = $('#project_per_hour_cost').val();
            var project_end_date = $('#project_end_date').val();
            var project_start_date = $('#project_start_date').val();
            var endDate = Date.parse(project_end_date);
            var startDate = Date.parse(project_start_date);
            var dateDiff = new Date(endDate - startDate);
            var days  = dateDiff/1000/60/60/24;
            var totalHours = days * 9;
            var finalCost = totalHours*perHourCost;
            $('#project_estimate_cost').val(finalCost.toFixed(2));
        });

        $('#project_start_date').change(function () {
            var perHourCost = $('#project_per_hour_cost').val();
            var project_end_date = $('#project_end_date').val();
            var project_start_date = $('#project_start_date').val();
            var endDate = Date.parse(project_end_date);
            var startDate = Date.parse(project_start_date);
            var dateDiff = new Date(endDate - startDate);
            var days  = dateDiff/1000/60/60/24;
            var totalHours = days * 9;
            var finalCost = totalHours*perHourCost;
            $('#project_estimate_cost').val(finalCost.toFixed(2));
        });
        $('#project_end_date').change(function () {
            var perHourCost = $('#project_per_hour_cost').val();
            var project_end_date = $('#project_end_date').val();
            var project_start_date = $('#project_start_date').val();
            var endDate = Date.parse(project_end_date);
            var startDate = Date.parse(project_start_date);
            var dateDiff = new Date(endDate - startDate);
            var days  = dateDiff/1000/60/60/24;
            var totalHours = days * 9;
            var finalCost = totalHours*perHourCost;
            $('#project_estimate_cost').val(finalCost.toFixed(2));
        });
        $('#project_estimate_cost').keyup(function () {
            var estimateCost = $('#project_estimate_cost').val();
            var project_end_date = $('#project_end_date').val();
            var project_start_date = $('#project_start_date').val();
            var endDate = Date.parse(project_end_date);
            var startDate = Date.parse(project_start_date);
            var dateDiff = new Date(endDate - startDate);
            var days  = dateDiff/1000/60/60/24;
            var totalHours = days * 9;
            var finalPerHourCost = estimateCost/totalHours;
            $('#project_per_hour_cost').val(finalPerHourCost.toFixed(2));
        });
    </script>
@endpush
