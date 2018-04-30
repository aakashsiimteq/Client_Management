@extends('layout.index') @section('title', 'Make Invoice')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Make Invoice</h3>
    </div>
    <div class="panel-body">
        {!! Form::model($invoice, ['route' => ['invoice.update', $invoice->invoice_id], 'method' => 'PUT']) !!}
            <div class="row" style="margin-bottom: 2%;">
                <div class="col-md-3">
                    {{Form::label('customer_name', 'Customer name')}}
                    {{Form::text('customer_id', $customer_invoice->customer_name ,['class' => 'form-control', 'for' => 'customer_name'])}}
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
                        <td>{{Form::text('invoice_number', $customer_invoice->invoice_number ,['class' => 'form-control', 'for' => 'invoice_number', 'readonly'=>'true', 'style' => 'border: none; background-color: white;'])}}</td>
                        <td>{{Form::text('project_type', $customer_invoice->project_type ,['class' => 'form-control', 'for' => 'project_type', 'style' => 'border: none; background-color: white;'])}}</td>
                        <td>{{Form::text('project_id', $customer_invoice->project_name ,['class' => 'form-control', 'for' => 'project_name', 'style' => 'border: none; background-color: white;'])}}</td>
                        <td>{{Form::text('project_per_hour_cost', number_format($customer_invoice->project_per_hour_cost, 2, '.', '') ,['class' => 'form-control', 'for' => 'project_name', 'style' => 'border: none; background-color: white;'])}}</td>
                        <td>{{Form::text('project_estimate_cost', number_format($customer_invoice->project_estimate_cost, 2, '.', '') ,['class' => 'form-control', 'for' => 'project_name', 'style' => 'border: none; background-color: white;'])}}</td>
                        <td>{{Form::text('project_final_cost', number_format($customer_invoice->project_estimate_cost, 2, '.', '') ,['class' => 'form-control', 'for' => 'project_name'])}}</td>
                        <td>{{Form::text('invoice_reference', null ,['class' => 'form-control', 'for' => 'invoice_reference'])}}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="text-right"><b>Total:</b></td>
                        <td class="text-left" id="invoice_total">A$ {{number_format($customer_invoice->project_estimate_cost, 2, '.', ',')}}</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="text-right"><b>GST:</b></td>
                        <td class="text-left">
                            {{Form::hidden('invoice_gst_rate', $customer_invoice->invoice_gst_rate)}}
                            {{$customer_invoice->invoice_gst_rate}}%
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="text-right"><b>Grand total:</b></td>
                        <td class="text-left" id="invoice_grand_total">
                            {{Form::hidden('invoice_grand_total', $customer_invoice->invoice_grand_total)}}
                            A$ {{number_format($customer_invoice->invoice_grand_total, 2, '.', ',')}}
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>
            
            <div class="row" style="margin-top:2%">
                
                <div class="col-md-4">
                    {{Form::label('invoice_date', 'Invoice Date')}}
                    {{Form::date('invoice_date', $customer_invoice->invoice_date, ['class' => 'form-control'])}}
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
                    {{Form::text('invoice_billing_address', $customer_invoice->customer_billing_address, ['class' => 'form-control', 'for' => 'invoice_billing_address'])}}
                </div>
            </div>
            <div class="row" style="margin-top:2%">
                <div class="col-md-12">
                    {{Form::label('invoice_comments', 'Comments')}}
                    {{Form::textarea('invoice_comments', null, ['class' => 'form-control', 'for' => 'invoice_comments'])}}
                </div>
            </div>
            <div class="row" style="margin-top:2%">
                <div class="col-md-12">
                    {{Form::submit('Save', ['class' => 'btn btn-primary btn-block'])}}
                </div>
            </div>
        {!!Form::close()!!}
    </div>
</div>
@endsection