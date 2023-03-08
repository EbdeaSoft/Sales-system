
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
{{__('home.sales')}}@stop
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

@if (session()->has('edit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <br>
        <strong>{{ session()->get('edit') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<a 
    href="/dashboard" 
    title="Dashboard" 
    accesskey="g"
>
    
</a>

<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('home.sales')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
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

                <form action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'AddInvoices')) }}" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}

					<div class="row">
								<div class="col" id="type">
                            <p > {{__('home.searchbyproductnumber')}}</p>
                            <select class="form-control select2" name="productNo" id="productNo"
                                required>
                                <option value="{{ $type ?? 'حدد نوع الفواتير' }}" selected>
                                    {{ $type ??     __('home.enterproductno')  }}
                                </option>

                                @foreach (App\Models\products::get() as $product)
                                        <option value="{{ $product->id }}">    {{ $product->product_name }}   {{ $product->Product_Code}}</option>
                                    @endforeach
                            </select>
                        </div><!-- col-4 -->
                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                        <input type="text" hidden=true class="form-control" id="invoice_number" name="invoice_number" value="{{$data['invoice_id']??''}}"
                                  >
                    </div>
                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">

                        <p class="d-flex justify-content-center"> {{__('home.PrintInvoices')}}     </p>

<div class="row">

<div class="col">
<label class="rdiobox">
<input checked name="rdio" type="radio" value="Arbic" id="Language"> <span>    {{__('home.Arbic')}}
</span></label>
</div>


<div class="col">
<label class="rdiobox"><input name="rdio" value="English" type="radio"><span>  {{__('home.English')}}
</span></label>
</div>						

                        </div>
                      
								</div>

                            <br/>
					
                            </div>
                                                        <br/>





							<div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">  {{__('home.product')}}  </label>
                                <input type="text" class="form-control" id="product_name"
                                    name="product_name" title="  يرجي ادخال رقم المنتج  " value="{{$data['supllier']->supllier->comp_name??''}}"
                                    >
                            </div>
					<div>
                    <label for="inputName" class="control-label">   {{__('home.purchaseproductwithouttax')}}</label>
                                <input type="text" class="form-control " id="purchase_price" name="purchase_price"
                                     value="{{$data['supllier']->supllier->phone??''}}"
                                     readonly required>
                    </div>
                    <div class="col">
                                <label for="inputName" class="control-label">  {{__('home.sellingproduct without tax')}}</label>
                                <input type="text" class="form-control " id="product_price" name="product_price"
                                     value="{{$data['supllier']->supllier->phone??''}}"
                                     required>
                            </div>
                            
                            <div class="col">
                                <label for="inputName" class="control-label">    {{__('home.discount')}}</label>
                                <input type="text" class="form-control " id="product_price_after_dis" name="product_price_after_dis"
                                     value=0
                                     >
                            </div> 



                    </div>
<div>
	<div class='row'>

	
                             <div class="col">
                                <label for="inputName" class="control-label"> {{__('home.productlocation')}}  </label>
                                <input type="text" class="form-control" id="product_location" name="product_location" value="{{$data['supllier']->supllier->location??''}}"
                                readonly  >
                            </div> 
                            <div class="col">
                                <label for="inputName" class="control-label"> {{__('home.availablequantity')}} </label>
                                <input type="text" class="form-control" id="avaliable_quentity" name="avaliable_quentity" value="{{$data['supllier']->created_at??''}}"
                                readonly   >
                            </div>
							
							<div class="col">
                                <label for="inputName" class="control-label"> {{__('home.quantity')}}  </label>
                                <input type="number" class="form-control " id="quantity" name="quantity"
                                    title="يرجي ادخال الكمية  " value="{{$data['supllier']->supllier->phone??''}}"
                                     required>
                            </div>

</div>
<div class='row'>
<div class="col-lg-5 mg-t-20 mg-lg-t-0" id="type">
    <p class="mg-b-10">   {{__('home.paymentmethod')}} </p>
    <select class="form-control select2 " name="pay"
        required>
        <option value="{{$data['pay']??'Cash' }}" selected> {{$data['pay']??"Cash" }}
        </option>
		<option value="Cash" > {{__('report.cash')}}</option>
		<option value="Shabka "> {{__('report.shabka')}} </option>
		<option value="Credit "> {{__('report.credit')}} </option>

    </select>
	
</div class='row'>
<div class="col" id="type">
                            <p class="mg-b-10"> {{__('home.chooseclient')}} </p>
                            <select class="form-control select2" name="clientnamesearch"
                                >
                               <option value="{{$data['customer']->id ??1}}">    {{ $data['customer']->name??'Cash Customer' }}   {{ $data['customer']->phone??''}}</option>

                                @foreach (App\Models\customers::get() as $customer)
                                        <option value="{{ $customer->id }}">    {{ $customer->name }}   {{ $customer->phone}}</option>
                                    @endforeach
                            </select>
                        </div><!-- col-4 -->
                        <div class="col">
                                <label for="inputName" class="control-label">  {{__('home.creditlimit')}} </label>
                                <input type="number" class="form-control " id="creditlimit" name="creditlimit"
                                    title="يرجي ادخال الكمية  " value="{{$data['customer']->Limit_credit ??'0'}}"
                                    readonly  required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label"> {{__('home.current balance')}}   </label>
                                <input type="number" class="form-control " id="balance" name="balance"
                                    title="يرجي ادخال الكمية  " value="{{$data['customer']->Balance ??'0'}}"
                                   readonly  required>
                            </div>
                        <br>

</div>
<br>

<div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success"> {{__('home.Add')}}   </button>
</div>
</div>









<br>

</form>

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
                                    <th class="border-bottom-0">NO </th>
                                    <th class="border-bottom-0">{{__('home.productNo')}} </th>
                                    <th class="border-bottom-0">{{__('home.product')}}</th>
                                    <th class="border-bottom-0">{{__('home.quantity')}}</th>
                                    <th class="border-bottom-0">{{__('home.price')}}</th>
                                    <th class="border-bottom-0">{{__('home.discount')}}</th>
                                    <th class="border-bottom-0">{{__('home.addedValue')}}</th>
                                    <th class="border-bottom-0">{{__('home.total')}}</th>
                                    <th class="border-bottom-0">{{__('home.operations')}}</th>
                              
                                 

											</tr>
										</thead>
										<tbody>
                                        <?php $i = 0; ?>
                                @foreach ($data['product'] as $product)
                                    <?php $i++; ?>
                                  @if($product->quantity>0)
                                    <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$product->productData->Product_Code}}</td>
                                    <td>{{$product->productData->product_name}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->Unit_Price}}</td>
                                    <td>{{$product->Discount_Value}}</td>
                                    <td>{{$product->Added_Value}}</td>
                                    <td>{{($product->Added_Value+$product->Unit_Price)*$product->quantity}}</td>

                                    <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $product->id }}" data-section_name="{{$product->productData->product_name}}" 
                                                data-description="{{ $product->quantity }}" data-toggle="modal"
                                                href="#exampleModal2" title="تعديل"><i class="las la-pen"></i></a>

                                          
                                    </td>
                                    @endif
                                    <tr>
                                    @endforeach
										</tbody>
									</table>
									</table>
                                    @if($product->quantity>0)
                                    <br>

                                    <div class="d-flex justify-content-center">

                                    <a class="btn btn-success" href="{{ url('/' . ($page = 'printInvoice').'/'.$data['invoice_id']) }}"> {{__('home.print')}}</a>
                                    <br>

</div>

@endif
<br>
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
                    <h5 class="modal-title" id="exampleModalLabel">{{__('home.Return part of the goods')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'EditInvoices')) }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                        
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="ordernumber" id="ordernumber" value="">
                            <label for="recipient-name" class="col-form-label" >{{__('home.product')}} </label>
                          
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
            var elem = document.documentElement;
            if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) { /* Safari */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE11 */
    elem.msRequestFullscreen();
  }
  var count=1

			$('select[name="productNo"]').on('change', function() {
                console.log('AJAX load   work 0000');
                var selectProduct = $(this).val();
				console.log(selectProduct);
                $.ajax({
                        url: "{{ URL::to('getProductdJsonDecode') }}/" + selectProduct,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log("success");
                            if (data) {
					   count++
                       
                       $('#product_name').val(data['product_name']);
                       $('#product_location').val(data['Product_Location']);
                       $('#avaliable_quentity').val(data['numberofpice']);
                       $('#quantity').val(1);
                       $('#product_price').val(data['sale_price']);
                       $('#purchase_price').val(data['purchasingـprice']);

                       
                    //    update3/3/2023


//                     let table = document.getElementById("example");
//                     let row = table.insertRow(-1); // We are adding at the end

//                     let c1 = row.insertCell(0);
//                     let c2 = row.insertCell(1);
//                     let c3 = row.insertCell(2);    
//                     let c4 = row.insertCell(3);
//                     let c5 = row.insertCell(4);
//                     let c6 = row.insertCell(5);
//                     let c7 = row.insertCell(6);
//                     let c8 = row.insertCell(7);
//                     let c9 = row.insertCell(8);
   
//       // Add data to c1 and c2
//                      c1.innerText = count
//                      c2.innerText = data['Product_Code']
//                      c3.innerText = data['product_name']
//                      c4.innerText = 1
//                      c5.innerText = data['sale_price']
//                      c6.innerText = data['sale_price']
//                      c7.innerText = 0
//                      c8.innerText = data['sale_price']*0.15
//                      c9.innerHTML = '<button class="deleteBtn" id="myButton"  style="background-color:red;color:white;width:20;height:18;" >Delete</button>'


// var rowCount = table.rows.length;   

// for (var i = 0; i < rowCount; i++) {    
//      var data=table.rows[i].innerText.innerText;
//      console.log(data);

// }
                    //end update






                    console.log('AJAX load work');

                    
   
                   } else {
                       console.log('AJAX load did not work');
                   }
                        },
                    });
             
    });


//update today





// $("#button_1").click(function(e) {
//         event.preventDefault();

//         var url = $(this).attr('data-action');
//         console.log('teszt stst  did not work');
//         let table = document.getElementById("example");
//         $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });
//         $.ajax({
//             url:"{{ URL::to('posttestajax') }}" ,
//             method: 'POST',
//             data: {
//                 'data':table.rows
//             },
//             dataType: 'JSON',
//             contentType: false,
//             cache: false,
//             processData: false,
    
//             success:function(response)
//             {
//                 $(form).trigger("reset");
//                 alert('success')
//             },
//             error: function(response) {
//                 alert(response.UNSENT)

//             }
//         });
//     });








//end update





    const tbodyEl = document.querySelector("tbody");
    const tableEl = document.querySelector("table");
    function onDeleteRow(e) {
        if (!e.target.classList.contains("deleteBtn")) {
          return;
        }

        const btn = e.target;
        btn.closest("tr").remove();
      }
     
      tableEl.addEventListener("click", onDeleteRow);


//end added

    $('select[name="clientnamesearch"]').on('change', function() {
                console.log('AJAX load   work 0000');

                var selectCustomer = $(this).val();
				console.log(selectCustomer);
                $.ajax({
                        url: "{{ URL::to('/getcustomer') }}/" + selectCustomer,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log("success");
                            if (data) {
					   
                                 
                       $('#creditlimit').val(data['Limit_credit']);
                       $('#balance').val(data['Balance']);
                    
                       console.log('AJAX load   work');
   
                   } else {
                       console.log('AJAX load did not work');
                   }
                        },
                    });
             
    });
    
        });
        


        
    </script>




<script>


</script>


@endsection
