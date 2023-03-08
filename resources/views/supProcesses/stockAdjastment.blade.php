
@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@section('title')
{{__('supprocesses.stockadjustment')}}@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('supprocesses.stockadjustment')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
    </span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>خطا</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('productupdated'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <br>

<strong>{{ session()->get('productupdated') }}</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">

           

                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
<!-- row -->
<div class="row">

    <div class="col-xl-12">
        <div class="card mg-b-20">


            <div class="card-header pb-0">

                <form action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'stockAdjastment')) }}" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}


    

           
             

                    <div class="row">

<div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
    <p class="mg-b-10">     {{__('home.searchbyproductname')}} </p>
    <select class="form-control select2" name="productname"
        required>
        <option value="-" selected>
            {{ __('home.enterproductname') }}
        </option>

        @foreach (App\Models\products::where('branchs_id',Auth()->User()->branchs_id)->get() as $section)
                <option value="{{ $section->id }}"> {{ $section->product_name }}</option>
        @endforeach
    </select>
</div><!-- col-4 -->

<div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
    <p class="mg-b-10">  {{__('home.searchbyproductnumber')}} </p>
    <select class="form-control select2 " name="productNo"
        required>
        <option value="-" selected>
            {{   __('home.enterproductno') }}
        </option>

        @foreach (App\Models\products::where('branchs_id',Auth()->User()->branchs_id)->get() as $section)
                <option value="{{ $section->id }}"> {{ $section->Product_Code }}</option>
            @endforeach

    </select>
</div>
<!-- col-4 -->



 
    </div>
    <div class="row">    <div class="col-lg-7 mg-t-20 mg-lg-t-0">
        <label for="inputName" class="control-label">   {{__('home.productname')}}  </label>
        <input type="text" class="form-control" id="productnameshow" name="productnameshow"   required>
     
    </div>
<div class="col">
        <label for="inputName" class="control-label" > {{__('supprocesses.current_quantity')}}   </label>
        <input type="number" class="form-control" id="quentity" name="quentity"  readonly  >
    </div>
    <div class="col">
        <label for="inputName" class="control-label" > {{__('supprocesses.new_quentity')}}   </label>
        <input type="number" class="form-control" id="newquentity" name="newquentity"  required >
    </div>
    <div class="col">
    <input type="number" class="form-control" id="orderNo"name="orderNo"  hidden>
    </div>
    </div>
    <br>

    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success">  {{__('roles.update')}}  </button>
</div>


<br>



</div>
                        </div> 

          
                      
					<br>

                 

                        @if (isset($itemsRequest))
                        <?php $i = 0; ?>
                <div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
                            <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
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
                                    <div class="d-flex justify-content-center">

                                    <a class="btn btn-success" href="{{ url('/' . ($page = 'printOrderPriceFromSupplier').'/'.$itemsRequest[0]->order_id) }}">  {{__('home.print')}}</a>
</div>
<br>
								</div>
                                </div>
                                </div>
						</div>
					</div>
            
						<br/>
                </form>

            </div>
          
              
             

               <div class="row">
              





                  
                            @endif

                        </table>

                </div>
               </div>
         
       
    </div> 
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
<!--Internal  pickerjs js -->
<script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();

</script>



<script>
        $(document).ready(function() {
            $('select[name="suppliertNosearch"]').on('change', function() {
                console.log('AJAX load   work 0000');

                var selectclientid = $(this).val();
                if (selectclientid) {
                    console.log('AJAX load   work');

                    $.ajax({
                        url: "{{ URL::to('getsupllier') }}/" + selectclientid,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log("success");
                    console.log(data['name']); 
                    $('#clientName').val(data['name']);
                    $('#address').val(data['location']);
                    $('#phonenumber').val(data['phone']);
                    $('#notes').val(data['comp_name']);
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
             
 $('select[name="suppliernamesearch"]').on('change', function() {
                console.log('AJAX load   work 0000');

                var selectclientid = $(this).val();
                if (selectclientid) {
                    console.log('AJAX load   work');

                    $.ajax({
                        url: "{{ URL::to('getsupllier') }}/" + selectclientid,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log("success");
                    console.log(data['name']); 
                    $('#clientName').val(data['name']);
                    $('#address').val(data['location']);
                    $('#phonenumber').val(data['phone']);
                    $('#notes').val(data['comp_name']);
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
        
        $('select[name="productNo"]').on('change', function() {
                console.log('AJAX load   work 0000');

                var selectclientid = $(this).val();
                if (selectclientid) {
                    console.log('AJAX load   work');
                    $.ajax({
                        url: "{{ URL::to('getproduct') }}/" + selectclientid,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log("success123");
                            console.log(data);
                    console.log("{{ URL::to('getsupllier') }}/" + selectclientid); 
                    $('#productnameshow').val(data['product_name']);
                    $('#quentity').val(data['numberofpice']);

                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
    });
        $('select[name="productname"]').on('change', function() {
                console.log('AJAX load   work 0000');

                var selectclientid = $(this).val();
                if (selectclientid) {
                    console.log('AJAX load   work');
                    $.ajax({
                        url: "{{ URL::to('getproduct') }}/" + selectclientid,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log("success123");
                            console.log(data);
                    console.log("{{ URL::to('getsupllier') }}/" + selectclientid); 
                    $('#productnameshow').val(data['product_name']);
                    $('#quentity').val(data['numberofpice']);
                    
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
    });
        

        
    </script>







@endsection
