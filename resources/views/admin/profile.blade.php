@extends('admin.layouts.app')
@section('title', 'User Dashboard')
@section('main-content')
  <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Profile</h4>

                        <div class="page-title-right">
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{route('profile/store',$user->id)}}">
                                @csrf
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" class=" form-control" name="name"  value="{{old('name', $user->name)}}">
                                    <samp class="text-danger">{{$errors->first('name')}}</samp>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control"  name="email" value="{{old('email', $user->email)}}">
                                    <samp class="text-danger">{{$errors->first('email')}}</samp>

                                </div>
                                <button class="btn btn-primary">Update</button>                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{route('profile/password',$user->id)}}" >
                                @csrf
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input type="password" name="old_password" class=" form-control" >
                                    <samp class="text-danger">{{$errors->first('old_password')}}</samp>

                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="text" name="password" class=" form-control"  >
                                    <samp class="text-danger">{{$errors->first('password')}}</samp>

                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="text" name="password_confirmation"  class=" form-control" >
                                    <samp class="text-danger">{{$errors->first('password_confirmation')}}</samp>

                                </div>
                                   <button class="btn btn-primary">Forgot</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection