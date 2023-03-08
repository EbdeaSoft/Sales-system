


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
{{__('home.Expensesowner')}}@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('home.Expensesowner')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
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

                <form action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'ExpensesOwner')) }}" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}


    

               
		
<div class='row'>

                    <div class="col" id="type">
    <p class="mg-b-10">   {{__('home.paymentmethod')}} </p>
    <select class="form-control select2 " name="pay"
        required>
        </option>
		<option value="Cash" selected> Cash</option>
		<option value="Shabka "> SHABKA </option>

    </select>
                    </div>
    <div class="col">
                                <label for="inputName" class="control-label"> {{__('accountes.Theamountpaid')}}  </label>
                                <input type="number" class="form-control " id="cashreceived" name="cashreceived"
                                    title="يرجي ادخال الكمية  " 
                                     required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label"> {{__('accountes.Reasonforspendingmoney')}}</label>
                                <input type="text" class="form-control" id="reasone" name="reasone" value="{{__('accountes.forOwner')}}"
                                 readonly >
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
                                    <th class="border-bottom-0"> {{__('accountes.user')}}</th>
                                    <th class="border-bottom-0">{{__('accountes.Reasonforspendingmoney')}}</th>
                                    <th class="border-bottom-0">{{__('accountes.Theamountpaid')}}</th>
                                    <th class="border-bottom-0">{{__('home.paymentmethod')}}</th>
<th></th> 
											</tr>
										</thead>
                                        <tbody>
                                          
                                        <td>{{$data['transaction']['user']}}</td>
                                        <td>{{$data['transaction']['Reasonforspendingmoney']}}</td>
                                        <td>{{$data['transaction']['Theـamountـpaid']}}</td>
                                        <td>{{$data['transaction']['Pay_Method_Name']}}</td>
  <td></td>
                                            
                                        </tbody>
										<tbody>
                                    <tr>
                                    

                                    </tr>
										</tbody>
									</table>
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

