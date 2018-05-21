@extends('layout.index') @section('title', 'Welcome')

@section('content') @section('sidetitle', 'EMS')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$customer_count}}</h3>

                    <p>Customers</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('customer.index')}}" class="small-box-footer">
                    Customer listing <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$project_count}}</h3>
    
                    <p>Projects</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('project.index')}}" class="small-box-footer">
                    Project listing <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$invoice_count}}</h3>
    
                    <p>Invoices</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="{{route('invoice.index')}}" class="small-box-footer">
                    Invoice listing <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$custom_invoice_count}}</h3>
    
                    <p>Custom invoices</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="{{route('custom-invoice.index')}}" class="small-box-footer">
                    Custom invoice listing <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
