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
            {{Form::text('project_no', $project_number ,['class' => 'form-control', 'for' => 'project_no', 'readonly'=>'true'])}}
        </div>
        <div class="col-md-4">
            {{Form::label('customer_id', 'Customer no.')}}
            {{Form::text('customer_id', $customer->customer_number ,['class' => 'form-control','required' => 'true','readonly' => 'true'])}}
        </div>
        <div class="col-md-4">
            {{Form::label('customer_name', 'Customer name')}}
            {{Form::text('customer_name', $customer->customer_name ,['class' => 'form-control','required' => 'true','placeholder' => 'Customer Name'])}}
        </div>
    </div>
    <div class="row" style="margin-top:2%;">
        <div class="col-md-4">
            {{Form::label('project_type', 'Project Type')}}
            {{Form::select('project_type', ['Website' => 'Website', 'Software' => 'Software', 'Web service' => 'Web service', 'Cloud' => 'Cloud', 'Computer Maintenance' => 'Computer Maintenance', 'Network Installation' => 'Network Installation','Mobile Application' => 'Mobile Application','Hire Model' => 'Hire Model','Other' => 'Other'], null ,['class' => 'form-control','required' => 'true','id'=>'project_type','placeholder' => 'Select Project Type'])}}
        </div>
        <div class="col-md-4">
            {{Form::label('project_name', 'Project Name')}}
            {{Form::text('project_name', null ,['class' => 'form-control', 'for' => 'project_name','required' => 'true','placeholder' => 'Project Name'])}}
        </div>
        <div class="col-md-4">
            {{Form::label('project_status', 'Project Status')}}
            {{Form::select('project_status', ['In Progress' => 'In Progress', 'Complete' => 'Complete'], null ,['class' => 'form-control','required' => 'true','placeholder' => 'Project Status'])}}
        </div>
    </div>

    <div class="row" style="margin-top:2%;">
        <div class="col-md-12">
            {{Form::label('project_details', 'Project Details')}}
            {{Form::textarea('project_details', null ,['class' => 'form-control', 'for' => 'project_type','required' => 'true','Placeholder' => 'Project Details'])}}
        </div>

    </div>

    <div class="row" style="margin-top:2%;">
        <div class="col-md-3">
            {{Form::label('project_start_date', 'Start Date')}}
            {{Form::date('project_start_date', null ,['class' => 'form-control', 'for' => 'project_start_date','required' => 'true', 'id'=>'project_start_date'])}}
        </div>
        <div class="col-md-3">
            {{Form::label('project_end_date', 'End Date')}}
            {{Form::date('project_end_date', null ,['class' => 'form-control', 'for' => 'project_end_date','required' => 'true', 'id'=>'project_end_date'])}}
        </div>
        <div class="col-md-3">
            {{Form::label('project_per_hour_cost', 'Per Hour Cost')}}
            {{Form::text('project_per_hour_cost', null ,['class' => 'form-control', 'for' => 'project_per_hour_cost', 'placeholder' => 'Cost per Hour','onkeypress' => 'return isNumberKey(event)','onblur' => 'calculateTotal()', 'id' => 'project_per_hour_cost'])}}
        </div>
        <div class="col-md-3">
            {{Form::label('project_estimate_cost', 'Project Cost')}}
            {{Form::text('project_estimate_cost', null ,['class' => 'form-control', 'for' => 'project_estimate_cost','required' => 'true','placeholder' => 'Total Estimated Cost', 'id'=>'project_estimate_cost'])}}
        </div>
    </div>
    <div class="row" style="margin-top:2%;">
        <div class="col-md-6">
            {{Form::submit('Create', ['class' => 'btn btn-primary btn-block'])}}
        </div>
        <div class="col-md-6">
          <button type="reset" name="button" class="btn btn-info btn-block">Reset Form</button>
        </div>
    </div>


    {!! Form::close() !!}
  </div>
</div>

@endsection
@push('body_scripts')
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
@endpush
@section('custom_scripts')
    @parent
    <!-- The rest of your scripts -->
    <script type="text/javascript">
      $(document).ready(function() {
        $('#project_start_date').on('change', function() {
          $('#project_end_date').focus();
          $('#project_end_date').on('change', function() {
            if ($('#project_start_date').val() != '' && $('#project_end_date').val() != '') {
              $('#project_per_hour_cost').removeAttr('readonly');
              calculateTotal();
            }else {
              $('#project_per_hour_cost').prop('readonly','true');
            }
          })
        });
        $("#project_type").on('change', function() {
          var projectType = $(this).val();
          if ( projectType === 'Hire Model') {
            console.log('inside hire modal');
            $('#project_per_hour_cost').prop('required',true);;
          }else {
              console.log('outside hire modal');
            $('#project_per_hour_cost').prop('required',false);;
          }
        });
        function calculateTotal() {
          var start = $('#project_start_date').val();
          var end = $('#project_end_date').val();

          var match1 = /(\d+)\/(\d+)\/(\d+)/.exec(start)
          var start_date = new Date(match1[3], match1[2], match1[1]);

          var match2 = /(\d+)\/(\d+)\/(\d+)/.exec(end)
          var end_date = new Date(match2[3], match2[2], match2[1]);

          // end - start returns difference in milliseconds
          var diff = new Date(end_date - start_date);

          // get days
          var days = diff/1000/60/60/24;
          alert(days);
        }
      });
    </script>
@endsection
