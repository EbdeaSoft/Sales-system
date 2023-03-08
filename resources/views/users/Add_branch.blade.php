@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
{{__('users.addbranch')}}@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{__('users.addbranch')}}</h4>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">
    @if (session()->has('notcreate'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <br>
        <strong>{{ session()->get('notcreate') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    @if (session()->has('create'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <br>

        <strong>{{ session()->get('create') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
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

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                    </div>
                </div><br>
             
<form action="{{ url(Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale().'/'. ($page = 'addbranch')) }}" method="POST" role="search" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="row">

<div class="col">
						

                                <label for="inputName" class="control-label">{{__('users.branch_name')}}</label>
                                <input type="text" class="form-control" id="breanchName"
                                    name="breanchName" title="  يرجي ادخال رقم الفاتورة  " value="{{$data['supllier']->supllier->comp_name??''}}"
                                   required >
                      
               


                      
								</div>
                                <div class="col">
						

                                <label for="inputName" class="control-label">{{__('users.branch_place')}}</label>
                                <input type="text" class="form-control" id="branchLoction"
                                    name="branchLoction" title="  يرجي ادخال رقم الفاتورة  " value="{{$data['supllier']->supllier->comp_name??''}}"
                                   required >
                      
               


                      
								</div>
           
</div><!-- col-4 -->


                    </div><br>
					<div class="d-flex justify-content-center"> 
                            <button class="btn btn-success ">{{__('home.Add')}}</button>
                        </div>

                        <br>

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
