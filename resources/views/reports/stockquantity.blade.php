
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
{{__('report.stockquantity')}}@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('report.stockquantity')}}

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

                <form action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'stockquantity')) }}" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="row">

                     
                        <div class="col-lg-3" id="type">
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
       <div class="col">
       <p class="mg-b-10">  . </p>

       <div class="d-flex "> 
                            <button class="btn btn-success ">{{__('home.search')}}</button>
                        </div>
                        </div>
                    </div>
				

                  
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                @if(isset($products))
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
        <th class="border-bottom-0"> {{__('home.productNo')}}</th>

        <th class="border-bottom-0"> {{__('home.productname')}}</th>

                                <th class="border-bottom-0"> {{__('home.saleprice')}}</th>
                                    <th class="border-bottom-0"> {{__('home.stock')}}</th>
                                    <th class="border-bottom-0">{{__('users.branch')}}</th>
                                    <th class="border-bottom-0"> {{__('home.total')}}</th>
        </tr>
    </thead>
@foreach ($products as $product)
<?php 
                                    $totalprice+=$product->purchasingـprice*$product->numberofpice;
                                 
                                     ?>
                                     



           
       
 
    <?php
    $i++;

    $date= explode(" ",$product->created_at);

?>


    <tbody>
        <tr>
             <td>{{$i}}</td>
             <td>{{$date[0]}}</td>
             <td>{{$product->Product_Code}}</td>
            <td>{{$product->product_name}}</td>
            <td>{{$product->purchasingـprice+$product->purchasingـprice*0.15}}</td>
            <td>{{$product->numberofpice}}</td>
            <td>{{$product->branch->name}}</td>
            <td>{{($product->purchasingـprice*$product->numberofpice)+($product->purchasingـprice*$product->numberofpice*0.15)}}</td>
        </tr>
       
    </tbody>
    
@endforeach
</table>

            
          <br>
          <br>
<br>

-----------------------------------------------------  {{__('report.totalprice')}} ---------------------------
<br>

          <span class="text-warning" >{{__('report.totalallprice')}} : {{(($totalprice*0.15)+ $totalprice)}}</span>
            
          <br>
          ----------------------------------------------------------------------------------------------------


                        <div class="d-flex justify-content-center">

                        <a class="btn btn-success" href="{{ url('/' . ($page = 'printstockquantity').'/'.$branch_id.'/'.$startat.'/'.$endat) }}"> {{__('home.print')}}</a>
</div>
<br>
                    @endif
                </div>

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
