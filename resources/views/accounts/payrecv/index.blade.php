@extends('layout.index') @section('title', 'Payment Receive')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <label for="search_table" class="control-label">Search Payments</label>
            <input type="text" name="search_table" id="search_table" placeholder="Search Payments" class="form-control" />
        </div>
        <div class="col-md-9">
            {{--{{Form::open('')}}--}}
            <a href="#" class="btn btn-primary pull-right d-inline-block">Make Advanced Payment</a>
            <a href="#" class="btn btn-primary pull-right">Receive Payment</a>
        </div>
    </div>

    <div class="panel panel-primary" style="margin-top:40px">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    <h4>Amount Received</h4>
                </div>
                <div class="col-md-3">
                    {{Form::text('received_amount', null, ['class' => 'form-control', 'style' => 'direction: rtl', 'id' => 'received_amount'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <h4>Payment Type</h4>
                </div>
                <div class="col-md-3">
                    {{Form::select('payment_type', ['Payment' => 'Payment', 'Credit Note' => 'Credit Note', 'Advanced Payment' => 'Advanced Payment'], null,['class' => 'form-control'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <h4>Payment Method</h4>
                </div>
                <div class="col-md-3">
                    {{Form::select('payment_method', ['Manual' => 'Manual', 'Card' => 'Card'], null,['class' => 'form-control'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <h4>Payment Date</h4>
                </div>
                <div class="col-md-3">
                    {{Form::date('payment_date', null, ['class' => 'form-control'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <h4>Comments</h4>
                </div>
                <div class="col-md-3">
                    {{Form::text('payment_comment', null, ['class' => 'form-control'])}}
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-primary" style="margin-top:40px">
        <div class="panel-body">
            <table class="table text-center table-bordered table-hover" id="searchtable">
                <thead style="background-color: #337AB7; color: white; font-size: 14px;">
                <th style="border-right-color: #0b58a2">Customer Name</th>
                <th style="border-right-color: #0b58a2">Invoice Number</th>
                <th style="border-right-color: #0b58a2">Invoice Date</th>
                <th style="border-right-color: #0b58a2">Invoice Amount</th>
                <th style="border-right-color: #0b58a2">Paid Amount</th>
                <th style="border-right-color: #0b58a2">Amount Due</th>
                <th style="border-right-color: #0b58a2">Amount Applied</th>
                <th>Allocate Amount</th>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                        @php
                            $date = \Carbon\Carbon::parse($payment->created_at);
                            $date = $date->format('d-m-Y');

                        @endphp

                        <tr>
                            <td>{{$payment->customer_name}}</td>
                            <td><a href="/invoice/{{$payment->invoice_id}}/edit">{{$payment->invoice_number}}</a></td>
                            <td>{{$date}}</td>
                            <td>{{Form::text('payment_due_amount', number_format($payment->invoice_grand_total, 2, '.', ','), ['class' => 'form-control', 'style' => 'direction: rtl'])}}</td>
                            <td>{{Form::text('payment_due_amount', number_format($payment->invoice_paid_amount, 2, '.', ','), ['class' => 'form-control', 'style' => 'direction: rtl'])}}</td>
                            <td>{{Form::text('payment_due_amount', number_format($payment->invoice_due_amount, 2, '.', ','), ['class' => 'form-control', 'style' => 'direction: rtl'])}}</td>
                            <td>{{Form::text("$payment->invoice_number", null, ['class' => 'form-control ammt', 'style' => 'direction: rtl', 'id' => $payment->payment_id])}}</td>
                            <td><button class="btn-sm btn btn-primary" id="{{$payment->invoice_number}}" onclick="receive(this.id)">Allocate</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('body_scripts')
    <script>
        function receive(id) {
            var receivedValue = document.getElementById('received_amount');
            if (document.getElementById('received_amount').value !== "" && Number(document.getElementById('received_amount').value) > 0) {
                var vals = document.getElementsByClassName('ammt');
                document.getElementsByName(id).val = receivedValue;
            }
        }
    </script>
@endpush