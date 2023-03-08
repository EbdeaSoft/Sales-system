@extends('layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
        body {
font: 13pt Georgia, "Times New Roman", Times, serif;
line-height: 1.5;
border-style: solid;

}
    </style>
@endsection
@section('title')
{{__('home.voucher')}}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
 <span class="text-muted mt-1 tx-13 mr-2 mb-0">
                    معاينة طباعة الفاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
        
 </h5>   <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h6 class="invoice-title">{{__('report.creditcollection')}}</h6>
                            
                            <div >
                <a href="https://ebdeasoft.com/"><img src="{{ URL::asset('assets/img/brand/logoprintpage.png') }}"
                        class="logo-1" alt="logo"></a>
            
                        </div>
                     
                         
                            <div class="billed-from">
                               <br>
                               <p>{{__('home.cam_name_owner')}}</p>
                               <p>{{__('home.TaxNumber')}}</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-12">
                        <br>
                        <br>
                        <br>
                           
                        </div>
                      
                      

                        <div class="table-responsive">
                @if(isset($Invoices))
<?php
$userId=0;
$count=0;
?>
<?php
$userId=0;
$startat='';
$endat='';
$totalprice=0;
$totaladdedvalue=0;
?>
@foreach ($Invoices as $invoice)
<?php 
                                    $totalprice+=$invoice->recive_amount;
                                    if($count==0){
                                        $userId=$invoice->user_id;
                                        $startat=$invoice->created_at;
                                    }
                                    $endat=$invoice->created_at;
                                    $count++;

                                     ?>
                                     
<br>



            <span class="text-danger">{{__('report.invoiceNo')}}   :  {{$invoice->id}}       </span>  
            <br> 
            <span class="text-danger">{{__('report.reciver_name')}}   :  {{$invoice->user->name}}       </span>  

            
            <br>         
           <span class="text-danger" >{{__('home.paymentmethod')}}   :   

@if ($invoice->pay_method == 'Cash')
        <span class="text-success">{{$invoice->pay_method }}</span>
    @elseif($invoice->pay_method == 'Credit')
        <span class="text-danger">{{ $invoice->pay_method }}</span>
    @else
        <span class="text-warning">{{ $invoice->pay_method }}</span>
    @endif
    <br>         

</span>
   
    <table class="table table-sm">

    <thead>
    <tr>
    <th class="border-bottom-0"> {{__('home.date')}}</th>
    <th class="border-bottom-0"> {{__('home.clientname')}}</th>
                                    <th class="border-bottom-0">{{__('accountes.limitCredit')}}</th>
                                    <th class="border-bottom-0">{{__('accountes.Remainingamount')}}</th>
                                    <th class="border-bottom-0">{{__('accountes.cashreceived')}}</th>
                                    <th class="border-bottom-0">{{__('home.paymentmethod')}}</th>

											</tr>
    </thead>
    <?php
    $i=0;
?>
    <?php
    $date= explode(" ",$invoice->created_at);
?>
    <tbody>
        <tr>
                                       <td>{{$date[0]}}</td>
                                        <td>{{$invoice->customer->name}}</td>

                                        <td>{{$invoice->customer->Limit_credit}}</td>
                                        <td>{{$invoice->customer->Balance}}</td>
                                        <td>{{$invoice->recive_amount}}</td>
                                        <td>{{$invoice->pay_method}}</td>
  
                                                </tr>
       
    </tbody>
    
</table>

            
          <br>
          <br>
@endforeach
<br>
-----------------------------------------------------  {{__('report.totalprice')}} ---------------------------
<br>

          <span class="text-success">{{__('home.total')}} :  {{ $totalprice}}  <br> 
          <br>
          ----------------------------------------------------------------------------------------------------



                        <br>
                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>{{__('home.print')}}</button>
 
<br>
                    @endif
                </div>
     
                </div>
                </div>
                </div>
                </div>
                        </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

    </script>

@endsection
