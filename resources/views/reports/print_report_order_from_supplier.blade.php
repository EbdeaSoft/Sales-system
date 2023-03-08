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
{{__('home.print')}}
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
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h6 class="invoice-title">{{__('report.Requestـoffersـfromـsuppliers')}}</h6>
                            
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
                      
                        <div class="row mg-t-12">
                         
                           
                        </div>
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
                                 
                                    $totalEachInvoce=0;

                                    if($count==0){

                                        $userId=$invoice->user_id;
                                        $startat=$invoice->created_at;
                                    }
                                    $endat=$invoice->created_at;
                                    $count++;

                                     ?>
                                     
<br>



<span class="text-danger">{{__('report.invoiceNo')}}   :  {{$invoice->id}}</span>
<br>
<span class="text-danger">{{__('home.suppliername')}}   :  {{$invoice->supllier->name}}

</span>
<br>
<span class="text-danger">        
       
    <table class="table table-sm">
    <br>

    <thead>
        <tr>
        <th class="border-bottom-0">#</th>
        <th class="border-bottom-0">{{__('report.date')}}</th>

                                <th class="border-bottom-0"> {{__('home.productNo')}}</th>
                                <th class="border-bottom-0"> {{__('home.product')}}</th>
                                    <th class="border-bottom-0"> {{__('home.quantity')}}</th>
                                    <th class="border-bottom-0">{{__('home.purchase')}}</th>
                                    <th class="border-bottom-0"> {{__('home.addedValue')}}</th>
                                    <th class="border-bottom-0"> {{__('home.total')}}</th>
        </tr>
        
    </thead>
    <?php
    $i=0;
?>
    @foreach(App\Models\orderDetails::where('order_owner',$invoice->id)->get() as $product)
    <?php
    $i++;
    $totaladdedvalue+=$product->Added_Value*$product->numberofpice;
    $totalprice+=($product->purchasingـprice)*$product->numberofpice;
    $totalEachInvoce+=($product->purchasingـprice+$product->Added_Value)*$product->numberofpice;

    $date= explode(" ",$product->created_at);
?>
    <tbody>
        <tr>
        <td>{{$i}}</td>
        <td>{{$date[0]}}</td>

        <td>{{$product->productData->Product_Code}}</td>
            <td>{{$product->productData->product_name}}</td>
            <td>{{$product->numberofpice}}</td>
            <td>{{$product->purchasingـprice}}</td>
            <td>{{$product->Added_Value}}</td>
            <td>{{($product->purchasingـprice+$product->Added_Value)*$product->numberofpice}}</td>
        </tr>
       
    </tbody>
    
@endforeach
</table>

          <span class="text-warning  float-left mt-3 mr-2" id="print_Button" >{{__('home.total')}} : {{($totalEachInvoce)}}</span>
            
          <br>
          <br>
@endforeach
<br>
-----------------------------------------------------  {{__('report.totalprice')}} ---------------------------
<br>

          <span class="text-success">{{__('report.totalpricewithoudtax')}} :  {{ $totalprice}}  <br> <br> {{__('report.totaltax')}} : {{$totaladdedvalue}}  <br><br> </span>
          <span class="text-warning" >{{__('report.totalallprice')}} : {{($totaladdedvalue+ $totalprice)}}</span>
            
          <br>
          ----------------------------------------------------------------------------------------------------


@endif


</div>
                        <hr class="mg-b-50">



                 <div class="d-flex justify-content-center">     
            <button class="btn btn-danger  float-left mt-10 mr-10" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>{{__('home.print')}}</button>
                                <br>

                                </div>
                                <br>

                                
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
