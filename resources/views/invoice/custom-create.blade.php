@extends('layout.index') @section('title', 'Custom Invoice')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Make Custom Invoice</h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['action' => 'CustomInvoiceController@store', 'method' => 'POST']) !!}
            <div class="row" style="margin-bottom: 2%;">
                <div class="col-md-3">
                    {{Form::label('custom_customer_name', 'Customer name')}}
                    {{Form::text('custom_customer_name', null ,['class' => 'form-control', 'for' => 'customer_name'])}}
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-3 text-right">
                    <p style="font-size:20px;">{{$customer_invoice->invoice_status or 'Open'}}</p>
                </div>
            </div>
            <table class="table" class="text-center">
                <thead>
                <th>Invoice id</th>
                <th>Project type</th>
                <th>Project title</th>
                <th>Per hour cost (A$)</th>
                <th>Estimated cost (A$)</th>
                <th>Final cost (A$)</th>
                <th>Reference</th>
                </thead>
                <tbody>
                <tr>
                    <td>{{Form::text('custom_invoice_number', $custom_invoice_number ,['class' => 'form-control', 'for' => 'invoice_number', 'readonly'=>'true', 'style' => 'border: none; background-color: white;'])}}</td>
                    <td>{{Form::select('project_type',  ['Website' => 'Website', 'Software' => 'Software', 'Web service' => 'Web service', 'Cloud' => 'Cloud', 'Computer Maintenance' => 'Computer Maintenance', 'Network Installation' => 'Network Installation','Other' => 'Other'], null  ,['class' => 'form-control', 'for' => 'project_type', 'placeholder' => 'Select Project Type'])}}</td>
                    <td>{{Form::text('project_title', null ,['class' => 'form-control', 'for' => 'project_name'])}}</td>
                    <td>{{Form::text('project_per_hour_cost', null ,['class' => 'form-control'])}}</td>
                    <td>{{Form::text('project_estimate_cost', null ,['class' => 'form-control'])}}</td>
                    <td>{{Form::text('project_final_cost', null ,['class' => 'form-control', 'for' => 'project_name'])}}</td>
                    <td>{{Form::text('invoice_reference', null ,['class' => 'form-control', 'for' => 'invoice_reference'])}}</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class="text-right"><b>Total: A$</b></td>
                    <td class="text-left" id="invoice_total_amount">{{Form::text('invoice_total_amount', null, ['class' => 'form-control'])}}</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class="text-right"><b>Grand total: A$</b></td>
                    <td class="text-left" id="invoice_grand_total">
                        {{Form::text('invoice_grand_total', null, ['class' => 'form-control'])}}
                    </td>
                    <td>&nbsp;</td>
                </tr>
                </tbody>
            </table>

            <div class="row" style="margin-top:2%">

                <div class="col-md-4">
                    {{Form::label('invoice_date', 'Invoice Date')}}
                    {{Form::date('invoice_date', null, ['class' => 'form-control'])}}
                </div>
                <div class="col-md-4">
                    {{Form::label('invoice_copy_type', 'Invoice Copy Type')}}
                    <select name="invoice_copy_type" id="invoice_copy_type" class="form-control">
                        <option selected disabled>Select invoice copy type</option>
                        <option value="By Hand">By Hand</option>
                        <option value="By Email">By Email</option>
                    </select>
                </div>
                <div class="col-md-4">
                    {{Form::label('invoice_billing_address', 'Billing Address')}}
                    {{Form::text('invoice_billing_address', null, ['class' => 'form-control'])}}
                </div>
            </div>
            <div class="row" style="margin-top:2%">
                <div class="col-md-6">
                    {{Form::label('project_desc', 'Project Description')}}
                    {{Form::textarea('project_desc', null, ['class' => 'form-control'])}}
                </div>
                <div class="col-md-6">
                    {{Form::label('invoice_comments', 'Comments')}}
                    {{Form::textarea('invoice_comments', null, ['class' => 'form-control'])}}
                </div>
            </div>
            <div class="row" style="margin-top: 2%;">
                <div class="col-md-12">
                    {{Form::submit('Save', ['class' => 'btn btn-primary btn-block'])}}
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
@endsection