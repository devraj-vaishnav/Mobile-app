@extends('user.layouts.app')
@section('title', 'Expenses')
@section('main-content')
  <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Add Expense</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a class="btn btn-primary text-white"
                                        href="{{route('expense/index')}}"><i class="ri-arrow-left-circle-line"></i></a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{route('expense/store')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Expanse Name</label>
                                    {{-- <input type="hidden" class=" form-control" name="user_id"  value="{{$user->id}}"> --}}
                                    <input type="text" class=" form-control" name="name"  value="{{old('name')}}" required>
                                    <samp class="text-danger">{{$errors->first('name')}}</samp>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control"  name="price" value="{{old('price')}}" required>
                                    <samp class="text-danger">{{$errors->first('price')}}</samp>

                                </div>
                                <button class="btn btn-primary">Submit</button>                                
                            </form>
                        </div>
                    </div>
                </div>
              
            </div>
@endsection