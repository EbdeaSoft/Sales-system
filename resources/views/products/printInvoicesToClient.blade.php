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
    معاينه طباعة الفاتورة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4>
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
                        <h6 class="invoice-title">{{__('home.VATinvoice')}}</h6>
                            
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
                          <!-- invoice-header -->
                        <div class="row mg-t-12">
                         
                           
                        </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">#</th>
                                        <th class="wd-40p">اسم العميل </th>
                                        <th class="tx-center"> رقم العميل </th>
                                        <th class="tx-center"> تاريخ  </th>
                                        <th class="tx-center"> رقم الفاتورة  </th>
                                     
                                       

                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>1</td>
                                        <td class="tx-12">{{$data['invoiceData']->customer->name}}</td>
                                        <td class="tx-12">{{$data['invoiceData']->customer->id}}</td>
                                        <td class="tx-center">{{ $data['invoiceData']->created_at}}</td>
                                        <td class="tx-center">{{ $data['invoiceData']->id}}</td>
                                     
                                    </tr>

                              
                                   
                                </tbody>
                            </table>
                            </div>

                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">#</th>
                                        <th class="wd-40p">رقم القطعة</th>
                                        <th class="tx-center"> البيان </th>
                                        <th class="tx-center"> الكمية </th>
                                        <th class="tx-center"> سعر الوحدة </th>
                                        <th class="tx-center"> الخصم </th>
                                        <th class="tx-center"> السعر الاجمالي </th>
                                     
                                       

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0;
                                   ?>

                                @foreach ($data['salesData'] as $product)
                                <?php $i++ ?>

                                    <tr>
                                    <td class="wd-20p">{{$i}}</td>
                                    <td class="wd-40p">{{$product->product_id}}</td>
                                        <td class="tx-center">{{ $product->productData->product_name}}</td>
                                        <td class="tx-center">{{ $product->quantity}}</td>
                                        <td class="tx-center">{{ $product->Unit_Price}}</td>
                                        <td class="tx-center">{{ $product->Discount_Value}}</td>
                                        <td class="tx-center">{{$product->Unit_Price*$product->quantity}}</td>
                                     
                                    </tr>
                                    @endforeach

                                    <tr>
                              <td class="tx-center">المجموع</td>
                              <td class="tx-center">{{$data['invoiceData']->Price}}</td>
                              </tr> 
                              <tr>
                              <td class="tx-center">الضريبة</td>
                              <td class="tx-center">{{$data['invoiceData']->Added_Value}}</td>
                              </tr> 
                              <tr>
                              <td class="tx-center">المبلغ</td>
                              <td class="tx-center">{{$data['invoiceData']->Added_Value+$data['invoiceData']->Price}}</td>
                              </tr>
                                   
                                </tbody>
                            </table>
                            <div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
        <?php 
        function ConvertToHEX($value)
        {
         return pack("H*", sprintf("%02X", $value));
        }
        $sellerName='مؤسسة الهياكل لقطع الغيار'  ;
        $varNumber='302167037800003';
        $time=\Carbon\Carbon::now()->addHours(3);
        $total=$data['invoiceData']->Added_Value+$data['invoiceData']->Price;
        $tax=  $data['invoiceData']->Added_Value  ;
         $HexSeller = ConvertToHEX(1).ConvertToHEX(strlen($sellerName));
         $seller  =  $HexSeller.$sellerName;
         $HexVAT  = ConvertToHEX(2).ConvertToHEX(strlen($varNumber)); 
         $vat  = $HexVAT.$varNumber;
         $HexTime = ConvertToHEX(3).ConvertToHEX(strlen($time)); 
         $time  = $HexTime.$time;
         $HexTotal = ConvertToHEX(4).ConvertToHEX(strlen($total)); 
         $total  = $HexTotal.$total;
         $HexVATN = ConvertToHEX(5).ConvertToHEX(strlen($tax)); 
         $VATN  = $HexVATN.$tax;
        
         $tobase   = $seller.$vat.$time.$total.$VATN;
         $dataforQRcode=  base64_encode($tobase);
         ?>
        {!! QrCode::size(130)->generate( $dataforQRcode) !!}
    </div>
    </div>
                        </div>
                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
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
