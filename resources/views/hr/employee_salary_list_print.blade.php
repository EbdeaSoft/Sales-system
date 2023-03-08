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
{{__('hr.salarydecoument')}}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">

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
                            <h6 class="invoice-title">{{__('hr.salarydecoument')}}</h6>
                            
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
       
                        <div class="card">
           
                
           <div class="card-body">
           <div class="table-responsive hoverable-table">
          <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">

                   <thead>

                           <tr>
                           <th ># </th>
                           <th >{{__('hr.name')}}</th>
                           <th >{{__('hr.Id')}}</th>
                           <th >{{__('hr.email')}}</th>
                           <th >{{__('hr.phone')}}</th>
                           <th >{{__('hr.department')}}</th>
                           <th >{{__('hr.salary')}}</th>
                           <th >{{__('hr.increastotal')}}</th>
                           <th >{{__('hr.decreasetotal')}}</th>
                           <th >{{__('home.total')}}</th>
                        
                

                           </tr>
                       </thead>
                       <tbody>
                       <?php $i=0?>

                       @foreach ($list_salary_data as $employee)
                       <?php $i++ ?>

                       <td >{{ $i}}</td>
                       <td >{{__('hr.phone')=='رقم الجوال' ?$employee['employeeData']->name_ar:$employee['employeeData']->name_en  }}</td>                                        
                       <td >{{ $employee['employeeData']->personal_identification }}</td>
                       <td >{{ $employee['employeeData']->email }}</td>
                       <td>{{ $employee['employeeData']->phone }}</td>
                       <td >{{__('hr.phone')=='رقم الجوال' ? $employee['employeeData']->departments->name_ar:$employee['employeeData']->departments->name_en  }}</td>
                       <td >{{ $employee['employeeData']->salary }}</td>
                       <td >{{ $employee['bounes'] }}</td>
                       <td >{{ $employee['discount'] }}</td>
                       <td >{{$employee['employeeData']->salary+$employee['bounes'] - $employee['discount'] }}</td>

</td>
                               
                
                       
                   </tr>
               @endforeach
                       </tbody>
                   </table>

                </div>
                <hr class="mg-b-40">



<button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
class="mdi mdi-printer ml-1"></i>
                </div>
                </div>
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
