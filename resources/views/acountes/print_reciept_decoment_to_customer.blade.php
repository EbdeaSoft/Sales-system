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
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h5 class="invoice-title">  {{__('home.voucher')}}
 </h5>
                            <div class="billed-from">
                                <h3 >الهياكل   </h3>
                               <br>
                               <p>لقطع غيار الشاحنات و الزيوت والعدد البدوية</p>
                               <p>        س . ت    ١٠١١١٢٧٤٣٣           </p>
                               <p>    الرقم الضريبي ٣٠٢١٦٧٠٣٧٠٣٧٨٠٠٠٠٣ </p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-12">
                         
                           
                        </div>
                      

                        <div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
                                    <th class="border-bottom-0"> {{__('home.clientname')}}</th>
                                    <th class="border-bottom-0">{{__('accountes.Theamountpaid')}}</th>
                                    <th class="border-bottom-0">{{__('accountes.Remainingamount')}}</th>
                                    <th class="border-bottom-0">{{__('home.paymentmethod')}}</th>
                                    <th class="border-bottom-0">{{__('home.date')}}</th>
<th></th>
											</tr>
										</thead>
                                        <tbody>
                                          
                                        <td>{{$data['transaction']['name']}}</td>
                                        <td>{{$data['transaction']['paid_amount']}}</td>
                                        <td>{{$data['transaction']['Balance']}}</td>
                                        <td>{{$data['transaction']['method_pay']}}</td>
                                        <td>{{$data['transaction']['date']}}</td>
  <td></td>
                                            
                                        </tbody>
										<tbody>
                                    <tr>
                                    

                                    </tr>
										</tbody>
									</table>
                                    <br>
                                    </div>

                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>{{__('home.print')}}</button>
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
