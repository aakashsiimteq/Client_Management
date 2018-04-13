@extends('layout.index') @section('title', 'Customer')

@section('content')

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
    <tbody>
        @foreach($customers as $customer)
            <tr>
                <td>{{$customer->customer_id}}</td>
                <td>{{$customer->customer_number}}</td>
                <td>{{$customer->customer_name}}</td>
                <td>{{$customer->customer_type}}</td>
                <td>{{$customer->customer_abn_no}}</td>
                <td>{{$customer->customer_email}}</td>
                <td>{{$customer->customer_contact_no}}</td>
                <td><button class="btn btn-sm btn-warning" style="margin-right:3px;">Edit</button><button class="btn btn-sm btn-danger">Delete</button></td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
