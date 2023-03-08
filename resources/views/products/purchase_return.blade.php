
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
{{__('home.purchase_return')}}@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <br>

        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('notfountreturnpuracheseproduct'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <br>

        <strong>{{ session()->get('notfountreturnpuracheseproduct') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


@if (session()->has('editpurchase'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <br>

        <strong>{{ session()->get('editpurchase') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('home.purchase_return')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
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

                <form action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'Purchase_returns_Data')) }}" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}


    

         


					<div class="row">
						<div class="col">
						<label for="inputName" class="control-label"> {{__('home.enterinvoicenumber')}}</label>
                                <input type="number" class="form-control" id="clientName" name="clientName" required>

								</div>

								<div class="col">
                                                                <br/>

									<button type="submit" class="btn btn-success"> {{__('home.search')}}  </button>

								</div>

							</form>	
                            <br/>
							<form action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'AddproducttoSupllier')) }}" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}
                            </div>
                                                        <br/>

							<div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">{{__('home.suppliername')}}  </label>
                                <input type="text" class="form-control" id="notes"
                                    name="notes" title="  يرجي ادخال اسم الشركة  " value="{{$data['supllier']->supllier->comp_name??''}}"
                                    >
                            </div>
						<div class="col">
                                <label for="inputName" class="control-label">{{__('home.phone')}} </label>
                                <input type="text" class="form-control " id="phonenumber" name="phonenumber"
                                    title="يرجي ادخال رقم الجوال " value="{{$data['supllier']->supllier->phone??''}}"
                                     required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label"> {{__('home.Location')}} </label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$data['supllier']->supllier->location??''}}"
                                  >
                            </div>  
                              <div class="col">
                                <label for="inputName" class="control-label">{{__('home.purchasedate')}}  </label>
                                <input type="text" class="form-control" id="date" name="date" value="{{$data['supllier']->created_at??''}}"
                                  >
                            </div>



                    </div>

                    <br>









<br>



</div>
                        </div> 
                       

                      
					<br>

                 

                        @if (isset($data['product']))
                        <?php $i = 0; ?>
                <div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0"> مشتريات الفاتورة</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap" name='prodyctsavaliable'>
										<thead>
											<tr>
                                    <th class="border-bottom-0"># </th>
                                    <th class="border-bottom-0">{{__('home.productNo')}}</th>
                                    <th class="border-bottom-0">{{__('home.product')}}</th>
                                    <th class="border-bottom-0">{{__('users.branch')}}</th>
                                    
                                    <th class="border-bottom-0">{{__('home.quantity')}}</th>
                                    <th class="border-bottom-0">{{__('home.purchase')}} </th>
                                    <th class="border-bottom-0">{{__('home.addedValue')}}</th>
                                    <th class="border-bottom-0">{{__('home.total')}} </th>
                                    <th class="border-bottom-0">{{__('home.RETURNSPURCHAE')}} </th>
                                    <th class="border-bottom-0">{{__('home.operations')}}  </th>
                              
                                 

											</tr>
										</thead>
										<tbody>
                                        <?php $i = 0; ?>
                                @foreach ($data['product'] as $product)
                                    <?php $i++; ?>
                                    <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$product->productData->Product_Code}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$data['branch']}}</td>
                                    <td>{{$product->numberofpice}}</td>
                                    <td>{{$product->purchasingـprice}}</td>
                                    <td>{{$product->Added_Value}}</td>
                                    <td>{{($product->Added_Value+$product->purchasingـprice)*$product->numberofpice}}</td>
                                    <td>{{$product->returns_purchase}}</td>

                                    <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $product->productData->id }}" data-section_name="{{$product->product_name}}" data-ordernumber="{{$data['supllier']->id}}"
                                                data-description="{{ $product->numberofpice }}" data-toggle="modal"
                                                href="#exampleModal2" title="تعديل"><i class="las la-pen"></i></a>

                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $product->productData->id }}" data-section_name="{{$product->product_name }}"
                                                 data-description="{{ $product->numberofpice }}" data-ordernumber="{{$data['supllier']->id}}"
                                                data-toggle="modal" href="#modaldemo9" title="حذف"><i
                                                    class="las la-trash"></i></a>
                                    </td>
                                    <tr>
                                    @endforeach
										</tbody>
									</table>
                                    <div class="d-flex justify-content-center">

</div> <div class="d-flex justify-content-center">
                        <!-- <button type="submit" class="btn btn-danger"> استرجاع  </button> -->
</div>
						</form>	
<br>
								</div>
							</div>
						</div>
					</div>
            
						<br/>
              

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
<!-- edit -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('home.RETURNSPURCHASEpart')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'purchaseproduct_update')) }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                        
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="ordernumber" id="ordernumber" value="">
                            <label for="recipient-name" class="col-form-label" >  {{__('home.product')}} </label>
                          
                            <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">{{__('home.numberofpicereturens')}}</label>
                            <textarea class="form-control" id="return_quentity" name="return_quentity" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{__('home.confirm')}}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('home.cancel')}}</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> {{__('home.Retrieveall')}} </h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'purchaseproduct_delete')) }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>{{__('home.Are_you_sure')}}</p><br>
                        <input type="hidden" name="ordernumber" id="ordernumber" value="">

                        <input type="hidden" name="id" id="id" value="">

                        <input type="hidden" name="description" id="description" value="">
                        <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">{{__('home.confirm')}}</button>
                    </div>
            </div>
            </form>
        </div>
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
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        
        var id = button.data('id')
        var ordernumber = button.data('ordernumber')
        var section_name = button.data('section_name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #ordernumber').val(ordernumber);
        modal.find('.modal-body #product_name').val(section_name);
        modal.find('.modal-body #return_quentity').val(description);
    })
</script>

<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var ordernumber = button.data('ordernumber')

        var description = button.data('description')
        
        var section_name = button.data('section_name')
        var modal = $(this)
        modal.find('.modal-body #ordernumber').val(ordernumber);

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #description').val(description);
        modal.find('.modal-body #product_name').val(section_name);
    })
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
