@extends('layout.index') @section('title', 'Project')

@section('content')
<a href="/customer/create" class="btn btn-primary btn-lg pull-right" role="button" style="margin-bottom:2%;">Add</a>
<table class="table text-center">
    <thead>
        <th>Sr no.</th>
        <th>Customer number</th>
        <th>Name</th>
        <th>Type</th>
        <th>ABN no.</th>
        <th>Email</th>
        <th>Contact</th>
        <th></th>
    </thead>
    @php
        $count = 0;
    @endphp
    <tbody>
        @foreach($projects as $project)
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
                        {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])}}
                    {!!Form::close()!!}
                  </div>
                  {!!Html::linkRoute('customer-project.edit', 'Add Project', array($customer->customer_id), array('class' => 'btn btn-warning btn-sm'))!!}
                  
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection