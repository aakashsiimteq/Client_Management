@extends('Print._print_header')

@section('page_title')
    <hr width="70%" />
    <table width="70%" border="0" cellpadding="0" cellspacing="0" class="table-condensed bg-white table_print" align="center">
        <br>
        <br>
        <tr>

            <td align="left" width="45%">

                <table cellpadding="0" width="100%" border="0" class="table-condensed bg-white">
                    <tr><td style="border:1px solid #000;"><span class="nl-font-quot"><b>{{ $invoice_data->customer_name  or "-" }}</b></span><br />
                            <span><b>{{ $invoice_data->invoice_billing_address or "-" }}</b>,<br />

                        </span>
                        </td>
                    </tr>
                </table>
            </td>

            <td align="left" width="10%" ></td>
            <td align="left" width="20%" >
                <table cellpadding="0" cellspacing="0" width="100%" border="0" class="table-condensed bg-white">
                    <tr>
                      <td style="border:1px solid #000;" >&nbsp;&nbsp;&nbsp;Invoice Date :&nbsp;&nbsp;&nbsp;</td>
                        <td style="border:1px solid #000;">{{ date('F j, Y',strtotime($invoice_data->invoice_date)) }}</td>
                    </tr>
                    <tr>
                      <td style="border:1px solid #000;">&nbsp;&nbsp;&nbsp;Invoice No :&nbsp;&nbsp;&nbsp;</td>
                        <td style="border:1px solid #000;">{{ $invoice_data->invoice_number }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

@endsection
@section('page_body')
    &nbsp;<br/>
    <table width="70%" border="1" class="table table-bordered table-condensed bg-white" align="center">
        <tr class="gmattersmallest">
            <th style="border:1px solid #000;" height="20" width="15%" class="nl-title-font">Sr.No</th>

            <th style="border:1px solid #000;" height="20" width="17%" class="nl-title-font">Description</th>
            <th style="border:1px solid #000;" height="20" width="17%" class="nl-title-font">Per Hour Cost</th>
            <th style="border:1px solid #000;" height="20" width="17%" class="nl-title-font">Amount</th>
        </tr>
        <?php
          $cnt = 1;
         ?>
        @if(isset($invoice_data))

                    <tr class="gmattersmallest" style="border:1px solid #000;">
                        <td height="20" align="center" style="border:1px solid #000;">{{ $cnt }}</td>

                        <td height="20" align="left" style="border:1px solid #000;">{{ $invoice_data->project_name or "-" }} - {{$invoice_data->project_details or "-"}}</td>
                        <td height="20" align="center" style="border:1px solid #000;">{{ $invoice_data->project_per_hour_cost or "-" }}</td>
                        <td height="20" align="right" style="border:1px solid #000;">AUD $&nbsp;&nbsp;{{number_format($invoice_data->invoice_final_cost, 2, '.', ',')}}</td>
                    </tr>
                    @for($i=1; $i < 10;$i++)
                    <tr class="gmattersmallest">
                        <td height="20" align="center" style="border:1px solid #000;">&nbsp;</td>
                        <td height="20" align="left" style="border:1px solid #000;">&nbsp;</td>
                        <td height="20" align="left" style="border:1px solid #000;">&nbsp;</td>

                        <td height="20" align="right" style="border:1px solid #000;">&nbsp;</td>
                    </tr>
                    @endfor

                    <tr class="gmattersmallest">
                        <td height="20" align="right" style="border:1px solid #000;" colspan="3"> GST : </td>
                        <td height="20" align="right" style="border:1px solid #000;">{{number_format($invoice_data->invoice_gst_rate,2)}}</td>
                    </tr>
                    <?php
                    $gst_amount = $invoice_data->invoice_gst_rate * $invoice_data->invoice_final_cost / 100;
                    $total = $invoice_data->invoice_final_cost + $gst_amount;

                    ?>
                    <tr class="gmattersmallest">
                        <td height="20" align="right" style="border:1px solid #000;" colspan="3"> Total : </td>
                        <td height="20" align="right" style="border:1px solid #000;">{{number_format($total,2)}}</td>
                    </tr>

          @endif



    </table>



@endsection
