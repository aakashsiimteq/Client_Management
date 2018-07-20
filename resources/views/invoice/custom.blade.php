@extends('layout.index') @section('title', 'Custom Invoices')

@section('content')
@php
    $count = 0;
@endphp
<div class="row">
    <div class="col-md-3">
        <label for="search_table" class="control-label">Search Custom Invoices</label>
        <input type="text" name="search_table" id="search_table" placeholder="Search Custom Invoices" class="form-control" />
    </div>
    <div class="col-md-9">
        <a href="{{route('custom-invoice.create')}}" class="btn btn-primary pull-right" role="button">Make Custom Invoice</a>
    </div>
</div>
    <div class="panel panel-primary" style="margin-top:40px">
        <div class="panel-heading">
            <h3 class="panel-title">View Custom Invoices</h3>
        </div>
        <div class="panel-body">
            <table class="table text-center table-bordered table-hover" id="searchtable">
                <thead class="bg-primary">
                <tr>
                    <th style="border: 1px solid #174993">#</th>
                    <th style="border: 1px solid #174993">Invoice id.</th>
                    <th style="border: 1px solid #174993">Customer name</th>
                    <th style="border: 1px solid #174993">Project type</th>
                    <th style="border: 1px solid #174993">Project title</th>
                    <th style="border: 1px solid #174993">Invoice amount</th>
                    <th style="border: 1px solid #174993">Invoice date</th>
                    <th style="border: 1px solid #174993">Invoice status</th>
                    <th style="border: 1px solid #174993">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($custom_invoices as $invoice)
                    <tr>
                        <td style="border: 1px solid #dedede">{{++$count}}</td>
                        <td style="border: 1px solid #dedede"><a href="{{url("admin/custom-invoice/$invoice->custom_invoice_id/edit")}}">{{$invoice->custom_invoice_number}}</a></td>
                        <td style="border: 1px solid #dedede">{{$invoice->custom_customer_name}}</td>
                        <td style="border: 1px solid #dedede">{{$invoice->project_type}}</td>
                        <td style="border: 1px solid #dedede">{{$invoice->project_title}}</td>
                        <td style="border: 1px solid #dedede">A$ {{number_format($invoice->invoice_grand_total, 2, '.', ',')}}</td>
                        <td style="border: 1px solid #dedede">{{\Carbon\Carbon::parse($invoice->invoice_date)->toFormattedDateString()}}</td>
                        <td style="border: 1px solid #dedede">{{$invoice->invoice_status}}</td>
                        <td style="border: 1px solid #dedede">
                            {!!Html::linkRoute('custom-invoice.edit', 'Edit', array($invoice->custom_invoice_id), array('class' => 'btn btn-primary btn-sm'))!!}
                            <div style="display: inline-block">
                            {!!Form::open(['route' => ['custom-invoice.destroy', $invoice->custom_invoice_id], 'method' => 'DELETE'])!!}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm','onclick' => 'return confirm(\'Are you sure you want to delete\')'])}}
                            {!!Form::close()!!}
                            </div>
                            {!!Html::linkRoute('custom-invoice.edit', 'Print', array($invoice->custom_invoice_id), array('class' => 'btn btn-warning btn-sm'))!!}

                        </td>
                    </tr>
                @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
@endsection
