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
                <thead>
                    <th>Sr no.</th>
                    <th>Invoice id.</th>
                    <th>Customer name</th>
                    <th>Project type</th>
                    <th>Project title</th>
                    <th>Invoice amount</th>
                    <th>Invoice date</th>
                    <th>Invoice status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                @foreach($custom_invoices as $invoice)
                    <tr>
                    <td>{{++$count}}</td>
                    <td>{{$invoice->custom_invoice_number}}</td>
                    <td>{{$invoice->custom_customer_name}}</td>
                    <td>{{$invoice->project_type}}</td>
                    <td>{{$invoice->project_title}}</td>
                    <td>A$ {{number_format($invoice->invoice_grand_total, 2, '.', ',')}}</td>
                    <td>{{$invoice->invoice_date}}</td>
                    <td>{{$invoice->invoice_status}}</td>
                    <td>
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
