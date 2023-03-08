@extends('layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }

    </style>
@endsection
@section('title')
    معاينه طباعة للموارد
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
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
                            <h3 class="invoice-title">طلب من الموارد </h3>
                            <div class="billed-from">
                                <h4 class="d-flex justify-content-center">مؤسسة الهياكل لقطع الغيارة و التجارة</h4>
                               
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-12">
                            <div class="col-md">
                            <div class="col-md">
                                <h5 class="tx-gray-600">معلومات الموارد</h5>
                                <p class="invoice-info-row"><span>رقم الفاتورة</span>
                                    <span>{{$data['productsdata'][0]->supllier->id}}</span></p>
                                <p class="invoice-info-row"><span>تاريخ الاصدار</span>
                                    <span><?php echo date("Y-m-d h:i") ?></span></p>
                                <p class="invoice-info-row"><span>اسم الموارد  </span>
                                    <span>{{$data['supllierdata']->name}}</span></p>
                                    <p class="invoice-info-row"><span>العنوان</span>
                                    <span>{{$data['supllierdata']->location}}</span></p> 
                                     <p class="invoice-info-row"><span>رقم الجوال </span>
                                    <span>{{$data['supllierdata']->phone}}</span></p>
                                  
                                    <p class="invoice-info-row"><span> اسم الشركة </span>
                                    <span>  {{$data['supllierdata']->comp_name}}</span></p>
                            </div>
                            </div>
                           
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">#</th>
                                        <th class="wd-40p">كود المنتج</th>
                                        <th class="wd-40p">المنتج</th>
                                        <th class="tx-center"> الكمية </th>
                                        <th class="tx-center"> السعر </th>
                                        <th class="tx-center"> ضريبة   </th>
                                        <th class="tx-center">  </th>
                                       
                                       

                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>

                                @foreach ($data['productsdata'] as $product)
                                <?php $i++; ?>

                                    <tr>
                                    <td>{{ $i }}</td>

                                        <td>{{$product->productData->Product_Code}}</td>
                                        <td class="tx-12">{{$product->product_name}}</td>
                                        <td class="tx-center">{{ $product->numberofpice}}</td>
                                        <td class="tx-center">{{ $product->purchasingـprice}}</td>
                                        <td class="tx-center">{{ $product->Added_Value}}</td>
                                        <td class="tx-center"></td>
                                       
                                    </tr>
                                    @endforeach

                              
                                   
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        
                        <div class="col">
                        <label for="inputName" class="control-label" required>العنوان :الرياض - الخرج   </label>
                        <br>
                        <label for="inputName" class="control-label" required>الايميل : hmoltk@gmail.com  </label>
                        <br>
                        <label for="inputName" class="control-label" required> رقم الجوال : 0543577633  </label>
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
