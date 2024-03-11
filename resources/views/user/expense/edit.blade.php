@extends('user.layouts.app')
@section('title', 'Expenses')
@section('main-content')
  <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Expenses Update</h4>
                        <div class="page-title-right">
                           
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{route('expense/update', $expense->id)}}">
                                @csrf
                                <div class="form-group">
                                    <label>Expense Name</label>
                                    {{-- <input type="hidden" class=" form-control" name="user_id"  value="{{$user->id}}"> --}}
                                    <input type="text" class=" form-control" name="name"  value="{{old('name',$expense->name)}}">
                                    <samp class="text-danger">{{$errors->first('name')}}</samp>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control"  name="price" value="{{old('price',$expense->price)}}">
                                    <samp class="text-danger">{{$errors->first('price')}}</samp>

                                </div>
                                <button class="btn btn-primary">Update</button>                                
                            </form>
                        </div>
                    </div>
                </div>
              
            </div>
@endsection