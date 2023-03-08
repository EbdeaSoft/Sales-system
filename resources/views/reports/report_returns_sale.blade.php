
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
{{__('report.report_returns_sale')}}@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('report.report_returns_sale')}}

</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
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

                <form action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'search_report_returns_sale')) }}" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-lg-3" id="start_at">
                            <label for="exampleFormControlSelect1"> {{__('report.fromdate')}}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                    name="start_at" placeholder="YYYY-MM-DD" type="text" required>
                            </div><!-- input-group -->
                        </div>

                        <div class="col-lg-3" id="end_at">
                            <label for="exampleFormControlSelect1">  {{__('report.todate')}}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div><input class="form-control fc-datepicker" name="end_at"
                                    value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="text" required>
                            </div><!-- input-group -->
                            
                        </div>
                        <div class="col" id="type">
    <p class="mg-b-10">   {{__('users.branch')}} </p>
    <select class="form-control select2 " name="branch"
        required>
        <option value="-" selected>{{__('users.allbranchs')}}
        </option>
        @foreach(App\Models\branchs::get() as $branch)
		<option value="{{$branch->id}}" > {{$branch->name}}</option>

      @endforeach
    </select>
	
       </div class='row'>
                    </div><br>
					<div class="d-flex justify-content-center"> 
                            <button class="btn btn-success ">{{__('home.search')}}</button>
                        </div>

                  
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                @if(isset($Invoices))
<?php
$userId=0;
$count=0;
?>
<?php
$userId=0;
$startat='';
$endat='';
$totalprice=0;
$totaladdedvalue=0;
$i=0;

?>
   <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
    <thead>
        <tr>
        <th class="border-bottom-0">#</th>
        <th class="border-bottom-0">{{__('report.date')}}</th>
        <th class="border-bottom-0">{{__('report.invoiceNo')}}</th>

                                <th class="border-bottom-0"> {{__('home.productNo')}}</th>
                                <th class="border-bottom-0"> {{__('home.product')}}</th>
                                    <th class="border-bottom-0"> {{__('home.quantity')}}</th>
                                    <th class="border-bottom-0">{{__('home.price')}}</th>
                                    <th class="border-bottom-0"> {{__('home.addedValue')}}</th>
                                    <th class="border-bottom-0"> {{__('home.total')}}</th>
        </tr>
    </thead>
@foreach ($Invoices as $invoice)
<?php 
                                    $totaladdedvalue+=$invoice->return_Added_Value*$invoice->return_quantity;
                                    $totalprice+=$invoice->return_Unit_Price*$invoice->return_quantity;
                                    if($count==0){
                                        $startat=$invoice->created_at;
                                    }
                                    $endat=$invoice->created_at;
                                    $count++;
                                     ?>
                                     
<br>



           
       
 
    <?php
    $i++;

    $date= explode(" ",$invoice->created_at);

?>


    <tbody>
        <tr>
        <td>{{$i}}</td>
        <td>{{$date[0]}}</td>
        <td>{{$invoice->invoice_id}}</td>
        <td>{{$invoice->productData->Product_Code}}</td>
            <td>{{$invoice->productData->product_name}}</td>
            <td>{{$invoice->return_quantity}}</td>
            <td>{{$invoice->return_Unit_Price}}</td>
            <td>{{$invoice->return_Added_Value}}</td>
            <td>{{($invoice->return_quantity*$invoice->return_Added_Value)+($invoice->return_quantity*$invoice->return_Unit_Price)}}</td>
        </tr>
       
    </tbody>
    
@endforeach
</table>

            
          <br>
          <br>
<br>

-----------------------------------------------------  {{__('report.totalprice')}} ---------------------------
<br>

          <span class="text-success">{{__('report.totalpricewithoudtax')}} :  {{ $totalprice}}  <br> <br> {{__('report.totaltax')}} : {{$totaladdedvalue}}  <br><br> </span>
          <span class="text-warning" >{{__('report.totalallprice')}} : {{($totaladdedvalue+ $totalprice)}}</span>
            
          <br>
          ----------------------------------------------------------------------------------------------------


                        <div class="d-flex justify-content-center">

<a class="btn btn-success" href="{{ url('/' . ($page = 'printreturnInvoicesReport').'/'.$branch_Id.'/'.$startat.'/'.$endat) }}"> {{__('home.print')}}</a>
</div>
<br>
                    @endif
                </div>

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

        // $('#invoice_number').hide();

        // $('input[type="radio"]').click(function() {
        //     if ($(this).attr('id') == 'type_div') {
        //         $('#invoice_number').hide();
        //         $('#type').show();
        //         $('#start_at').show();
        //         $('#end_at').show();
        //     } else {
        //         $('#invoice_number').show();
        //         $('#type').hide();
        //         $('#start_at').hide();
        //         $('#end_at').hide();
        //     }
        // });
    });

</script>


@endsection
