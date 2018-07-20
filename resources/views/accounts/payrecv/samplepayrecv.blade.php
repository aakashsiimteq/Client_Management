@extends('admin_diamond._layout.layout_sidebar')

@push('head_scripts')
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('assets/global/plugins/select2/css/select2.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" />
    <style>
        #paymenttable { width:100%; }
        #paymenttable td { padding-bottom: 10px; }
        #paymenttable .form-control { width:100%; }
        .select2-container { max-width:260px; }
        .table-scrollable { height:260px; overflow-y:auto; }
    </style>
@endpush
@push('head_links')
    <link rel="stylesheet" href="{{URL::asset('assets\layouts\global\css\responsive_inventory.css')}}">
@endpush
@push('body_scripts')
    <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/select2/js/select2.full.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ noc_asset('js/admin-diamond-accounts-common.js') }}" ></script>
    <script type="text/javascript" src="{{ noc_asset('js/admin-diamond-accounts-payrec.js') }}" ></script>
    <style>
        .resizetextarea{
            width:'50';
            height:'10';
        }
    </style>
    <script type="text/javascript">
        sr = "n";
        var customer_id = '{{ $customerid or 0 }}'
        var creditnoteurl = '{{ route("sales|admin.diamond.sales.advance-payment.get-advance-payment") }}'
        var customsalereturnurl = '{{ route("sales|admin.diamond.sales.custom-sale-return.get-custom-sale-return") }}'
        $(document).ready(function () {
            $(".select2-allow-clear").select2({
                allowClear: true,
                width: null
            });

            $('#inv-table-data').find('.group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).prop("checked", true);
                    } else {
                        $(this).prop("checked", false);
                    }
                });
                jQuery.uniform.update(set);
            });

            $('.date-picker').datepicker({
                format: "dd/mm/yyyy",
                endDate: "new",
                daysOfWeekDisabled: "0,6",
                daysOfWeekHighlighted: "1,2,3,4,5",
                calendarWeeks: true
            });
            $('#adv_payment_date').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
                singleDatePicker: true,
                calender_style: "picker_4"
            }, function (start, end, label) {
                $('#payment_date').val(start.format('DD/MM/YYYY'));
            });
        });

        var roundVal = function(val, precision) {
            var chg_val = parseFloat(val) * 100.0;
            var rnd = Math.round(chg_val) / 100.0;
            rnd = parseFloat(rnd.toFixed(precision));
            return rnd;
        };

        function insertsr() {
            if (document.getElementById("paytype").value == "Payment") {
                if (sr == "y") {
                    var row = document.getElementById("paymenttable").deleteRow(2);
                    sr = "n";
                }
                $('#amtrec').attr('disabled', false);
                $('#creditpayment_tr').hide();
            } else {
                if (sr == "n" && 1==0) {
                    var row = document.getElementById("paymenttable").insertRow(2);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);

                    // Add some text to the new cells:
                    cell1.innerHTML = "<td>SR NO:</td>";
                    cell2.innerHTML = "<td><input type='text' name='srno' class='form-control'></td>";
                    sr = "y";
                }
                var type = currency = '';
                if(document.getElementById("paytype").value == "Credit Note") {
                    type = 'Credit Note';
                    currency = document.getElementById("currency").value;
                } else if(document.getElementById("paytype").value == "Advance Payment") {
                    type = 'Advance Payment';
                    currency = document.getElementById("currency").value;
                } else if(document.getElementById("paytype").value == "Custom Sale Return") {
                    type = 'Custom Sale Return';
                    currency = document.getElementById("currency").value;
                }
                // $('#amtrec').attr('disabled', true);
                if (type == 'Custom Sale Return') {
                    $.ajax({
                        url : customsalereturnurl,
                        type: 'POST',
                        data: {
                            customer_id: customer_id,
                            type: type,
                            currency: currency
                        },
                        success: function (res) {
                            $('#customsalereturnpayment').html('');
                            if (res.data.length > 0) {
                                var options = '';
                                if (res.data.length > 0) {
                                    $.each(res.data, function (i, v) {
                                        var amount = roundVal(v.invoice_final_amount * v.invoice_ratio, 2);
                                        var currency = (v.invoice_currency == 'USD') ? '$' : 'A$';
                                        options += '<option value="' + v.invoice_return_id + '" data-subtext=" '+v.invoice_code+'" data-icon="glyphicon-'+v.invoice_currency.toLowerCase()+'" data-val="' + amount + '"> &nbsp; ' + amount.toFixed(2) + '</option>';
                                    });
                                }
                                $('#customsalereturnpayment').append(options);
                            } else {
                                $('#customsalereturnpayment').html('<option value="">Select Credit</option>');
                            }
                            $('#customsalereturnpayment').selectpicker('refresh');
                            $('#customsalereturn_tr').show();
                        }
                    });
                }else {
                    $.ajax({
                        url : creditnoteurl,
                        type: 'POST',
                        data: {
                            customer_id: customer_id,
                            type: type,
                            currency: currency
                        },
                        success: function (res) {
                            $('#creditpayment').html('');
                            if (res.data.length > 0) {
                                var options = '';
                                if (res.data.length > 0) {
                                    $.each(res.data, function (i, v) {
                                        var amount = roundVal(v.amount_available * v.ratio, 2);
                                        var currency = (v.currency == 'USD') ? '$' : 'A$';
                                        options += '<option value="' + v.credit_note_id + '" data-subtext=" '+v.credit_note_code+'" data-icon="glyphicon-'+v.currency.toLowerCase()+'" data-val="' + amount + '"> &nbsp; ' + amount.toFixed(2) + '</option>';
                                    });
                                }
                                $('#creditpayment').append(options);
                            } else {
                                $('#creditpayment').html('<option value="">Select Credit</option>');
                            }
                            $('#creditpayment').selectpicker('refresh');
                            $('#creditpayment_tr').show();
                        }
                    });
                }
            }
        }

        var card = "n"
        function insertcard() {
            if (document.getElementById("paymethod").value == "74") {
                var srow = (sr == "y")? 4: 3;
                if (card == "n") { //alert(sr);
                    var row = document.getElementById("paymenttable").insertRow(srow);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    cell1.innerHTML = "<td>Card NO:</td>";
                    cell2.innerHTML = "<td><input type='text' name='cardno' class='form-control'></td>";
                    row = document.getElementById("paymenttable").insertRow(srow + 1);
                    cell1 = row.insertCell(0);
                    cell2 = row.insertCell(1);
                    cell1.innerHTML = "<td>Expiry Date:</td>";
                    cell2.innerHTML = "<td><input type='text' name='expirydate' class='form-control'></td>";
                    row = document.getElementById("paymenttable").insertRow(srow + 2);
                    cell1 = row.insertCell(0);
                    cell2 = row.insertCell(1);
                    cell1.innerHTML = "<td>Name on Card:</td>";
                    cell2.innerHTML = "<td><input type='text' name='nameoncard' class='form-control'></td>";
                    row = document.getElementById("paymenttable").insertRow(srow + 3);
                    cell1 = row.insertCell(0);
                    cell2 = row.insertCell(1);
                    cell1.innerHTML = "<td>Authorisation Code:</td>";
                    cell2.innerHTML = "<td><input type='text' name='authorisationcode' class='form-control'></td>";
                    card = "y";
                }
            } else {
                if (card == "y") {
                    var row = document.getElementById("paymenttable").deleteRow(srow + 3);
                    row = document.getElementById("paymenttable").deleteRow(srow + 2);
                    row = document.getElementById("paymenttable").deleteRow(srow + 1);
                    row = document.getElementById("paymenttable").deleteRow(srow);
                    card = "n";
                }
            }
        }

        function checkClear(val) { //alert("onblur");
            if (val == '') {
                $('.allocate').each(function(){
                    $('.allocate').prop('disabled', false);
                });
                $("input[name^=invoice_]").each(function(){
                    $(this).prop('disabled', false);
                });
            }
        }
        function allocate(id) {
            var paytype = document.getElementById("paytype").value;
            var amtRec = document.getElementById("amtrec").value;

            if (document.getElementById("amtrec").value !== "" && Number(document.getElementById("amtrec").value) > 0) {
                if (paytype =="Custom Sale Return") {
                    var invoice_id = id.substr(1);

                    var amtrec = roundNumber(Number(document.getElementById("amtrec").value));
                    var amt_due = document.getElementsByName("due["+invoice_id+"]")[0].value;

                    if (amt_due >= amtrec) {
                        var amount_left = amt_due - amtRec;
                        document.getElementsByName("invoice_" + invoice_id)[0].value = amtRec;
                        $('.allocate').each(function(){
                            $('.allocate').prop('disabled', true);
                        });
                        $("input[name^=invoice_]").each(function(){
                            if($(this).val()!= amtrec){
                                $(this).prop('disabled', true);
                            }
                        });
                    }else {
                        $("#error_div").html("Amount due cannot be less then custom sale return amount");
                        $('#error_dlg').modal('show');
                        return false;
                    }
                }else {
                    if($("#paymenttype").val() == 'Advance Payment' && amtrec > $("#creditpayment").data('val')){
                        $("#error_div").html("Amount received cannot be greater than selected credit amount");
                        $('#error_dlg').modal('show');
                        return false;
                    }
                    var vals = document.getElementsByClassName("aamt");
                    var amt_allocated = 0;
                    document.getElementsByName("invoice_" + id.substr(1))[0].value = 0;

                    for (i = 0; i < vals.length; i++) {
                        amt_allocated += Number(vals[i].value);
                    }
                    var amtrec = roundNumber(Number(document.getElementById("amtrec").value));
                    var amt_left = roundNumber(amtrec - amt_allocated);

                    if (amt_left > 0) {
                        amt_due = roundNumber(Number(document.getElementsByName(id.substr(1))[0].value));
                        if (amt_left > amt_due) {
                            document.getElementsByName("invoice_" + id.substr(1))[0].value = amt_due;
                        } else {
                            document.getElementsByName("invoice_" + id.substr(1))[0].value = amt_left;
                        }
                    } else {
                        $("#error_div").html("No Amount is left for allocation");
                        $('#error_dlg').modal('show');
                    }
                }
            } else {
                $("#error_div").html("Amount received cannot be blank or zero");
                $('#error_dlg').modal('show');
            }
        }

        function check() {
            var vals = document.getElementsByClassName("aamt");
            var amt_allocated = 0;
            var amtrec = roundNumber(Number(document.getElementById("amtrec").value));

            if (amtrec > 0) {
                if($("#paytype").val() == 'Advance Payment' && amtrec > $("#amtrec").attr('max')){
                    $("#error_div").html("Amount received cannot be greater than selected credit amount");
                    $('#error_dlg').modal('show');
                    return false;
                }
                for (i = 0; i < vals.length; i++) {
                    amt_due = Number(document.getElementsByName(vals[i].name.substr(8))[0].value);

                    amt_allocated += Number(vals[i].value);
                    if (Number(vals[i].value) > amt_due && amt_due >= 0) {
                        $("#error_div").html("Amount allocated is more than amount due " + vals[i].value);
                        $('#error_dlg').modal('show');
                        return;
                    }
                }
                amt_allocated = roundNumber(amt_allocated);
                if (amt_allocated <= 0) {
                    $("#error_div").html("Allocate amount received to atleast one item");
                    $('#error_dlg').modal('show');
                }
                if (Math.abs(amt_allocated - amtrec) > 0.00001) {
                    $("#error_div").html("Total amount allocated is " + amt_allocated + "<br> While amount received is " + amtrec + "<br> Please rectify the issue and submit again");
                    $('#error_dlg').modal('show');
                } else {
                    document.getElementById("frmPayRec").submit();
                }
            } else {
                $("#error_div").html("Amount received should not be empty or zero");
                $('#error_dlg').modal('show');
                return;
            }
        }
        function roundNumber(number, decimal) {
            if (decimal === undefined || decimal === '')
                decimal = 2;
            var val = Math.round(parseFloat(number)*100.0)/100.0;
            return parseFloat(val.toFixed(decimal));
        }
    </script>
@endpush


@section('content-breadcrumb')
    <ul class="page-breadcrumb">
        <li>Accounts <i class="fa fa-angle-double-right"></i></li>
        <li><span>{{$title}}</span></li>
    </ul>
@endsection

@section('content-bar')
    <?php
    $cls_enable_when_exist = (empty($invoices) || count($invoices)==0)? 'disabled': '';
    $cls_enable_when_customer = (empty($customerid)? 'disabled': '');
    ?>
    <div class="page-toolbar">
        <div class="row border-green">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a class="btn btn-info btn-sm {{$cls_enable_when_customer}}" href="javascript:PaymentReceive.makeAdvancePayment()"><i class="fa fa-back"></i>&nbsp;Make Advance Payment</a>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                &nbsp;
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a class="btn btn-primary btn-sm {{$cls_enable_when_exist}}" href="javascript:check()"><i class="fa fa-floppy-o"></i>&nbsp;Receive Payment</a>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                &nbsp;
            </div>
        </div>
    </div>
@endsection

@section('content-header')
    <div class="row">
        <?php
        $icons = array('Active' => 'success', 'Inactive' => 'default');
        ?>
        {{ Form::open(['url' => URL::current(), 'method' => 'GET', 'name' => 'frmUserSearch','class' => "form-horizontal"]) }}
        {{ Form::hidden("command", "page-search") }}
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <h3 class="page-title">{{$title}}  <small> listing</small></h3>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            @include('admin_diamond.accounts.payrec.incl_search_section')
        </div>
        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 scrollable">
            @if((!empty($credit_notes) && count($credit_notes)>0) || (!empty($custom_sales) && count($custom_sales) > 0))
                <table class="table table-condensed table-bordered table-list blue-header margin-top-10">
                    <thead>
                    <tr>
                        <th class="nowrap text-center">Code</th>
                        <th class="nowrap text-center">Date</th>
                        <th class="nowrap text-center">Sale Return</th>
                        <th class="nowrap text-center">Amount</th>
                        <th class="nowrap text-center">Refunded</th>
                        <th class="nowrap text-center">Available</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($credit_notes as $cnote)
                        <?php
                        $curr = $cnote->currency;
                        $cnote_amount = $cnote->amount * $cnote->ratio;
                        $cnote_amount_avl = $cnote->amount_available * $cnote->ratio;
                        $cnote_amount_refund = $cnote->amount_refund * $cnote->ratio;
                        ?>
                        <tr>
                            <td class="nowrap text-left">{{ $cnote->credit_note_code }}</td>
                            <td class="nowrap text-left">{{ format_date($cnote->credit_datetime, $date_format) }}</td>
                            <td class="nowrap text-left">{{ $cnote->sales_return_document }}</td>
                            <td class="nowrap text-right"><i class="fa fa-{{tolower($curr)}} pull-left"></i>{{ round_number_format($cnote->amount * $cnote->ratio) }}</td>
                            <td class="nowrap text-right"><i class="fa fa-{{tolower($curr)}} pull-left"></i>{{ round_number_format($cnote_amount_refund) }}</td>
                            <td class="nowrap text-right darker-bg"><i class="fa fa-{{tolower($curr)}} pull-left"></i>{{ round_number_format($cnote_amount_avl) }}</td>
                        </tr>
                    @endforeach
                    @if (isset($custom_sales))
                        @if (!empty($custom_sales) && count($custom_sales) > 0)
                            @foreach($custom_sales as $csale)
                                @php
                                    $curr = $csale->invoice_currency;
                                @endphp
                                <tr>
                                    <td class="nowrap text-left">{{ $csale->invoice_code }}</td>
                                    <td class="nowrap text-left">{{ format_date($csale->invoice_datetime, $date_format) }}</td>
                                    <td class="nowrap text-left">{{ $csale->invoice_code }}</td>
                                    <td class="nowrap text-right"><i class="fa fa-{{tolower($curr)}} pull-left"></i>{{ round_number_format($csale->invoice_final_amount * $csale->invoice_ratio) }}</td>
                                    <td class="nowrap text-right"><i class="fa fa-{{tolower($curr)}} pull-left"></i>0.00</td>
                                    <td class="nowrap text-right darker-bg"><i class="fa fa-{{tolower($curr)}} pull-left"></i>{{ round_number_format($csale->invoice_final_amount * $csale->invoice_ratio) }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endif
                    </tbody>
                </table>
            @endif
        </div>
        {{ Form::close() }}
    </div>
@endsection

@section('content')
    @if(Session::has('iflash_message'))
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p class="alert alert-info">{{ Session::get('iflash_message') }}</p>
            </div>
        </div>
    @endif

    @if (sizeof($invoices)>0)
        {{ Form::open(['class' => "form-inline",'url' => '/admin/diamond/accounts/payment-receive', 'method' => 'POST', 'name' => 'frmPayRec', 'id' => 'frmPayRec']) }}
        <div id="content" class="m-heading-1 border-blue m-bordered">
            <div class="row">
                <div class="col-lg-4">
                    <table id='paymenttable'>
                        <tr>
                            <td>&nbsp{!!Form::label('Amount Received')!!}&nbsp</td>
                            <td> {!!Form::number('amount_received', null, ['id'=>'amtrec', 'class'=>'form-control input-sm text-right', 'min'=>'0.0', 'required' => 'required', 'step'=>'0.01'])!!}</td>
                        </tr>
                        <tr id="paymenttype">
                            <td>&nbsp{!!Form::label('Payment Type ')!!}</td>
                            <td>{!!Form::select('paymenttype',['Payment' => 'Payment', 'Credit Note' => 'Credit Note', 'Advance Payment' => 'Advance Payment','Custom Sale Return'=>'Custom Sale Return'],null, ['class'=>'form-control input-sm selectpicker', 'data-size'=>"4", 'id'=>'paytype', 'onchange'=>'insertsr()']) !!}</td>
                        </tr>
                        <tr id="creditpayment_tr" style='display: none;'>
                            <td>&nbsp{!!Form::label('Credit Available ')!!}</td>
                            <td>{!!Form::select('creditpayment', [], null, ['class'=>'form-control input-sm selectpicker', 'data-size'=>"4", 'onchange'=>'javascript:PaymentReceive.insertAmtrec(this);','id'=>'creditpayment','title'=>'Select Credit','placeholder'=>'Select Credit'])!!}</td>
                        </tr>
                        <tr id="customsalereturn_tr" style='display: none;'>
                            <td>&nbsp{!!Form::label('Custom Sale Return Available ')!!}</td>
                            <td>{!!Form::select('customsalereturnpayment', [], null, ['class'=>'form-control input-sm selectpicker', 'data-size'=>"4", 'onchange'=>'javascript:PaymentReceive.insertAmtrec(this);','id'=>'customsalereturnpayment','title'=>'Select Custom Sale Return','placeholder'=>'Select Custom Sale Return'])!!}</td>
                        </tr>
                        <tr>
                            <td>&nbsp{!! Form::label('Payment Method')!!}</td>
                            <td>{!!Form::select('paymentmethod', ['73' => 'Manual','74' => 'Card'],null,['class'=>'form-control input-sm selectpicker', 'data-size'=>"4", 'id'=>'paymethod'])!!}</td>
                        </tr>
                        <tr>
                            <td>&nbsp{!!Form::label('Payment Date')!!}</td>
                            <td>
                                {!! Form::text('date', date($date_format), ['class' => 'form-control input-sm date-picker', 'required'=>'1']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp{!!Form::label('Comments')!!}</td>
                            <td><input type='textarea' rows='10' cols='60' name='comments' class="form-control"></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4">

                </div>
                <div class="col-lg-4">

                </div>
            </div>
        </div>
        <div id="content" class="m-heading-1 scrollable">
            <table id="inv-table-data" class="table table-condensed table-bordered table-list blue-header margin-top-10" role="grid" aria-describedby="inv-table-data_info">
                <thead>
                <tr role="row">
                    <th class="nowrap text-center">Customer Name</th>
                    <th class="nowrap text-center" width="20px">Invoice No</th>
                    <th class="nowrap text-center">Invoice Date</th>
                    <th class="nowrap text-center">Invoice Amount</th>
                    <th class="nowrap text-center">Paid Amount</th>
                    <th class="nowrap text-center">Sale Return</th>
                    <th class="nowrap text-center">Credit Note</th>
                    <th class="nowrap text-center">C'Note Applied</th>
                    <th class="nowrap text-center">Amount Due</th>
                    <th class="nowrap text-center">Amount Applied</th>
                    <th class="nowrap text-center">Allocate Amount</th>
                </tr>
                </thead>
                <tbody>
                @if(count($invoices) > 0)
                    <?php
                    $due_total = 0;
                    ?>
                    @foreach($invoices as $inv)
                        @if($inv->invoice_status != 'Converted')
                            <?php
                            $inv_curr = $inv->invoice_currency;
                            $invoice_final_amount = floatval($inv->invoice_final_amount) * floatval($inv->invoice_ratio);
                            $invoice_paid_amount = floatval($inv->paid_amount);
                            $invoice_return_amount = floatval($inv->return_amount);
                            $invoice_creditnote_amount = floatval($inv->creditnote_amount);
                            $credit_note_applied_amount = (!empty($inv->credit_note_applied_amount)) ? $inv->credit_note_applied_amount: 0.00;

                            $total_paid_amount = $invoice_paid_amount + $credit_note_applied_amount + $invoice_return_amount;
                            $invoice_due_amount = ($invoice_final_amount - $total_paid_amount + $invoice_creditnote_amount);

                            $due_total += $invoice_due_amount;
                            ?>

                            <tr role="row">
                                <td>{{$inv->customer_and_company->company_name or ''}}</td>
                                <td class="text-center"><a href="/admin/diamond/sales/invoices/{{$inv->invoice_id}}" target="_blank">{{$inv->invoice_code}}</a></td>
                                <td class="text-center">{{format_date($inv->invoice_datetime, $date_format)}}</td>
                                <td class="text-right">
                                    <i class="fa fa-{{tolower($inv_curr)}} width-15 pull-left"></i>
                                    {!! Form::number("inv_amount[$inv->invoice_id]", round_number_format($invoice_final_amount), ['class'=>'form-control input-xs text-right width-100', 'readonly'=>'1', 'min'=>'0.0', 'step'=>'0.01']) !!}
                                </td>
                                <td class="text-right">
                                    <i class="fa fa-{{tolower($inv_curr)}} width-15 pull-left"></i>
                                    {!! Form::number("inv_paid[$inv->invoice_id]", round_number_format($invoice_paid_amount), ['class'=>'form-control input-xs text-right width-100', 'readonly'=>'1', 'min'=>'0.0', 'step'=>'0.01']) !!}
                                </td>
                                <td class="text-right">
                                    <i class="fa fa-{{tolower($inv_curr)}} width-15 pull-left"></i>
                                    {!! Form::number("inv_return[$inv->invoice_id]", round_number_format($invoice_return_amount), ['class'=>'form-control input-xs text-right width-100', 'readonly'=>'1', 'min'=>'0.0', 'step'=>'0.01']) !!}
                                </td>
                                <td class="text-right">
                                    <i class="fa fa-{{tolower($inv_curr)}} width-15 pull-left"></i>
                                    {!! Form::number("cnote[$inv->invoice_id]", round_number_format($invoice_creditnote_amount), ['class'=>'form-control input-xs text-right width-100', 'readonly'=>'1', 'min'=>'0.0', 'step'=>'0.01']) !!}
                                </td>
                                <td class="text-right">
                                    <i class="fa fa-{{tolower($inv_curr)}} width-15 pull-left"></i>
                                    {!! Form::number("cnote_applied[$inv->invoice_id]", round_number_format($credit_note_applied_amount), ['class'=>'form-control input-xs text-right width-100', 'readonly'=>'1', 'min'=>'0.0', 'step'=>'0.01']) !!}
                                </td>
                                <td class="text-right darker-bg">
                                    <i class="fa fa-{{tolower($inv_curr)}} width-15 pull-left"></i>
                                    {!! Form::number("due[$inv->invoice_id]", round_number_format($invoice_due_amount), ['class'=>'form-control input-xs text-right width-100', 'readonly'=>'1', 'min'=>'0.0', 'step'=>'0.01']) !!}
                                    {!! Form::hidden("$inv->invoice_id", round_number_format($invoice_due_amount)) !!}
                                </td>
                                @if($inv->invoice_status == "Closed" || $invoice_due_amount <= 0 )
                                    <td class="text-right">
                                        {!! Form::number("invoice_$inv->invoice_id", null, ['class'=>'form-control input-xs text-right width-100 aamt', 'readonly'=>'1', 'min'=>'0.0', 'step'=>'0.01']) !!}
                                    </td>
                                    <td class="text-right"></td>
                                @else
                                    <td class="text-right">
                                        <i class="fa fa-{{tolower($inv_curr)}} width-15 pull-left"></i>
                                        {!! Form::number("invoice_$inv->invoice_id", null, ['class'=>'form-control input-xs text-right width-100 aamt', "id"=>"inv_$inv->invoice_id", 'onblur'=>'checkClear(this.value)', 'min'=>'0.0', 'step'=>'0.01']) !!}
                                    </td>
                                    <td class="text-center">
                                        <input type="button" value="Allocate" id="a{{$inv->invoice_id}}" onclick="allocate(this.id)" class="btn btn-xs user-search allocate {{ $inv->office_id==1? "blue": "purple" }}">
                                    </td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                    <tr class="row_body">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="text-right"><b>Total Amount Due:</b></td>
                        <td class="text-right darker-bg">
                            <i class="fa fa-{{tolower($invoices->first()->invoice_currency)}} width-15 pull-left"></i>
                            <b>{!! Form::number("due_total", round_number_format($due_total), ['class'=>'form-control input-xs text-right width-100 blue', 'readonly'=>'1', 'min'=>'0.0', 'step'=>'0.01']) !!}</b>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                @else
                    <tr class="row_body">
                        <td colspan="9">No Data</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        {{ Form::close() }}

    @elseif ($customerid != '')
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p class="alert alert-danger">No invoices found.</p>
            </div>
        </div>
    @endif
@endsection

@push('modal_data')
    <div class="modal fade" id="dlg_add_item" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-link pull-right" style='color: lightgray;' data-dismiss="modal"><i class="fa fa-times"></i></button>
                    <h4 class="modal-title">Make Advance Payment</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::open(['method' => 'POST', 'url' => route('sales|admin.diamond.sales.advance-payment.save-advance-payment'), 'class' => 'form-horizontal', 'id' => 'advance_payment_frm'])}}
                            {{ Form::hidden('customer_id',null,['id' => 'advance_customer_id']) }}
                            {{ Form::hidden('currency', !empty($currency) ? $currency : '',['id' => 'advance_currency']) }}
                            {{ Form::hidden('companyid', null) }}
                            {{ Form::hidden('type','Advance Payment',['id' => 'advance_type']) }}
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><span class="required">*</span> Amount:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name='advance_amount' id="advance_amount" placeholder="Amount">
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('payment_date', '* Payment Date', array('class' => 'col-sm-3 control-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('adv_payment_date', null, ['id'=>'adv_payment_date', 'required'=> 'required', 'class' => 'form-control', 'placeholder' => 'Payment Date', 'required'=>'1']) !!}
                                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true" style="margin-top: 10px; margin-right:16px"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Comments:</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" placeholder="Comments" name='comment'></textarea>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn blue" data-dismiss="modal" onclick='javascript:PaymentReceive.submitAdvancePaymentFrm()'>Make Payment</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="error_dlg" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-link pull-right" style='color: lightgray;' data-dismiss="modal"><i class="fa fa-times"></i></button>
                    <h4 class="modal-title">Alert</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="error_div"></div><br><br>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss="modal">Ok</a>
                </div>
            </div>
        </div>
    </div>
@endpush
