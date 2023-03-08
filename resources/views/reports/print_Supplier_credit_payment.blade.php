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
{{__('home.print')}}
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
                            <h6 class="invoice-title">{{__('report.Supplier credit payment')}}</h6>
                            
                            <div >
                <a href="https://ebdeasoft.com/"><img src="{{ URL::asset('assets/img/brand/logoprintpage.png') }}"
                        class="logo-1" alt="logo"></a>
            
                        </div>
                     
                         
                            <div class="billed-from">
                               <br>
                               <p>{{__('home.cam_name_owner')}}</p>
                               <p>{{__('home.TaxNumber')}}</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-12">
                        <br>
                        <br><!-- invoice-header --><!-- invoice-header -->
                        <div class="row mg-t-12">
                         
                           
                        </div>
                      

                        <div class="card-body">
                <div class="table-responsive">
                <div class="card-body">
                <div class="table-responsive hoverable-table">
                  
    <table class="table table-sm">
    <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">

    <thead>
        <tr>
        <th class="border-bottom-0">#</th>
        <th class="border-bottom-0">{{__('report.date')}}</th>

                                <th class="border-bottom-0"> {{__('home.employee')}}</th>
                                    <th class="border-bottom-0"> {{__('home.suppliername')}}</th>
                                    <th class="border-bottom-0"> {{__('accountes.Theamountpaid')}}</th>

                                    <th class="border-bottom-0">{{__('home.paymentmethod')}}</th>
        </tr>
        
    </thead>
@foreach ($Invoices as $invoice)
          



     
       

    <?php
    $i=0;
?>
    <?php
    $i++;
  
    $date= explode(" ",$invoice->created_at);
?>
    <tbody>
        <tr>
        <td>{{$i}}</td>
        <td>{{$date[0]}}</td>
        <td>{{$invoice->user->name}}</td>
            <td>{{$invoice->supllier->name}}</td>
            <td>{{$invoice->paidـamount}}</td>
            <td>{{$invoice->Pay_Method_Name}}</td>
           
        </tr>
       
    </tbody>
    

            
          
@endforeach
</table>
<br>
<span class="text-warning " >{{__('accountes.Remainingamount')}} : {{($Invoices[0]->supllier->In_debt)}}</span>

                    </div>
                    </div>

                        <br>

      
<br>
                 
                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>{{__('home.print')}}</button>
                                </div>
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
