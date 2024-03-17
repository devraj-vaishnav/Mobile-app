@extends('user.layouts.app')
@section('title', 'Product')
@push('header_script')
<link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/toastr/build/toastr.min.css')}}">

@endpush
@section('main-content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Add Product</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a class="btn btn-primary text-white"
                            href="{{route('product/index')}}"><i class="ri-arrow-left-fill"></i>Back</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{route('product/store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group ">
                        <label>Category Name <samp class="text-danger">*</samp></label>
                        <select name="category_id" id="" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <samp class="text-danger">{{$errors->first('category_id')}}</samp>
                    </div>
                    <div class="form-group ">
                        <label>Product Name <samp class="text-danger">*</samp></label>
                        <input type="text" class=" form-control" name="product_name" value="{{old('product_name')}}" required>
                        <samp class="text-danger">{{$errors->first('product_name')}}</samp>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label>Product Price <samp class="text-danger">*</samp></label>
                                <input type="number" class=" form-control" name="price" value="{{old('price')}}" required>
                                <samp class="text-danger">{{$errors->first('price')}}</samp>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label>Product Image </label>
                                <input type="file" class=" form-control"  name="image"  required>
                                <samp class="text-danger">{{$errors->first('image')}}</samp>
                            </div> 
                        </div>
                       
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
<script src="{{asset('assets/libs/toastr/build/toastr.min.js')}}"></script>

<!-- toastr init -->
<script src="{{asset('assets/js/pages/toastr.init.js')}}"></script>

<!-- Sweet alert init js-->
<script src="{{asset('assets/js/pages/sweet-alerts.init.js')}}"></script>


@endpush