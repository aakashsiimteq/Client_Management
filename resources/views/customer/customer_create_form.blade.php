<div class="row">
    <div class="col-md-4">
        {{Form::label('customer_no', 'Customer no.')}}
        {{Form::text('customer_no', $cust_no ,['class' => 'form-control', 'for' => 'customer_no', 'readonly'=>'true'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('customer_name', 'Name')}}
        {{Form::text('customer_name', null ,['class' => 'form-control', 'for' => 'customer_name'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('customer_type', 'Customer type')}}
        {{Form::select('customer_type', ['Company' => 'Company', 'Individual' => 'Individual', 'Other' => 'Other'], null ,['class' => 'form-control'])}}
    </div>
</div>

<div class="row" style="margin-top:2%;">
    <div class="col-md-4">
        {{Form::label('customer_abn_no', 'ABN no.')}}
        {{Form::text('customer_abn_no', null ,['class' => 'form-control', 'for' => 'customer_abn_no'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('customer_email', 'Email')}}
        {{Form::email('customer_email', null ,['class' => 'form-control', 'for' => 'customer_email'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('customer_contact_no', 'Contact no.')}}
        {{Form::number('customer_contact_no', null ,['class' => 'form-control', 'for' => 'customer_contact_no'])}}        
    </div>
</div>

<div class="row" style="margin-top:2%;">
    <div class="col-md-6">
        {{Form::label('customer_physical_address', 'Physical address')}}
        {{Form::textarea('customer_physical_address', null ,['class' => 'form-control', 'for' => 'customer_physical_address'])}}
    </div>
    <div class="col-md-6">
        {{Form::label('customer_billing_address', 'Billing address')}}
        {{Form::textarea('customer_billing_address', null ,['class' => 'form-control', 'for' => 'customer_billing_address'])}}
    </div>
</div>
<div class="row" style="margin-top:2%;">
    <div class="col-md-12">
        {{Form::submit('Register', ['class' => 'btn btn-primary btn-block'])}}
    </div>
</div>



