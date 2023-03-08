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
{{__('report.budgetsheet')}}
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
        
 </h5>   <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h6 class="invoice-title">{{__('report.budgetsheet')}}</h6>
                            
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
                        <br>
                        <br>
                           
                        </div>
                      
                      

                        <div class="table-responsive">
                        @if(isset($data))

<?php $i = 0; ?>
<div class="col-xl-12">
<div class="card mg-b-20">
    <div class="card-header pb-0">

        <div class="d-flex justify-content-between">
            <i class="mdi mdi-dots-horizontal text-gray"></i>

        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" >
                <thead>
                    <tr>
                    <th class="border-bottom-0">{{__('home.sales')}} </th>
                    <th class="border-bottom-0">{{__('home.the amount')}}</th>
                    <th class="border-bottom-0">{{__('home.purchases')}}</th>
                    <th class="border-bottom-0">{{__('home.the amount')}}</th>
<th></th>
                    </tr>
                </thead>
                <tbody>
               
<tr>
            <td>{{__('report.cash')}}</td>
            <td>{{$data['salescash']}}</td>
            <td>{{__('report.cash')}}</td>
            <td>{{$data['purchesecash']}}</td>

            </tr>

            <tr>
            <td>{{__('report.shabka')}}</td>
            <td>{{$data['salesshabka']}}</td>
            <td>{{__('report.shabka')}}</td>
            <td>{{$data['purcheseshabka']}}</td>

            </tr>



            <tr>
            <td>{{__('report.credit')}}</td>
            <td>{{$data['salescredit']}}</td>
            <td>{{__('report.credit')}}</td>
            <td>{{$data['purchesecredit']}}</td>

            </tr>
            



            <tr>
            <td>{{__('home.total')}}</td>
            <td>{{$data['salescredit']+$data['salesshabka']+$data['salescash']}}</td>
            <td>{{__('home.total')}}</td>
            <td>{{$data['purchesecredit']+$data['purcheseshabka']+$data['purchesecash']}}</td>

            </tr>
            </tr>
            <tr>
            <td>--------------------</td>
            <td>--------------------</td>
            <td>--------------------</td>
            <td>--------------------</td>
            </tr>
            <tr>
            <td>{{__('home.cash expenses')}}</td>
                    <td >{{__('home.the amount')}}</td>
                    <td >{{__('home.receive money')}}</td>
                    <td >{{__('home.the amount')}}</td>
            </tr>
            <tr>
            <td>{{__('report.cash')}}</td>
            <td>{{$data['transactiontosuplliers_cash']}}</td>
            <td>{{__('report.cash')}}</td>
            <td>{{$data['credittransaction_cash']}}</td>

            </tr>

            <tr>
            <td>{{__('report.shabka')}}</td>
            <td>{{$data['transactiontosuplliers_shabka']}}</td>
            <td>{{__('report.shabka')}}</td>
            <td>{{$data['credittransaction_shabka']}}</td>

            </tr>
            <tr>
            <td>{{__('home.total')}}</td>
            <td>{{$data['transactiontosuplliers_shabka']+$data['transactiontosuplliers_cash']}}</td>
            <td>{{__('home.total')}}</td>
            <td>{{$data['credittransaction_shabka']+$data['credittransaction_cash']}}</td>

            </tr>
            <tr>
            <td>--------------------</td>
            <td>--------------------</td>
            <td>--------------------</td>
            <td>--------------------</td>
            </tr>
            <tr>
            <td>{{__('home.other_expenses')}}</td>
            <td >{{__('home.the amount')}}</td>
            <td></td>
            <td></td>
            </tr>
            <tr>
            <td>{{__('report.cash')}}</td>
            <td>{{$data['expenses_cash']}}</td>
            <td></td>
            <td></td>

            </tr>
            </tr>
            <tr>
            <td>{{__('report.shabka')}}</td>
            <td>{{$data['expenses_shabka']}}</td>
            <td></td>
            <td></td>

            </tr>
            <tr>
            <td>{{__('home.total')}}</td>
            <td>{{$data['expenses_cash']+$data['expenses_shabka']}}</td>
            <td></td>
            <td></td>
<td></td>
            </tr>
            <tr>
            <td>--------------------</td>
            <td>--------------------</td>
            <td>--------------------</td>
            <td>--------------------</td>
            </tr>
            <tr>
                    <td >{{__('home.Receivedamount')}}</td>
                    <td >{{__('home.the amount')}}</td>

                    <td >{{__('home.The amount paid')}}</td>
                    <td >{{__('home.the amount')}}</td>
            </tr>
            <tr>
            <td>{{__('report.cash')}}</td>
            <td>{{$data['salescash']+$data['credittransaction_cash']}}</td>
            <td>{{__('report.cash')}}</td>
            <td>{{$data['purchesecash']+$data['expenses_cash']+$data['transactiontosuplliers_cash']}}</td>

            </tr>

            <tr>
            <td>{{__('report.shabka')}}</td>
            <td>{{$data['salesshabka']+$data['credittransaction_shabka']}}</td>
            <td>{{__('report.shabka')}}</td>
            <td>{{$data['purcheseshabka']+$data['transactiontosuplliers_shabka']+$data['expenses_shabka']}}</td>

            </tr>
            

            <td>--------------------</td>
            <td>--------------------</td>
            <td>--------------------</td>
            <td>--------------------</td>
            </tr>
            <tr>
            <td>{{__('home.Remainingamount')}}</td>
            <td >{{__('home.the amount')}}</td>
            <td></td>
            <td></td>
            </tr>
            <?php
$Remainingamount_cash= (($data['salescash']+$data['credittransaction_cash'])-($data['purchesecash']+$data['expenses_cash']+$data['transactiontosuplliers_cash']))   ;
$Remainingamount_shabka= (($data['salesshabka']+$data['credittransaction_shabka'])-($data['purcheseshabka']+$data['transactiontosuplliers_shabka']+$data['expenses_shabka']));  ;

?>
            <tr>
            <td>{{__('report.cash')}}</td>
            <td>{{$Remainingamount_cash}}</td>
            <td>{{__('home.credit_supplier_amount')}}</td>
            <td>{{$data['credit_supplier_amount']}}</td>

            </tr>
            </tr>
            <tr>
            <td>{{__('report.shabka')}}</td>

            <td>{{$Remainingamount_shabka}}</td>
            <td>{{__('home.creadit_customer_amount')}}</td>
            <td>{{$data['creadit_customer_amount']}}</td>
     
            </tr>
            <tr>
            <td>{{__('home.total')}}</td>
            <td>{{$Remainingamount_shabka+$Remainingamount_cash}}</td>
            <td></td>
            <td></td>
                </tbody>
            </table>
@endif
                </div>
     
                </div>
                </div>
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
