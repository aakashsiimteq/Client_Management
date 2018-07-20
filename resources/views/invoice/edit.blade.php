@extends('layout.index') @section('title', 'Edit Invoice')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Edit Invoice</h3>
    </div>
    <div class="panel-body">
        {!! Form::model($invoice, ['route' => ['invoice.update', $invoice->invoice_id], 'method' => 'PUT']) !!}
            @php
                $class = '';
                if($customer_invoice->invoice_status == 'Open') {
                    $class = 'disabled';
                } else {
                    $class = '';
                }
            @endphp
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
            <table class="table text-center">
                <thead class="bg-primary" style="border: 1px solid #ccc">
                <tr>
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
                        <td style="border: 1px solid #dedede">{{Form::text('invoice_number', $customer_invoice->invoice_number ,['class' => 'form-control', 'for' => 'invoice_number', 'readonly'=>'true', 'style' => 'background-color: white;'])}}</td>
                        <td style="border: 1px solid #dedede">{{Form::text('project_type', $customer_invoice->project_type ,['class' => 'form-control', 'for' => 'project_type', 'style' => 'background-color: white;'])}}</td>
                        <td style="border: 1px solid #dedede">{{Form::text('project_id', $customer_invoice->project_name ,['class' => 'form-control', 'for' => 'project_name', 'style' => 'background-color: white;'])}}</td>
                        <td style="border: 1px solid #dedede">{{Form::text('project_per_hour_cost', $customer_invoice->project_per_hour_cost ,['class' => 'form-control', 'for' => 'project_name', 'style' => 'background-color: white;'])}}</td>
                        <td style="border: 1px solid #dedede">{{Form::text('project_estimate_cost', $customer_invoice->project_estimate_cost ,['class' => 'form-control', 'for' => 'project_name', 'style' => 'background-color: white;'])}}</td>
                        <td style="border: 1px solid #dedede">{{Form::text('project_final_cost', $customer_invoice->project_estimate_cost ,['class' => 'form-control', 'for' => 'project_name', 'id' => 'project_final_cost'])}}</td>
                        <td style="border: 1px solid #dedede">{{Form::text('invoice_reference', null ,['class' => 'form-control', 'for' => 'invoice_reference'])}}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="text-right" style="border: 1px solid #dedede"><b>Total:</b></td>
                        <td class="text-left" id="invoice_total" style="border: 1px solid #dedede">
                            {{Form::text('invoice_total', $customer_invoice->project_estimate_cost, ['class'=>'form-control', 'id'=> 'invoice_total'])}}
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="text-right" style="border: 1px solid #dedede"><b>GST:</b></td>
                        <td class="text-left" style="border: 1px solid #dedede">
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
                        <td class="text-right" style="border: 1px solid #dedede"><b>Grand total:</b></td>
                        <td class="text-left" id="invoice_grand_total" style="border: 1px solid #dedede">
                            {{Form::text('invoice_grand_total', $customer_invoice->invoice_grand_total, ['class'=>'form-control', 'id'=> 'invoice_grand_total'])}}
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
                        <option value="ByHand">By Hand</option>
                        <option value="ByEmail">By Email</option>
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
            <div class="row" style="margin-top: 2%;">
                <div class="col-md-6">
                    {{Form::submit('Update', ['class' => 'btn btn-primary btn-block', 'disabled'=>$class])}}
                </div>
                <div class="col-md-6">
                    {!!Html::linkRoute('invoice.index', 'Cancel', null,['class' => 'btn btn-danger btn-block'])!!}
                </div>
            </div>
        {!!Form::close()!!}
    </div>
</div>
@endsection
@push('body_scripts')
    <script>
        $('#project_final_cost').keyup(function () {
            var project_val = $(this).val();
            var final_gst_value = (project_val * 10)/100;
            $('#invoice_total').val(project_val);
            $('#invoice_grand_total').val(project_val + final_gst_value);
        });
    </script>
@endpush