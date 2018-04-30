@extends('Print._print')

@section('title', 'Print')

@push('head_style')
<style>
   body {
      font-family: sans-serif;
      font-size: 10pt;
   }
   .table {
      border-collapse: collapse;
      border-spacing: 0px 0px;
   }
   .bg-white {
      background-color: #ffffff;
      border-color: #ffffff;
   }
   .bg-grey {
      background-color: #cfcfcf;
      border-color: #cfcfcf;
   }
   .border-grey {
      border: 1px solid #cfcfcf;
   }
   .bg-dark-grey {
      background-color: #c6c6c6;
      border-color: #c6c6c6;
   }
   .border-dark-grey {
      border: 1px solid #c6c6c6;
   }

   .customer-company {
      font-size: 10pt;
      font-weight: bold;
      padding: 1px;
      margin: 1px;
      text-transform: uppercase;
   }
   .customer-address {
      font-size: 10pt;
      padding: 1px;
      margin: 1px;
      text-transform: uppercase;
   }
   .table-header, .table-footer {
      background-color: #ffffff;
      border-color: #ffffff;
   }
   .table-list {
      border-color: #c6c6c6;
      font-size: 10pt;
   }
   .table-list td, .table-list th {
      font-size: 9pt;
      min-height: 16px;
      height: 16px;
      vertical-align:middle;
      padding: 1px;
      margin: 1px;
   }
   .table-list td, .table-list th {
      border-left: .5px solid #b1b1b1;
      border-right: .5px solid #b1b1b1;
   }
   .table-list th {
      border-top: .5px solid #b1b1b1;
      border-bottom: .5px solid #b1b1b1;
   }
   .table-list td.top-border {
      border-top: .5px solid #b1b1b1;
   }
   .bottom-border {
      border-bottom: .5px solid #b1b1b1;
   }
   .title-hdr {
      font-weight: bold;
      color: #3f3f3f;
      background-color: #cfcfcf;
      line-height: 2;
   }
   .row_header {
      font-weight: bold;
      color: #fcfcfc;
      background-color: #3f3f3f;
      font-size: 9pt;
   }
   .row_body {
      font-size: 8pt;
      line-height: 2;
   }
   .row_body td {
      border: .5px solid #b1b1b1;
   }
   .ftr {
      border-top: 1px solid #000000;
      font-weight: bold;
      background-color: #f5f5f5;
      line-height: 1;
   }
   .table-contact {
      font-size: 9pt;
   }
   .disclaim {
      font-size: 7pt;
   }
   .company-name {
      font-size: 14pt;
      font-weight: bold;
      margin-top: 0px;
      padding-top: 0px;
   }
   .company-name > small {
      font-size: 10pt;
      font-weight: bold;
      font-style: italic;
      text-align: right;
   }
   .company-address {
      font-size: 9pt;
      margin-top: 0px;
      padding-top: 0px;
   }
   div.test {
      color: #CC0000;
      background-color: #FFFF66;
      font-family: helvetica;
      font-size: 10pt;
      border-style: solid solid solid solid;
      border-width: 2px 2px 2px 2px;
      border-color: green #FF00FF blue red;
      width: 100px;
      float: left;
   }
   .nl-logo-center{
      display: block;
      margin-left: auto;
      margin-right: auto;
      margin: 0 auto;
   }
   .nl-header{
      font-size: small;
   }
   .nl-font-quot{
      font-size:large;
   }
   .nl-font-table{
      font-weight: bold;
   }
   .nl-font-main-header{
      font-size:26px;
   }
   .nl-font-address{
      font-size:large;
   }
   .nl-font-address a{
      color: #000;
   }
   .nl-padding{
      padding: 0px !important;
   }
   tr.gmattersmallest td a{
      color: #000;
   }
   a[href]:after {
      content:"" !important;
   }
   .hr {
      /*height: 3px;
      color: #333;
      background-color: #333;
      margin: 0px;*/
      border-top: 1px solid #eee;
      margin: 0;
      padding: 0;
   }
   .nl-pading{
      padding: 10px 10px 10px 10px;
   }
   .nl-title-font{
      font-size: 10px;
      font-weight: bold;
      text-align: center
   }

   .bmatter-vlarge{  FONT-WEIGHT: normal; FONT-SIZE: 32px; COLOR: #000; FONT-FAMILY: "Arial", Verdana, Arial, Helvetica, sans-serif; }
   .bmatter-large{   FONT-WEIGHT: normal; FONT-SIZE: 22px; COLOR: #000; FONT-FAMILY: "tahoma", Verdana, Arial, Helvetica, sans-serif; }
   .bmatter-med{  FONT-WEIGHT: normal; FONT-SIZE: 19px; COLOR: #000; FONT-FAMILY: "tahoma", Verdana, Arial, Helvetica, sans-serif; }
   .bmatter-small{   FONT-WEIGHT: normal; FONT-SIZE: 14px; COLOR: #000; FONT-FAMILY: "tahoma", Verdana, Arial, Helvetica, sans-serif; }

   .bmatter{   FONT-WEIGHT: normal; FONT-SIZE: 19px; COLOR: #000; FONT-FAMILY: "tahoma", Verdana, Arial, Helvetica, sans-serif; }
   .bmatter-bold {   FONT-WEIGHT: bold; FONT-SIZE: 19px; COLOR: #000; FONT-FAMILY: "tahoma", Verdana, Arial, Helvetica, sans-serif; }
   .bmatter-bold1 {  FONT-WEIGHT: bold; FONT-SIZE: 19px; COLOR: #000; FONT-FAMILY: "tahoma", Verdana, Arial, Helvetica, sans-serif; }
   .bmatter1{  FONT-WEIGHT: normal; FONT-SIZE: 18px; COLOR: #000; FONT-FAMILY: "tahoma", Verdana, Arial, Helvetica, sans-serif; }
   .bmatter2{  FONT-WEIGHT: normal; FONT-SIZE: 13px; COLOR: #000; FONT-FAMILY: "tahoma", Verdana, Arial, Helvetica, sans-serif; }
   .buttongrey {     background-image: url("../images/buttonbg1.gif");     border: 1px solid #C9C9C9;     color: #3b3b3b;     cursor: pointer;     font-family: Verdana,Arial,Helvetica,sans-serif;     font-size: 11px;     font-weight: bold; }\
   .table_print > th,tr,td{
     border:1px solid #000;
   }
</style>
@endpush


@section('page_header')
@php
$company_email_id = "contact@siimteq.com";
$abn_details = 'A.B.N 68 621 748 856';
$office_details = '206 Urban One Complex, Vasana Bhayli Road, Vadodara-390015, Gujarat. India<br>Phone:&nbsp;+61&nbsp;425536165&nbsp;<a target="_blank" href="http://www.siimteq.com.com">www.siimteq.com</a> Email: ' . $company_email_id;
$invoice_company = 'Siimteq Technologies PTY LTD.';
@endphp
<table width="70%" border="0" cellpadding="0" cellspacing="0" class="table-header" align="center">
  <tr>
      <th align="left" valign="top">
         <span class="nl-font-address"><b>{!! $abn_details !!}</b></span>
      </th>
      <th align="center">
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </th>
      <td align="right" valign="top">
               <span class="company-address nl-font-quot"><b>Invoice</b></span>

            </td>
  </tr>
  <tr>
    <th align="center" valign="top" width="100%" colspan="3">
        <img src="{{ asset('img/logo1.png') }}" class="nl-logo-center" width="150" style="border: none;background-color:#000000;"  />
        <div align="center" class="nl-font-main-header">
          {!! $invoice_company !!}
          <div class="nl-font-address">{!! $office_details !!}</div>
      </div>
    </th>
  </tr>
</table>

@endsection

@section('page_footer')
   <table width="70%" border="0" cellpadding="0" cellspacing="0" class="table table-footer" align="center" style="margin-top:10px">
      <tr>
         <td>
            <h3 class="disclaim">Make all cheques payable to Siimteq Technologies</h3>
            <h5 class="disclaim">Note: Work to be done as per discussion and clarification made on mails and purchase order.</h5>
         </td>
      </tr>
   </table>
@endsection
