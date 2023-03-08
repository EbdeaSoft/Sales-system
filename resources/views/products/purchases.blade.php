
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
{{__('home.purchases')}}@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@if (session()->has('Status_Update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث حالة الدفع بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('home.purchases')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
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

<!-- row -->
<div class="row">

    <div class="col-xl-12">
        <div class="card mg-b-20">


            <div class="card-header pb-0">

                <form action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'Addproducttopurchases')) }}" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}


    

                    <div class="row">

                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">  {{__('home.shearchbysuppliername')}}</p>
                            <select class="form-control select2" name="clientnamesearch"
                                required>
                                <option value="{{ $data['recentsupllier']->id ?? 'حدد نوع الفواتير' }}" selected>
                                  {{ $data['recentsupllier']->name ?? __('home.entersuppliername')}}
                                </option>

                                @foreach ($data['allcustomers'] as $section)
                                        <option value="{{ $section->id }}"> {{ $section->name }}</option>
                                    @endforeach
                            </select>
                        </div><!-- col-4 -->
						<div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">  {{__('home.searchbysuppliertno')}}</p>
                            <select class="form-control select2 " name="clientNosearch"
                                required>
                                <option value="{{ $data['recentsupllier']->id ?? 'ادخل رقم العميل' }}" selected>
                                    {{  $data['recentsupllier']->id ?? __('home.entersuppliernumber') }}
                                </option>

                                @foreach ($data['allcustomers'] as $section)
                                        <option value="{{ $section->id }}"> {{ $section->id }}</option>
                                    @endforeach

                            </select>
                        </div><!-- col-4 -->



               
						<div class="col">
                                <label for="inputName" class="control-label"> {{__('home.suppliername')}}</label>
                                <input type="text" class="form-control" id="clientName" name="clientName" value="{{$data['recentsupllier']->name??''}}"
                                  >
                            </div>
							
                        
                            </div>
							<div class="row">
                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
    <p class="mg-b-10">   {{__('home.paymentmethod')}} </p>
    <select class="form-control select2 " name="pay"
        required>
            
		<option value="{{$data['pay']??'Cash'}}" selected> {{$data['pay']??__('report.cash')}}
        </option>
        <option value="Cash" > {{__('report.cash')}}</option>
		<option value="Shabka "> {{__('report.shabka')}} </option>
		<option value="Credit "> {{__('report.credit')}} </option>

    </select>
	
</div>
						<div class="col">
                                <label for="inputName" class="control-label">{{__('home.phone')}} </label>
                                <input type="text" class="form-control " id="phonenumber" name="phonenumber"
                                    title="يرجي ادخال رقم الجوال "
                                    value="{{$data['recentsupllier']->phone??''}}"
                                     required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label"> {{__('home.Location')}} </label>
                                <input type="text" class="form-control" id="address" name="address"
                                value="{{$data['recentsupllier']->location??''}}"
 
                                >
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label"> {{__('home.CampanyName')}} </label>
                                <input type="text" class="form-control" id="notes"
                                    name="notes" title="  يرجي ادخال اسم الشركة  " 
                                    value="{{$data['recentsupllier']->comp_name??''}}"
                                    >
                            </div>


                    </div>

                    <br>
                    <div class="row">
    
        </div>
<br>

                    <div class="row">

<div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
    <p class="mg-b-10">    {{__('home.searchbyproductname')}} </p>
    <select class="form-control select2" name="productname"
        required>
        <option value='ادخل اسم المنتج' selected>
            {{ $type ?? __('home.enterproductname')}}
        </option>

        @foreach ($data['allproduct'] as $section)
                <option value="{{ $section->id }}"> {{ $section->product_name }}</option>
        @endforeach
    </select>
</div><!-- col-4 -->

<div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
    <p class="mg-b-10">  {{__('home.searchbyproductnumber')}} </p>
    <select class="form-control select2 " name="productNo"
        required>
        <option value='ادخل  رقم المنتج' selected>
            {{  __('home.enterproductno')}}
        </option>

        @foreach ($data['allproduct'] as $section)
                <option value="{{ $section->id }}"> {{ $section->Product_Code }}</option>
            @endforeach

    </select>

</div><!-- col-4 -->
<div class="col">
<label for="inputName" class="control-label">  {{__('home.product')}}  </label>
<input type="text" class="form-control" id="productnameshow" name="productnameshow" required>

</div>
<br>


  



</div>
<div class="row">

<input type="number" class="form-control" id="orderNo"name="orderNo"  value="{{$data['product'][0]['order_owner']??null}}">
<div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
    <p class="mg-b-10">    {{__('users.branch')}} </p>
    <select class="form-control select2" name="branchs_id"
        required>
        <option value="{{Auth()->user()->branch->id}}" selected>
            {{ Auth()->user()->branch->name ?? __('users.branch')}}
        </option>

        @foreach (App\Models\branchs::get() as $section)
                <option value="{{ $section->id }}"> {{ $section->name }}</option>
        @endforeach
    </select>
</div><!-- col-4 -->

<div class="col">
<label for="inputName" class="control-label" > {{__('home.quantity')}}  </label>
<input type="number" class="form-control" id="quentity" name="quentity">
</div>
<div class="col">
<label for="inputName" class="control-label" required>  {{__('home.purachesepice')}} </label>
<input type="number" class="form-control" id="quentityprice" name="quentityprice" required>
</div>
<div class="col">
<label for="inputName" class="control-label" required>{{__('home.salepice')}}  </label>
<input type="number" class="form-control" id="sale_price" name="sale_price" required>
</div>
<div class="col">
                                <label for="inputName" class="control-label">{{__('home.notesClient')}}  </label>
                                <input type="text" class="form-control" id="notes"
                                    name="notes" title="يرجي ادخال ملاحظات  " required
                                    >
                            </div>
</div>
</div>
<br>

<div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success"> {{__('home.Add')}}   </button>
</div>


<br>
                        </div> 


                      
					<br>

                 

                        @if (isset($data['product']))
                        <?php $i = 0; ?>
                <div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<i class="mdi mdi-dots-horizontal text-gray"></i>
                                    <h4 class="card-title mg-b-0"> {{__('home.searchaboutproduct')}}   </h4>

								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap" name='prodyctsavaliable'>
										<thead>
											<tr>
                                    <th class="border-bottom-0">NO </th>
                                    <th class="border-bottom-0">{{__('home.productNo')}} </th>

                                            <th class="border-bottom-0">{{__('home.product')}}</th>
                                    <th class="border-bottom-0">{{__('home.quantity')}}</th>
                                    <th class="border-bottom-0">{{__('home.purchase')}}</th>
                                    <th class="border-bottom-0"> {{__('home.addedValueperpice')}}</th>
                                    <th class="border-bottom-0"> {{__('home.saleperpice')}}</th>
                                   
                                 

											</tr>
										</thead>
										<tbody>
                                        <?php $i = 0; 
                                        $totalprice=0;
                                        $totaladdedvalue=0;?>
                                @foreach ($data['product'] as $product)
                                    <?php $i++; 
                                     $totalprice+=$product->purchasingـprice*$product->numberofpice;
                                     $totaladdedvalue+=$product->Added_Value *$product->numberofpice;
                                    ?>
                                    <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$product->productData->Product_Code}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->numberofpice}}</td>
                                    <td>{{$product->purchasingـprice	}}</td>
                                    <td>{{$product->Added_Value	}}</td>
                                    <td>{{$product->productData->sale_price	}}</td>
                                    <tr>
                                    @endforeach
                                    <tr> <td></td></tr>
                                    <tr>
                                 <td>   {{__('home.total')}}</td>
                                 <td>{{ $totalprice}}</td>
                                    </tr>
                                    <tr>
                                 <td>   {{__('home.addedValue')}}</td>
                                 <td>{{ $totaladdedvalue}}</td>
                                    </tr>
                                    <tr>
                                 <td>   {{__('home.the amount')}}</td>
                                 <td>{{ $totaladdedvalue+$totalprice}}</td>
                                    </tr>
										</tbody>
									</table>
                                    <div class="d-flex justify-content-center">

                                    <a class="btn btn-success" href="{{ url('/' . ($page = 'printProductToSupllier').'/'.$data['product'][0]['order_owner']) }}">{{__('home.print')}} </a>
</div>
<br>
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
            $('select[name="clientNosearch"]').on('change', function() {
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

 $('select[name="clientnamesearch"]').on('change', function() {
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
                    $('#sale_price').val(data['sale_price']);
                    
                    
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
                    $('#sale_price').val(data['sale_price']);

                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
    });
        

        
    </script>




<script>
    $(document).ready(function() {

         $('#orderNo').hide();
        $('input[type="radio"]').click(function() {
            if ($(this).attr('id') == 'type_div') {
                $('#invoice_number').hide();
                $('#type').show();
                $('#start_at').show();
                $('#end_at').show();
            } else {
                $('#invoice_number').show();
                $('#type').hide();
                $('#start_at').hide();
                $('#end_at').hide();
            }
        });
    });

</script>


@endsection
