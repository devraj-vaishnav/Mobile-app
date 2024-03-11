@extends('user.layouts.app')
@section('title', 'Add Income')
@push('header_script')
<link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endpush
@section('main-content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Income ADD</h4>
            <div class="page-title-right">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{route('income/store')}}">
                    @csrf
                    <div class="form-group ">
                        <label>Price <samp class="text-danger">*</samp></label>
                        <input type="text" class=" form-control" name="price" value="{{old('price')}}">
                        <samp class="text-danger">{{$errors->first('price')}}</samp>
                    </div>

                    <label>Date<samp class="text-danger">*</samp></label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="date" data-provide="datepicker" data-date-format="dd M, yyyy"
                            data-date-autoclose="true" autocomplete="off" value="{{old('date')}}"> 
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>
                    <samp class="text-danger">{{$errors->first('date')}}</samp>

                    <div class="form-group mt-4">
                        <label>Description</label>
                        <input type="text" class=" form-control" name="description" value="{{old('description')}}">
                    </div>
                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('footer_script')
<script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
@endpush