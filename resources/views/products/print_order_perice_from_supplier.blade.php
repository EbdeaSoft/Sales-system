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
    معاينه طباعة المنتجات
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
                            <h6 class="invoice-title">{{__('home.Requestـpricesـofـproducts')}}</h6>
                            
                            <div >
                <a href="https://ebdeasoft.com/"><img src="{{ URL::asset('assets/img/brand/logoprintpage.png') }}"
                        class="logo-1" alt="logo"></a>
            
                        </div>
                     
                         
                            <div class="billed-from">
                               <br>
                               <p>{{__('home.cam_name_owner')}}</p>
                               <p>{{__('home.TaxNumber')}}</p>
                            </div>
<br>                        </div><!-- billed-from -->
                        </div><!-- invoice-header -->
              
                        @if (isset($itemsRequest))
                        <?php $i = 0; ?>
                <div class="col-xl-12">
						<div class="card mg-b-20">
						
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap" name='prodyctsavaliable'>
										<thead>
											<tr>
                                    <th class="border-bottom-0"># </th>
                                    <th class="border-bottom-0">{{__('home.productNo')}} </th>
                                            <th class="border-bottom-0">{{__('home.product')}}</th>
                                            <th class="border-bottom-0">{{__('home.quantity')}}</th>
                                   
                                 

											</tr>
										</thead>
										<tbody>
                                        <?php $i = 0; ?>
                                @foreach ($itemsRequest as $product)
                                    <?php $i++; ?>
                                    <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$product->productData->Product_Code}}</td>
                                    <td>{{$product->productData->product_name}}</td>
                                    <td>{{$product->quantity	}}</td>
                                    
                                    <tr>
                                    @endforeach
										</tbody>
									</table>
    
<br>
</div>
							</div>
						</div>
					</div>
            
						<br/>
                </form>

          
              
             

              





                  
                            @endif
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
