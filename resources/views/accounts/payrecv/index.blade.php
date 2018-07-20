@extends('layout.index') @section('title', 'Payment Receive')
@section('content')
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <a class="btn btn-primary btn-sm pull-right" href="javascript:check()" style="margin-left: 2px;"><i class="fa fa-floppy-o"></i>&nbsp;Receive Payment</a>
                <a class="btn btn-info btn-sm pull-right" href="javascript:PaymentReceive.makeAdvancePayment()"><i class="fa fa-back"></i>&nbsp;Make Advance Payment</a>
            </div>
        </div>

    {{ Form::open(['url' => 'admin/payment-receive', 'method' => 'POST', 'name' => 'frmPayRec', 'id' => 'frmPayRec']) }}
    <div id="content" class="panel panel-primary" style="margin-top:40px; padding: 20px 20px;">
        <div class="row">
            <div class="col-lg-12">
                <table id='paymenttable'>
                    <tr>
                        <td width="56%">&nbsp{!!Form::label('amount_received', 'Amount Received',['style'=>'font-size: 20px;'])!!}&nbsp</td>
                        <td> {!!Form::number('amount_received', null, ['id'=>'amtrec', 'class'=>'form-control text-right', 'min'=>'0.0', 'required' => 'required', 'step'=>'0.01'])!!}</td>
                    </tr>
                    <tr id="paymenttype" style="margin-top: 10px;">
                        <td>&nbsp{!!Form::label('paymenttype','Payment Type ',['style'=>'font-size: 20px;'])!!}</td>
                        <td>{!!Form::select('paymenttype',['Payment' => 'Payment'],null, ['class'=>'form-control', 'data-size'=>"4", 'id'=>'paytype', 'onchange'=>'insertsr()']) !!}</td>
                    </tr>
                    <tr>
                        <td>&nbsp{!! Form::label('paymentmethod','Payment Method', ['style'=>'font-size: 20px;'])!!}</td>
                        <td>{!!Form::select('paymentmethod', ['Manual' => 'Manual','Card' => 'Card', 'Check'=>'Check'],null,['class'=>'form-control', 'data-size'=>"4", 'id'=>'paymethod'])!!}</td>
                    </tr>
                    <tr>
                        <td>&nbsp{!!Form::label('date','Payment Date',['style'=>'font-size: 20px;'])!!}</td>
                        <td>
                            {!! Form::date('date', null, ['class' => 'form-control', 'required'=>'1']) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp{!!Form::label('comments','Comments', ['style'=>'font-size: 20px;'])!!}</td>
                        <td><input type='textarea' rows='10' cols='60' name='comments' class="form-control"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div id="content">
        <table id="inv-table-data" class="table table-condensed table-bordered table-list margin-top-10" role="grid" aria-describedby="inv-table-data_info">
            <thead class="bg-primary" style="border: 1px solid #ccc">
                <tr role="row">
                    <th style="border: 1px solid #174993" class="text-center">Customer Name</th>
                    <th style="border: 1px solid #174993" class="text-center" width="20px">Invoice No</th>
                    <th style="border: 1px solid #174993" class="text-center">Invoice Date</th>
                    <th style="border: 1px solid #174993" class="text-center">Invoice Amount</th>
                    <th style="border: 1px solid #174993" class="text-center">Paid Amount</th>
                    <th style="border: 1px solid #174993" class="text-center">Amount Due</th>
                    <th style="border: 1px solid #174993" class="text-center">Amount Applied</th>
                    <th style="border: 1px solid #174993" class="text-center">Allocate Amount</th>
                </tr>
            </thead>
            <tbody style="border: 1px solid #dedede">
            @if(count($invoices) > 0)
                <?php
                $due_total = 0;
                ?>
                @foreach($invoices as $inv)
                        <tr role="row">
                            <td style="border: 1px solid #dedede" class="text-center">{{$inv->customer_name or ''}}</td>
                            <td style="border: 1px solid #dedede" class="text-center"><a href="/admin/invoice/{{$inv->invoice_id}}/edit" target="_blank">{{$inv->invoice_number}}</a></td>
                            <td style="border: 1px solid #dedede" class="text-center">{{\Carbon\Carbon::parse($inv->created_at)->toFormattedDateString()}}</td>
                            <td style="border: 1px solid #dedede" class="text-right">
                                <i class="fa fa-usd width-15 pull-left"></i>
                                {!! Form::number("inv_amount[$inv->invoice_id]", $inv->invoice_grand_total, ['class'=>'form-control input-xs text-right width-100', 'readonly'=>'1', 'min'=>'0.0', 'step'=>'0.01']) !!}
                            </td>
                            <td style="border: 1px solid #dedede" class="text-right">
                                <i class="fa fa-usd width-15 pull-left"></i>
                                {!! Form::number("inv_paid[$inv->invoice_id]", $inv->invoice_paid_amount, ['class'=>'form-control input-xs text-right width-100', 'readonly'=>'1', 'min'=>'0.0', 'step'=>'0.01']) !!}
                            </td>
                            <td style="border: 1px solid #dedede" class="text-right darker-bg">
                                <i class="fa fa-usd width-15 pull-left"></i>
                                {!! Form::number("due[$inv->invoice_id]", $inv->invoice_due_amount, ['class'=>'form-control input-xs text-right width-100', 'readonly'=>'1', 'min'=>'0.0', 'step'=>'0.01']) !!}
                                {!! Form::hidden("$inv->invoice_id", $inv->invoice_due_amount) !!}
                            </td>
                                <td style="border: 1px solid #dedede" class="text-right">
                                    <i class="fa fa-usd width-15 pull-left"></i>
                                    {!! Form::number("invoice_$inv->invoice_id", null, ['class'=>'form-control input-xs text-right width-100 aamt', "id"=>"inv_$inv->invoice_id", 'onblur'=>'checkClear(this.value)', 'min'=>'0.0', 'step'=>'0.01']) !!}
                                </td>
                                <td style="border: 1px solid #dedede" class="text-center">
                                    <input type="button" value="Allocate" id="a{{$inv->invoice_id}}" onclick="allocate(this.id)" class="btn btn-primary user-search allocate {{ $inv->office_id==1? "blue": "purple" }}">
                                </td>
                        </tr>
                @endforeach
            @else
                <tr class="row_body">
                    <td colspan="9">No Data</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    {{ Form::close() }}
@endsection

@push('body_scripts')
    <script>
        sr = "n";
        var customer_id = '{{ $customerid or 0 }}'
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