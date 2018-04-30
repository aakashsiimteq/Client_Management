@extends('layout.index') @section('title', 'Invoices')

@section('content')
    @php
        $count = 0;
    @endphp
    <p class="text-right"><button class="btn btn-primary btn-md" data-toggle="modal" data-target="#customInvoice">Make custom invoice</button></p>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="customInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['action' => 'CustomInvoiceController@store', 'method' => 'POST']) !!}
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Custom invoice</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                    {{Form::label('custom_invoice_id', 'Invoice id')}}
                                    {{Form::text('custom_invoice_id', $custom_invoice_number ,['class' => 'form-control', 'for' => 'invoice_id', 'readonly' => true])}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('custom_customer_name', 'Customer name')}}
                                {{Form::text('custom_customer_name', null ,['class' => 'form-control', 'for' => 'custom_customer_name'])}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('custom_customer_address', 'Customer address')}}
                                {{Form::text('custom_customer_address', null ,['class' => 'form-control', 'for' => 'custom_customer_address'])}}
                            </div>
                        </div>
                    </div>
                    <div class="product-item float-clear" style="clear:both;">
                        <div class="pull-left" style="margin-right:1%;"><input type="checkbox" name="product_index[]" /></div>
                        <div class="pull-left" ><input type="text" name="product_name[]" class="form-control" placeholder="Product name" required/></div>
                        <div class="pull-left"><input type="text" name="product_quantity[]" class="form-control" placeholder="Quantity" required/></div>
                        <div class="pull-left"><input type="text" name="product_cost[]" class="form-control" placeholder="Product cost" required/></div>
                    </div>
                    <div class="row">
                        <input type="button" name="add_item" value="Add More" onclick="addMore();" class="btn btn-sm btn-primary" style="margin-right: 1%; margin-left: 1%;">
                        <input type="button" name="del_item" value="Delete" onclick="deleteRow();" class="btn btn-sm btn-danger">
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{Form::submit('Save', ['class' => 'btn btn-primary'])}}
            </div>
            {!!Form::close()!!}
        </div>
        </div>
    </div>
    <div class="panel panel-primary" style="margin-top:40px">
        <div class="panel-heading">
            <h3 class="panel-title">View Invoices</h3>
        </div>
        <div class="panel-body">
            <table class="table text-center table-bordered table-hover">
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
                            <td>{{$invoice->invoice_number}}</td>
                            <td>{{$invoice->customer_name}}</td>
                            <td>{{$invoice->customer_type}}</td>
                            <td>{{$invoice->project_name}}</td>
                            <td>{{$invoice->project_type}}</td>
                            <td>A$ {{number_format($invoice->invoice_final_cost, 2, '.', ',')}}</td>
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
