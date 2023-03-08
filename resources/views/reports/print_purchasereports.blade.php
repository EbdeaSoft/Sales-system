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
                       
                            <h6 class="invoice-title">{{__('home.purchasereports')}}</h6>
                            
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
                           
                        </div>
                      

                        <div class="card-body">
                <div class="table-responsive">
                @if (isset($products))
                        <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                            <thead>
                                <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">{{__('report.invoiceNo')}}</th>
                                <th class="border-bottom-0"> {{__('home.productNo')}}</th>
                                <th class="border-bottom-0"> {{__('home.product')}}</th>
                                    <th class="border-bottom-0">{{__('report.date')}}</th>
                                    <th class="border-bottom-0"> {{__('home.quantity')}}</th>
                                    <th class="border-bottom-0">{{__('home.purchase')}}</th>
                                    <th class="border-bottom-0"> {{__('home.addedValue')}}</th>
                                    <th class="border-bottom-0"> {{__('home.total')}}</th>



                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;
                                  $totaladdedvalue=0;
                                  $totalprice=0;
                                  $productId=0;
                                  $startat='' ;
                                  $endat='';?>
                                @foreach ($products as $invoice)
                                    <?php $i++;
                                    $productId=$invoice->productData->id;
                                    $totaladdedvalue+=$invoice->Added_Value*$invoice->quantity;
                                    $totalprice+=$invoice->Unit_Price*$invoice->quantity;
                                    if($i==1){
                                        $startat=$invoice->created_at;
                                    }
                                    $endat=$invoice->created_at;
                                     ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $invoice->invoice_id }} </td>
                                        <td>{{ $invoice->productData->Product_Code }} </td>
                                        <td>{{ $invoice->productData->product_name }}</td>
                                        <td>{{ $invoice->created_at }}</td>
                                        <td>{{ $invoice->numberofpice }}</td>  
                                        <td>{{ $invoice->purchasingـprice }}</td>
                                        <td>{{ $invoice->Added_Value }}</td>
                                        <td>{{ ($invoice->purchasingـprice*$invoice->numberofpice)+($invoice->Added_Value*$invoice->numberofpice ) }}</td>
                                      <td></td>
                         
                                    </tr>
                                @endforeach
                             
                            </tbody>
                        </table>
  
<br>
                    @endif
                </div>
                <hr class="mg-b-40">



<button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
        class="mdi mdi-printer ml-1"></i>{{__('home.print')}}</button>
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
