@extends('layout.index') @section('title', 'Invoices')

@section('content')
    @php
        $count = 0;
    @endphp
    <p class="text-right"><button class="btn btn-primary btn-md">Make custom invoice</button></p>
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">View Invoices</h3>
      </div>
      <div class="panel-body">
        <table class="table text-center table-hover table-bordered">
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
                <th>Action</th>
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
                            <button class="btn btn-sm btn-warning">Print</button>
                        </td>
                    </tr>
                @endforeach
                <tr></tr>
            </tbody>
        </table>
      </div>
    </div>
@endsection
