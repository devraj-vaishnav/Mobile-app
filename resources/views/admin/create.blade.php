@extends('admin\layouts.app')
@section('title', 'Add User')
@section('main-content')

            
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">ADD User</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin/index')}}"
                                        class="btn btn-primary text-white"><i class="ri-arrow-left-fill"></i></a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Create User</h4>
                            <form method="post" action="{{route('user/store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="input-date1">User Name <samp class="text-danger">*</samp></label>
                                        <input id="text" class="form-control input-mask" value="{{old('name')}}" name="name" required >
                                        <samp class="text-danger">{{$errors->first('name')}}</samp>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                            <label for="input-repeat">Email <samp class="text-danger">*</samp></label>
                                            <input type="gmail" class="form-control" value="{{old('email')}}"  name="email" required>
                                        <samp class="text-danger">{{$errors->first('email')}}</samp>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mt-4">
                                        <label for="input-date1">Password  <samp class="text-danger">*</samp></label>
                                        <input id="text" class="form-control input-mask" name="password" required >
                                        <samp class="text-danger">{{$errors->first('password')}}</samp>
                                    </div>
                                    <div class="col-lg-6 mt-4">
                                        <label for="input-date1">Confirm Password<samp class="text-danger">*</samp></label>
                                        <input id="text" class="form-control input-mask" name="password_confirmation" required >
                                        <samp class="text-danger">{{$errors->first('password_confirmation')}}</samp>
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection
