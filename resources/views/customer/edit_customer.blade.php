@extends('layout.index') @section('title', 'Customer')

@section('content')
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Customer</h3>
  </div>
  <div class="panel-body">
    {!! Form::model($customer, ['route' => ['customer.update', $customer->customer_id], 'method' => 'PUT']) !!}
    <div class="row">
            <div class="col-md-4">
                {{Form::label('customer_no', 'Customer no.')}}
                {{Form::text('customer_no', $customer->customer_number ,['class' => 'form-control', 'for' => 'customer_no', 'readonly'=>'true'])}}
            </div>
            <div class="col-md-4">
                {{Form::label('customer_name', 'Name')}}
                {{Form::text('customer_name', $customer->customer_name ,['class' => 'form-control', 'for' => 'customer_name'])}}
            </div>
            <div class="col-md-4">
                {{Form::label('customer_type', 'Customer type')}}
                {{Form::select('customer_type', ['Company' => 'Company', 'Individual' => 'Individual', 'Other' => 'Other'], $customer->customer_type ,['class' => 'form-control'])}}
            </div>
        </div>
        
        <div class="row" style="margin-top:2%;">
            <div class="col-md-4">
                {{Form::label('customer_abn_no', 'ABN no.')}}
                {{Form::text('customer_abn_no', $customer->customer_abn_no ,['class' => 'form-control', 'for' => 'customer_abn_no'])}}
            </div>
            <div class="col-md-4">
                {{Form::label('customer_email', 'Email')}}
                {{Form::email('customer_email', $customer->customer_email ,['class' => 'form-control', 'for' => 'customer_email'])}}
            </div>
            <div class="col-md-4">
                {{Form::label('customer_contact_no', 'Contact no.')}}
                {{Form::number('customer_contact_no', $customer->customer_contact_no ,['class' => 'form-control', 'for' => 'customer_contact_no'])}}        
            </div>
        </div>
        
        <div class="row" style="margin-top:2%;">
            <div class="col-md-6">
                {{Form::label('customer_physical_address', 'Physical address')}}
                {{Form::textarea('customer_physical_address', $customer->customer_physical_address ,['class' => 'form-control', 'for' => 'customer_physical_address'])}}
            </div>
            <div class="col-md-6">
                {{Form::label('customer_billing_address', 'Billing address')}}
                {{Form::textarea('customer_billing_address', $customer->customer_billing_address ,['class' => 'form-control', 'for' => 'customer_billing_address'])}}
            </div>
        </div>
        <div class="row" style="margin-top:2%;">
            <div class="col-md-6">
                {{Form::submit('Update', ['class' => 'btn btn-primary btn-block'])}}
            </div>
            <div class="col-md-6">
                {!!Html::linkRoute('customer.index', 'Cancel', null,['class' => 'btn btn-danger btn-block'])!!}
            </div>
        </div>        
    {!! Form::close() !!}
  </div>
</div>

@endsection