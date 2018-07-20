@extends('layout.index') @section('title', 'Customer')

@section('content')

    <div class="row">
        <div class="col-md-3">
            <label for="search_table" class="control-label">Search Customers</label>
            <input type="text" name="search_table" id="search_table" placeholder="Search Customers" class="form-control" />
        </div>
        <div class="col-md-9">
            <a href="{{url('admin/customer/create')}}" class="btn btn-primary pull-right" role="button">Add Customer</a>
        </div>
    </div>
<div class="panel panel-primary" style="margin-top:40px">
  <div class="panel-heading">
    <h3 class="panel-title">View Customer</h3>
  </div>
  <div class="panel-body">
    <table class="table text-center table-bordered table-hover" id="searchtable">
        <thead class="bg-primary" style="border: 1px solid #ccc">
            <tr>
                <th style="border: 1px solid #174993">#</th>
                <th style="border: 1px solid #174993">Customer number</th>
                <th style="border: 1px solid #174993">Name</th>
                <th style="border: 1px solid #174993">Type</th>
                <th style="border: 1px solid #174993">ABN no.</th>
                <th style="border: 1px solid #174993">Email</th>
                <th style="border: 1px solid #174993">Contact</th>
                <th style="border: 1px solid #174993">Action</th>
            </tr>
        </thead>
        @php
            $count = 0;
        @endphp
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td style="border: 1px solid #dedede">{{++$count}}</td>
                    <td style="border: 1px solid #dedede"><a href="customer/{{$customer->customer_id}}/edit">{{$customer->customer_number}}</a></td>
                    <td style="border: 1px solid #dedede">{{$customer->customer_name}}</td>
                    <td style="border: 1px solid #dedede">{{$customer->customer_type}}</td>
                    <td style="border: 1px solid #dedede">{{$customer->customer_abn_no or '-'}}</td>
                    <td style="border: 1px solid #dedede">{{$customer->customer_email or '-'}}</td>
                    <td style="border: 1px solid #dedede">{{$customer->customer_contact_no}}</td>
                    <td style="border: 1px solid #dedede">
                      {!!Html::linkRoute('customer.edit', 'Edit', array($customer->customer_id), array('class' => 'btn btn-primary btn-sm'))!!}
                      <div style="display: inline-block">
                        {!!Form::open(['route' => ['customer.destroy', $customer->customer_id], 'method' => 'DELETE'])!!}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm','onclick' => 'return confirm(\'Are you sure you want to delete\')'])}}
                        {!!Form::close()!!}
                      </div>
                      {!!Html::linkRoute('customer-project.edit', 'Add Project', array($customer->customer_id), array('class' => 'btn btn-warning btn-sm'))!!}

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>


@endsection
