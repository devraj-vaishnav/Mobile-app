@extends('user.layouts.app')
@section('title', 'Product')
@push('header_script')
<link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

@endpush
@section('main-content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Update Prodate</h4>
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
                <form method="post" action="{{route('product/update',$product->id)}}">
                    @csrf
                    <div class="form-group ">
                        <label>Category Name <samp class="text-danger">*</samp></label>
                        <select name="category_id" id="" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{( $category->id ==
                                    $product->category_id)
                                    ? 'selected' : '' }}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        <samp class="text-danger">{{$errors->first('category_id')}}</samp>
                    </div>
                    <div class="form-group ">
                        <label>Product Name <samp class="text-danger">*</samp></label>
                        <input type="text" class=" form-control" name="product_name" value="{{old('name',$product->product_name)}}" required>
                        <samp class="text-danger">{{$errors->first('product_name')}}</samp>
                    </div>
                    <div class="form-group ">
                        <label>Price <samp class="text-danger">*</samp></label>
                        <input type="number" class=" form-control" name="price" value="{{old('price',$product->price)}}" required>
                        <samp class="text-danger">{{$errors->first('price')}}</samp>
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
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Sweet alert init js-->
<script src="{{asset('assets/js/pages/sweet-alerts.init.js')}}"></script>
@endpush