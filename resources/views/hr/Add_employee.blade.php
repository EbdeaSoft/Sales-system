@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
{{__('hr.add_new_employee')}}
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto"> {{__('hr.add_new_employee')}}</h4>
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
        
        @if (session()->has('create_employee'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <br>

        <strong>{{ session()->get('create_employee') }}</strong>
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
                    action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'createNewEmployee')) }}" method="post">
                    {{csrf_field()}}

                 
   
<div>
                        <div class="row ">

                            <div class="col" id="fnWrapper">
                                <label>{{__('hr.employee_name_ar')}}  <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20"
                                    name="employee_name_ar" required type="text">
                            </div>
                            <div class="col"  id="lnWrapper">
                                <label>{{__('hr.employee_name_en')}}  <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20"
                                    data-parsley-class-handler="#lnWrapper"  required
                                    name="employee_name_en" >
                            </div>
                            <div class="col" id="lnWrapper">
                                <label>{{__('hr.email')}}  <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" name="email" required type="email">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                    
                    <div class="col" id="lnWrapper">
                            <label> {{__('hr.Id')}}  <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                name="personal_identification" required type="number">
                        </div>
                        <div class="col" id="lnWrapper">
                            <label> {{__('hr.phone')}}  <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                name="phone" required type="number">
                        </div>

                        <div class="col" id="lnWrapper">
                            <label>  {{__('hr.salary')}} <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                name="salary" required type="number">
                        </div>
                        <div class="col">
                            <label class="form-label">{{__('hr.department')}}<span class="tx-danger">*</span> </label>
                            <select name="department" id="department" class="form-control  nice-select  custom-select">
                            @foreach (App\Models\departments::get() as $section)
                         <option value="{{ $section->id }}">   {{ $section->name_ar }}</option>
                          @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="row ">
                    <div class="col">
                            <label class="form-label" > {{__('hr.age')}} <span class="tx-danger">*</span></label>
                            <input name="age" id="age" class="form-control  nice-select  custom-select" required>
                            </input>
                        </div>
                        <div class="col">
                            <label class="form-label" > {{__('hr.nationality')}} <span class="tx-danger">*</span></label>
                            <input name="nationality" id="nationality" class="form-control  nice-select  custom-select" required>
                            </input>
                        </div>

                        <div class="col">
                            <label class="form-label">{{__('hr.sex')}} <span class="tx-danger">*</span></label>
                            <select name="sex" id="sex" class="form-control  nice-select  custom-select">
                            <option value="male"> {{__('hr.male')}}</option>
                            <option value="female"> {{__('hr.female')}}</option>
                            </select>
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
@endsection
