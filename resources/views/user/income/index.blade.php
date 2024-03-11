@extends('user.layouts.app')
@section('title', 'Income')

@section('main-content')
  <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Income Details</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
    
                                    <li class="breadcrumb-item"><a class="btn btn-primary text-white"
                                            href="{{route('income/create')}}">Add</a></li>
                                </ol>
                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Description </th>
                                    <th>Opertion</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                                @foreach ($incomes as $user )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$user->price}}</td>
                                        <td>{{$user->date}}</td>
                                        <td>{{$user->description}}</td>
                                        <td><a href="{{route('expense/edit',$user->id)}}" class="btn btn-primary">
                                            <i class="ri-edit-line"></i></a>
                                            <a href="{{route('expense/delete',$user->id)}}" class="btn btn-danger"><i class="ri-delete-bin-7-line"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>

                        </div>
                    </div>
                </div>
              
            </div>
@endsection
