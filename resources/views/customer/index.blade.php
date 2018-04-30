@extends('layout.index') @section('title', 'Customer')

@section('content')
<a href="/customer/create" class="btn btn-primary pull-right" role="button">Add Customer</a>
<div class="panel panel-primary" style="margin-top:40px">
  <div class="panel-heading">
    <h3 class="panel-title">View Customer</h3>
  </div>
  <div class="panel-body">
    <table class="table text-center table-bordered table-hover">
        <thead>
            <th>Sr no.</th>
            <th>Customer number</th>
            <th>Name</th>
            <th>Type</th>
            <th>ABN no.</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Action</th>
        </thead>
        @php
            $count = 0;
        @endphp
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{++$count}}</td>
                    <td>{{$customer->customer_number}}</td>
                    <td>{{$customer->customer_name}}</td>
                    <td>{{$customer->customer_type}}</td>
                    <td>{{$customer->customer_abn_no}}</td>
                    <td>{{$customer->customer_email}}</td>
                    <td>{{$customer->customer_contact_no}}</td>
                    <td>
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
