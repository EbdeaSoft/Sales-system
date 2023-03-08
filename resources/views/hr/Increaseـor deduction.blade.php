@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
{{__('hr.Increaseـor deductionـforـtheـemployee')}}
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto"> {{__('hr.Increaseـor deductionـforـtheـemployee')}}</h4>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">

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
        
        @if (session()->has('create_department'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <br>

        <strong>{{ session()->get('create_department') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
             
                </div><br>
                
                <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                    action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'Increaseـor_deduction')) }}" method="post">
                    {{csrf_field()}}

                    <div class="col-lg-3">
                        <label class="rdiobox">
                            <input checked name="rdio" type="radio" value="1" id="type_div"> <span>{{__('hr.bouns')}}
                                </span></label>
                    </div>


                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                        <label class="rdiobox"><input name="rdio" value="2" type="radio"><span> {{__('hr.discount')}} 
                            </span></label>
                    </div><br><br>

   
<div>
                        <div class="row ">
                        <div class="col">
                            <label class="form-label" id="department">{{__('hr.searchby_name_Id')}}<span class="tx-danger">*</span> </label>
                            <select name="department" id="department" class="form-control  nice-select  custom-select">

                            @foreach (App\Models\employee::get() as $employee)
                         <option value="{{ $employee->id }}">   {{ $employee->name_ar }}  -  {{ $employee->personal_identification }} </option>
                          @endforeach
                            </select>
                        </div>
                            <div class="col" id="fnWrapper">
                                <label id="increasValuelabel">{{__('hr.increasValue')}}  </label>
                                <input class="form-control form-control-sm mg-b-20"
                                name="increasValue"  id="increasValue" required type="number" value="0">
                            </div>
                            <div class="col"  id="lnWrapper">
                                <label id="decreaseValuelabel">{{__('hr.decreaseValue')}}  </label>
                                <input class="form-control form-control-sm mg-b-20"
                                    data-parsley-class-handler="#lnWrapper"  required
                                    name="decreaseValue" id="decreaseValue"  type="number" value="0">
                            </div>

                        </div>

                    </div>

            
             

                 <br>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-main-primary pd-x-20" type="submit">{{__('home.Add')}}</button>
                    </div>
                </form>
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


<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#decreaseValuelabel').hide();

        $('#decreaseValue').hide();

        $('input[type="radio"]').click(function() {
            if ($(this).attr('id') == 'type_div') {
                $('#increasValue').show();
                $('#increasValuelabel').show();
                $('#decreaseValue').hide();
                $('#decreaseValuelabel').hide();


            } else {
                $('#decreaseValue').show();
                $('#decreaseValuelabel').show();
                $('#increasValue').hide();
                $('#increasValuelabel').hide();
                

            }
        });
    });

</script>
@endsection
