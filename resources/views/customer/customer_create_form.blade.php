<div class="row">
    <div class="col-md-4">
        {{Form::label('customer_no', 'Customer no.')}}
        {{Form::text('customer_no', $cust_no ,['class' => 'form-control', 'for' => 'customer_no', 'readonly'=>'true'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('customer_name', 'Name')}}
        {{Form::text('customer_name', null ,['class' => 'form-control', 'for' => 'customer_name', 'required' => 'true','placeholder' => 'Customer Name'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('customer_type', 'Customer type')}}
        {{Form::select('customer_type', ['Company' => 'Company', 'Individual' => 'Individual'], 'customer_type' ,['class' => 'form-control', 'required' => 'true','placeholder' => 'Select Customer Type'])}}
    </div>
</div>

<div class="row" style="margin-top:2%;">
    <div class="col-md-4">
        {{Form::label('customer_abn_no', 'ABN no.')}}
        {{Form::text('customer_abn_no', null ,['class' => 'form-control', 'for' => 'customer_abn_no', 'placeholder' => 'ABN no.','maxlength' => '11','onkeypress' => 'return isNumberKey(event)'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('customer_email', 'Email')}}
        {{Form::email('customer_email', null ,['class' => 'form-control', 'for' => 'customer_email','placeholder' => 'Customer Email'])}}
    </div>
    <div class="col-md-4">
        {{Form::label('customer_contact_no', 'Contact no.')}}
        {{Form::text('customer_contact_no', null ,['class' => 'form-control', 'for' => 'customer_contact_no', 'placeholder' => 'Customer Contact Number' ,'maxlength' => '10','onkeypress' => 'return isNumberKey(event)'])}}
    </div>
</div>

<div class="row" style="margin-top:2%;">
    <div class="col-md-6">
        {{Form::label('customer_physical_address', 'Physical address')}}
        {{Form::textarea('customer_physical_address', null ,['class' => 'form-control', 'for' => 'customer_physical_address', 'rows' => '6','placeholder' => 'Customer Physical Address'])}}
    </div>
    <div class="col-md-6">
        {{Form::label('customer_billing_address', 'Billing address')}}
        {{Form::textarea('customer_billing_address', null ,['class' => 'form-control', 'for' => 'customer_billing_address', 'rows' => '6','placeholder' => 'Customer Billing Address', 'required' => 'true'])}}
    </div>
</div>
<div class="row" style="margin-top:2%;">
    <div class="col-md-12">
      <div class="col-md-6">
        {{Form::submit('Register', ['class' => 'btn btn-primary btn-block'])}}
      </div>
      <div class="col-md-6">
        <button type="reset" name="button" class="btn btn-info btn-block">Reset Form</button>
      </div>
    </div>
</div>
