@extends('layout.index') @section('title', 'Customer')

@section('content')
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Register Customer</h3>
    </div>
    <div class="panel-body">
      {!! Form::open(['action' => 'CustomerController@store', 'method' => 'POST']) !!}
        @include('customer.customer_create_form')
      {!! Form::close() !!}
    </div>
  </div>
@endsection
@section('custom_scripts')
    @parent
    <!-- The rest of your scripts -->
    <script type="text/javascript">
      $(document).ready(function() {
        $('#customer_type').on('change', function() {
          var customerTypeSelected = this.value;

          if (customerTypeSelected == 'Company') {
            $('#customer_abn_no').prop('required', 'true');
            $('#customer_email').prop('required', 'true');
            $('#customer_abn_no').removeAttr('readonly');
            $('#customer_email').removeAttr('readonly');
          }else {
            $('#customer_abn_no').prop('required', 'false');
            $('#customer_email').prop('required', 'false');
            $('#customer_abn_no').prop('readonly', 'true');
            $('#customer_email').prop('readonly', 'true');
          }
        })
      });
    </script>
@endsection
