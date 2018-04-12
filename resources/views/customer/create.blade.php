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
