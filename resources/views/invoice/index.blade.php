@extends('layout.index') @section('title', 'Invoices')

@section('content')
    @php
        $count = 0;
    @endphp
    <div class="row">
        <div class="col-md-3">
            <label for="search_table" class="control-label">Search Invoices</label>
            <input type="text" name="search_table" id="search_table" placeholder="Search Invoices" class="form-control" />
        </div>
        <div class="col-md-9">
            <a href="{{route('custom-invoice.create')}}" class="btn btn-primary pull-right">Make custom invoice</a>
        </div>
    </div>

    <div class="panel panel-primary" style="margin-top:40px">
        <div class="panel-heading">
            <h3 class="panel-title">View Invoices</h3>
        </div>
        <div class="panel-body">
            <table class="table text-center table-bordered table-hover" id="searchtable">
                <thead>
                    <th>Sr no.</th>
                    <th>Invoice id.</th>
                    <th>Customer name</th>
                    <th>Customer type</th>
                    <th>Project name</th>
                    <th>Project type</th>
                    <th>Invoice amount</th>
                    <th>Inc. GST</th>
                    <th>Reference</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{++$count}}</td>
                            <td><a href="/invoice/{{$invoice->invoice_id}}/edit">{{$invoice->invoice_number}}</a></td>
                            <td>{{$invoice->customer_name}}</td>
                            <td>{{$invoice->customer_type}}</td>
                            <td>{{$invoice->project_name}}</td>
                            <td>{{$invoice->project_type}}</td>
                            <td>A$ {{number_format($invoice->invoice_grand_total, 2, '.', ',')}}</td>
                            <td>
                                @if($invoice->invoice_gst_rate > 0)
                                    Yes
                                @endif
                            </td>
                            <td>{{$invoice->invoice_reference or '-'}}</td>
                            <td>
                                {!!Html::linkRoute('invoice.edit', 'Edit', array($invoice->invoice_id), array('class' => 'btn btn-primary btn-sm'))!!}
                                <div style="display: inline-block">
                                    {!!Form::open(['route' => ['invoice.destroy', $invoice->invoice_id], 'method' => 'DELETE'])!!}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])}}
                                    {!!Form::close()!!}
                                </div>
                                <a class="btn btn-sm btn-warning" href="/print?invoice_id={{$invoice->invoice_number}}" target="_blank"><i class="fa fa-print"></i>&nbsp;Print</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr></tr>
                </tbody>
            </table>
        </div>
    </div>
   
@endsection
