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
                    {{Form::text('custom_customer_name', null ,['class' => 'form-control', 'for' => 'customer_name', 'required'=>'true'])}}
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-3 text-right">
                    <p style="font-size:20px;">{{$customer_invoice->invoice_status or 'Open'}}</p>
                </div>
            </div>
            <table class="table" class="text-center">
                <thead>
                <tr class="bg-primary">
                    <th style="border: 1px solid #174993">Invoice id</th>
                    <th style="border: 1px solid #174993">Project type</th>
                    <th style="border: 1px solid #174993">Project title</th>
                    <th style="border: 1px solid #174993">Per hour cost (A$)</th>
                    <th style="border: 1px solid #174993">Estimated cost (A$)</th>
                    <th style="border: 1px solid #174993">Final cost (A$)</th>
                    <th style="border: 1px solid #174993">Reference</th>
                </tr>
                </thead>
                <tbody style="border: 1px solid #dedede">
                <tr>
                    <td style="border: 1px solid #dedede">{{Form::text('custom_invoice_number', $custom_invoice_number ,['class' => 'form-control', 'for' => 'invoice_number', 'readonly'=>'true', 'style' => 'border: none; background-color: white;'])}}</td>
                    <td style="border: 1px solid #dedede">{{Form::select('project_type',  ['Website' => 'Website', 'Software' => 'Software', 'Web service' => 'Web service', 'Cloud' => 'Cloud', 'Computer Maintenance' => 'Computer Maintenance', 'Network Installation' => 'Network Installation','Other' => 'Other'], null  ,['class' => 'form-control', 'for' => 'project_type', 'placeholder' => 'Select Project Type'])}}</td>
                    <td style="border: 1px solid #dedede">{{Form::text('project_title', null ,['class' => 'form-control', 'for' => 'project_name'])}}</td>
                    <td style="border: 1px solid #dedede">{{Form::text('project_per_hour_cost', null ,['class' => 'form-control'])}}</td>
                    <td style="border: 1px solid #dedede">{{Form::text('project_estimate_cost', null ,['class' => 'form-control'])}}</td>
                    <td style="border: 1px solid #dedede">{{Form::text('project_final_cost', null ,['class' => 'form-control', 'for' => 'project_name', 'id' => 'project_final_cost'])}}</td>
                    <td style="border: 1px solid #dedede">{{Form::text('invoice_reference', null ,['class' => 'form-control', 'for' => 'invoice_reference'])}}</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class="text-right" style="border: 1px solid #dedede"><b>Total: A$</b></td>
                    <td class="text-left" style="border: 1px solid #dedede">{{Form::text('invoice_total_amount', null, ['class' => 'form-control','id' => 'invoice_total_amount'])}}</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class="text-right" style="border: 1px solid #dedede"><b>Grand total: A$</b></td>
                    <td class="text-left" style="border: 1px solid #dedede">
                        {{Form::text('invoice_grand_total', null, ['class' => 'form-control', 'id' => 'invoice_grand_total'])}}
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
@push('body_scripts')
    <script>
        $('#project_final_cost').keyup(function () {
           $('#invoice_total_amount').val($(this).val());
            $('#invoice_grand_total').val($(this).val());
        });
    </script>
@endpush