



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
{{__('home.Receipt document')}}@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('home.Receipt document')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
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

                <form action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'reciepttransactions')) }}" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}


    

                    <div class="row">

                    <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">  {{__('home.shearchbysuppliername')}}</p>
                            <select class="form-control select2" name="clientnamesearch"
                                required>
                                <option value="-" selected>
                                  {{  __('home.entersuppliername')}}
                                </option>

                                @foreach ($data['allsupllier'] as $section)
                                        <option value="{{ $section->id }}"> {{ $section->name }}</option>
                                    @endforeach
                            </select>
                        </div><!-- col-4 -->
						<div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                            <p class="mg-b-10">  {{__('home.searchbysuppliertno')}}</p>
                            <select class="form-control select2 " name="clientNosearch"
                                required>
                                <option value="-" selected>
                                    {{   __('home.entersuppliernumber') }}
                                </option>

                                @foreach ($data['allsupllier'] as $section)
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
                            <div class="col">
                                <label for="inputName" class="control-label">  {{__('accountes.debtamount')}} </label>
                                <input type="number" class="form-control " id="debtamount" name="debtamount"
                                    title="يرجي ادخال الكمية  " value="{{$data['customer']->Limit_credit ??'0'}}"
                                    readonly  >
                            </div>
                          


                    </div>
<div class='row'>

                    <div class="col-lg-5 mg-t-20 mg-lg-t-0" id="type">
    <p class="mg-b-10">   {{__('home.paymentmethod')}} </p>
    <select class="form-control select2 " name="pay"
        required>
        <option value="Cash" > {{__('report.cash')}}</option>
		<option value="Shabka "> {{__('report.shabka')}} </option>


    </select>
                    </div>
    <div class="col">
                                <label for="inputName" class="control-label"> {{__('accountes.Theamountpaid')}}  </label>
                                <input type="number" class="form-control " id="cashreceived" name="cashreceived"
                                    title="يرجي ادخال الكمية  " 
                                     required>
                            </div>
                            <br>

                    </div>
                    <br>

                    <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success"> {{__('home.Add')}}   </button>
                    <br>

</div>
<br>
</


                      
					<br>

                 

                
          
              

               <div class="row">
              
						</div>
					</div>





                  


                </div>
              
            </div>
            @if($data['transaction']!=null)
            <?php 
            $id=$data['transaction']['id'];
            ?>
            <div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
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
<th></th>
											</tr>
										</thead>
                                        <tbody>
                                          
                                        <td>{{$data['transaction']['name']}}</td>
                                        <td>{{$data['transaction']['paid_amount']}}</td>
                                        <td>{{$data['transaction']['Balance']}}</td>
                                        <td>{{$data['transaction']['method_pay']}}</td>
  <td></td>
                                            
                                        </tbody>
										<tbody>
                                    <tr>
                                    

                                    </tr>
										</tbody>
									</table>
                                    <br>

<div class="d-flex justify-content-center">

<a class="btn btn-success" href="{{ url('/' . ($page = 'print_reciept').'/'.$id) }}"> {{__('home.print')}}</a>
</div>
<br>
								</div>
                                <br/>
                                </div>
                                </div>
    </div> 
    @endif
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
                    $('#debtamount').val(data['In_debt']);
 
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
                     
                    $('#debtamount').val(data['In_debt']);
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
        });  });
        
        
    </script>






@endsection

