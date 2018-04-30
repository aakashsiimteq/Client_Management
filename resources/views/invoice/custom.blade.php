@extends('layout.index') @section('title', 'Custom Invoices')

@section('content')
@php
    $count = 0;
    $count1 = 0;
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
    <table class="table">
        <thead>
            <th>Sr no.</th>
            <th>Invoice id.</th>
            <th>Customer name</th>
            <th>Invoice amount</th>
            <th>Invoice date</th>
            <th>Invoice status</th>
            <th>&nbsp;</th>
        </thead>
        <tbody>
            @foreach($unique_invoice as $invoice)
                <tr>
                    <td>{{++$count}}</td>
                    <td>{{$invoice->custom_invoice_number}}</td>
                    <td>{{$invoice->custom_customer_name}}</td>
                    <td>A$ {{number_format($invoice->custom_invoice_amount, 2, '.', ',')}}</td>
                    <td>{{$invoice->created_at}}</td>
                    <td></td>
                    <td>
                        {!!Html::linkRoute('custom-invoice.edit', 'Edit', array($invoice->custom_invoice_id), array('class' => 'btn btn-primary btn-sm'))!!}
                            <div style="display: inline-block">
                                {!!Form::open(['route' => ['custom-invoice.destroy', $invoice->custom_invoice_id], 'method' => 'DELETE'])!!}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])}}
                                {!!Form::close()!!}
                            </div>
                        <button class="btn btn-sm btn-warning">Print</button>
                    </td>
                </tr>
                <div id="collapseExample" class="collapse">
                    <thead style="color: gray;">
                        <th></th>
                        <th>Sr.no.</th>
                        <th>Product name</th>
                        <th>Product quantity</th>
                        <th>Product cost</th>
                    </thead>
                    <?php $total = 0; ?>
                    @foreach($custom_invoices as $cust_invo)
                        @if($cust_invo->custom_invoice_number == $invoice->custom_invoice_number)
                            <?php $total = $total + $cust_invo->custom_invoice_product_cost;?>
                            <tr style="color: gray; font-style: italic">
                                <td>&nbsp;</td>
                                <td>{{++$count1}}</td>
                                <td>{{$cust_invo->custom_invoice_product_name}}</td>
                                <td>{{$cust_invo->custom_invoice_product_quantity}}</td>
                                <td>A$ {{number_format($cust_invo->custom_invoice_product_cost, 2, '.', ',')}}</td>
                            </tr>
                        @endif
                    @endforeach
                    <?php $count1 = 0;?>
                    <tr style="color: gray; font-style: italic">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="text-right font-weight-bold">Total:</td>
                        <td>A$ {{number_format($total, 2, '.', ',')}}</td>
                    </tr>
                </div>
                
            @endforeach
        </tbody>
        
    </table>
@endsection
