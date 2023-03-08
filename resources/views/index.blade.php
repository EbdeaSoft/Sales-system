@extends('layouts.master')
@section('css')
.div-2 {
       background-color: #FF0000;	 
    }
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('title')
{{__('home.home')}}
@stop
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between" onload=display_ct();>
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{__('home.welcome')}}</h2>
						
						</div>
					</div>
					<div class="main-dashboard-header-right">
						<div>
							<div class="main-star">
							<span id='ct7' style="background-color: #FFFF00"></span>
							</div>
						</div>
						
					</div>
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')

				<!-- row -->
				<div class="row row-sm" 
>

					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{__('home.salesdoday')}}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{App\Models\sales::whereDate('created_at',date("Y-m-d"))->count()}}</h4>
											<!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> +427</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{__('home.TODAYEARNINGS')}}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">
												<?php
												$totalPrice=0;
												$totalAddedvalue=0;
foreach(App\Models\sales::whereDate('created_at',date("Y-m-d"))->get()   as $invoice  ){
	
	$totalPrice=$invoice->Unit_Price+$invoice->quantity;
	$totalAddedvalue=$invoice->Added_Value+$invoice->quantity;

}
												?>
												{{$totalPrice+$totalAddedvalue}}
												</h4>
											<!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7"> -23.09%</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
			
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{__('home.PRODUCT_number_SOLD')}} </h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{App\Models\sales::whereDate('created_at','>=',(date("Y-m")).'-1')->whereDate('created_at','<=',date('Y-m-d '))->count()}}</h4>
											<!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7"> -152.3</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>

					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{__('home.TOTAL_EARNINGS_Month')}}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">	<?php	
												$totalPrice=0;
												$totalAddedvalue=0;
foreach(App\Models\sales::whereDate('created_at','>=',(date("Y-m")).'-1')->whereDate('created_at','<=',date('Y-m-d '))->get()   as $invoice  ){
	
	$totalPrice+=$invoice->Unit_Price+$invoice->quantity;
	$totalAddedvalue+=$invoice->Added_Value+$invoice->quantity;

}
												?>
												{{$totalPrice+$totalAddedvalue}}</h4>
											<!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> 52.09%</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{__('home.purchasesdoday')}}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{App\Models\resource_purchases::whereDate('created_at',date("Y-m-d"))->count()}}</h4>
											<!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> +427</span>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{__('home.TODAYpurchases')}}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">
									<?php		$totalPrice=0;
												$totalAddedvalue=0;
foreach(App\Models\resource_purchases::whereDate('created_at', date("Y-m-d"))->get()   as $invoice  ){
	
	$totalPrice+=$invoice->In_debt;

}
												?>
												{{$totalPrice}}
											</h4>
											<!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> 52.09%</span>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{__('home.purchases_number_SOLD')}}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{App\Models\resource_purchases::whereDate('created_at','>=',(date("Y-m")).'-1')->whereDate('created_at','<=',date('Y-m-d '))->count()}}</h4>
											<!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> +00</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1"></span>
						</div>
					</div>


					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{__('home.TOTAL_purchases_Month')}}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">	<?php	
												$totalPrice=0;
foreach(App\Models\resource_purchases::whereDate('created_at','>=',(date("Y-m")).'-1')->whereDate('created_at','<=',date('Y-m-d '))->get()   as $invoice  ){
	
	$totalPrice+=$invoice->In_debt;

}
												?>
												{{$totalPrice}}</h4>
											<!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> 52.09%</span>
										</span>
									</div>
								</div>
							</div>
						</div>
						
					</div>


	


<br>
<?php
$creadit_customers=App\Models\customers::where('Balance','!=',0)->get();
$credit_suppliers=App\Models\supllier::where('In_debt','!=',0)->get();
$creadit_customer_amount=0;
$credit_supplier_amount=0;

foreach($creadit_customers as $creadit_customer){
    $creadit_customer_amount+=  $creadit_customer->Balance; 
}

foreach($credit_suppliers as $credit_supplier){
    $credit_supplier_amount+=  $credit_supplier->In_debt; 
}
// return  $credit_supplier_amount;


?>

<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{__('home.credit_supplier_amount')}}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$credit_supplier_amount}}</h4>
											<!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> +427</span>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{__('home.creadit_customer_amount')}}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">
								
												{{$creadit_customer_amount}}
											</h4>
											<!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> 52.09%</span>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>



					</div>


	


<br>
<div style="width:100%;">
    {!! $charts[1]->render() !!}

				</div>
				<br>
				
				<br>
				
	
				<div style="width:100%;">
    {!! $charts[0]->render() !!}

			
				</div>

				</div>
					
				<br>

			
		</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>	

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
 
<script>function display_ct7() {
var x = new Date()
var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
hours = x.getHours( ) % 12;
hours = hours ? hours : 12;
hours=hours.toString().length==1? 0+hours.toString() : hours;

var minutes=x.getMinutes().toString()
minutes=minutes.length==1 ? 0+minutes : minutes;

var seconds=x.getSeconds().toString()
seconds=seconds.length==1 ? 0+seconds : seconds;

var month=(x.getMonth() +1).toString();
month=month.length==1 ? 0+month : month;

var dt=x.getDate().toString();
dt=dt.length==1 ? 0+dt : dt;

var x1=month + "/" + dt + "/" + x.getFullYear(); 
x1 = x1 + " - " +  hours + ":" +  minutes + ":" +  seconds + " " + ampm;
document.getElementById('ct7').innerHTML = x1;
display_c7();
 }
 function display_c7(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct7()',refresh)
}
display_c7()
</script>

@endsection
