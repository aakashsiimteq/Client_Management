@extends('layout.index') @section('title', 'Make Invoice')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Make Invoice</h3>
    </div>
    <div class="panel-body">
        {!!Form::open(['action' => 'InvoiceController@store', 'method' => 'POST'])!!}
            <div class="row">
                <div class="col-md-4">
                    {{Form::label('invoice_number', 'Invoice no.')}}
                    {{Form::text('invoice_number', null ,['class' => 'form-control', 'for' => 'invoice_number', 'readonly'=>'true'])}}
                </div>
                <div class="col-md-4">
                    {{Form::label('customer_name', 'Pick Customer')}}
                    {{Form::text('customer_id', null ,['class' => 'form-control', 'for' => 'customer_name'])}}
                </div>
                <div class="col-md-4">
                    {{Form::label('project_name', 'Select Project')}}
                    {{Form::text('project_id', null ,['class' => 'form-control', 'for' => 'project_name'])}}
                </div>
            </div>
            <div class="row" style="margin-top:2%">
                <div class="col-md-4" >
                    {{Form::label('invoice_gst_rate', 'GST Rate')}}
                    {{Form::number('invoice_gst_rate', null, ['class' => 'form-control', 'for' => 'invoice_gst_rate'])}}
                </div>
                <div class="col-md-4">
                    {{Form::label('invoice_final_cost', 'Final Cost')}}
                    {{Form::number('invoice_final_cost', null, ['class' => 'form-control', 'for' => 'invoice_final_cost'])}}
                </div>
                <div class="col-md-4">
                    {{Form::label('invoice_date', 'Invoice Date')}}
                    <input type="date" name="invoice_date" id="invoice_date" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-top:2%">
                <div class="col-md-4">
                    {{Form::label('invoice_copy_type', 'Invoice Copy Type')}}
                    <select name="invoice_copy_type" id="invoice_copy_type" class="form-control">
                        <option selected disabled>Select invoice copy type</option>
                        <option value="ByHand">By Hand</option>
                        <option value="ByEmail">By Email</option>
                    </select>
                </div>
                <div class="col-md-4">
                    {{Form::label('invoice_payment_terms', 'Invoice Copy Type')}}
                    <select name="invoice_payment_terms" id="invoice_payment_terms" class="form-control">
                        <option selected disabled>Select payment terms</option>
                        <option value="CreditCard">Credit Card</option>
                        <option value="Cash">Cash</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-4">
                    {{Form::label('invoice_billing_address', 'Billing Address')}}
                    {{Form::text('invoice_billing_address', null, ['class' => 'form-control', 'for' => 'invoice_billing_address'])}}
                </div>
            </div>
            <div class="row" style="margin-top:2%">
                <div class="col-md-12">
                    {{Form::label('invoice_comments', 'Comments')}}
                    {{Form::textarea('invoice_comments', null, ['class' => 'form-control', 'for' => 'invoice_comments'])}}
                </div>
            </div>
            <div class="row">
                
            </div>
        {!!Form::close()!!}
    </div>
</div>
@endsection