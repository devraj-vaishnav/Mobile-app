@extends('user.layouts.app')
@section('title', 'Category')
@push('header_script')
<link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

@endpush
@section('main-content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Update Category</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a class="btn btn-primary text-white"
                            href="{{route('category/index')}}"><i class="ri-arrow-left-fill"></i></a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{route('category/update' ,$user->id)}}">
                    @csrf
                    <div class="form-group ">
                        <label>Category Name <samp class="text-danger">*</samp></label>
                        <input type="text" class=" form-control" name="name" value="{{old('name',$user->name)}}">
                        <samp class="text-danger">{{$errors->first('name')}}</samp>
                    </div>
                    <button class="btn btn-primary" >Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('footer_script')
<script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Sweet alert init js-->
<script src="{{asset('assets/js/pages/sweet-alerts.init.js')}}"></script>
@endpush