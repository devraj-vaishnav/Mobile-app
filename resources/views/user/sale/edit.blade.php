@extends('user.layouts.app')
@section('title', 'Product')
@push('header_script')
<link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/toastr/build/toastr.min.css')}}">
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

@endpush
@section('main-content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Update Sales Details</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a class="btn btn-primary text-white" href="{{route('sale/index')}}"><i
                                class="ri-arrow-left-fill"></i>Back</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{route('sale/update', $sale->id)}}">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label>Customer Name <samp class="text-danger">*</samp></label>
                                <input type="text" class=" form-control" name="customer_name"
                                    value="{{old('customer_name',$sale->customer_name)}}" required>
                                <samp class="text-danger">{{$errors->first('customer_name')}}</samp>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label>Bill Date <samp class="text-danger">*</samp> </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="bill_date" data-provide="datepicker"
                                        data-date-format="dd M, yyyy" data-date-autoclose="true" autocomplete="off"
                                        value="{{ old('bill_date', date('d-M-Y', strtotime($sale->bill_date))) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label>Mobile No. <samp class="text-danger">*</samp></label>
                                <input type="number" class=" form-control" name="mobile_no"
                                    value="{{old('mobile_no',$sale->mobile_no)}}" required>
                                <samp class="text-danger">{{$errors->first('mobile_no')}}</samp>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label>Address</label>
                                <input type="text" class=" form-control" name="address"
                                    value="{{old('address',$sale->address)}}">
                                <samp class="text-danger">{{$errors->first('address')}}</samp>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table">

                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Prodact Name</th>
                                        <th>Price</th>
                                        <th>Quality </th>
                                        <th>Total</th>
                                        <th>
                                            <button class="btn btn-primary ms-5" type="button" id="button"><i
                                                    class="fas fa-plus"></i></button>
                                        </th>
                                    </tr>
                                    @php
                                    $u = 2;
                                    @endphp
                                    @foreach ($saleOrders as $saleOrder )
                                    <tr>
                                        <td>{{$loop->iteration}} </td>

                                        <input type="hidden" name="old[]" value="{{$saleOrder->id}}" />

                                        <td>
                                            <select name="product_id[]" id="productname{{$u}}"
                                                class="form-control form-select" required>
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product )
                                                <option value="{{$product->id}}" {{( $product->id ==
                                                    $saleOrder->product_id)
                                                    ? 'selected' : '' }}>{{$product->product_name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td> <input type="text" id="price{{$u}}" name="price[]"
                                                value="{{$saleOrder->price}}" class="form-control" placeholder="Price"
                                                required></td>
                                        <td> <input type="text" id="qty{{$u}}" name="quality[]"
                                                value="{{$saleOrder->quality}}" class="form-control"
                                                placeholder="Quality" required></td>
                                        <td> <input type="text" id="total{{$u}}" name="total[]"
                                                value="{{$saleOrder->total}}" class="form-control" placeholder="Total"
                                                required readonly></td>
                                        <td>
                                            <button  onclick="deleteIt({{$saleOrder->id}})" type="button" class="btn btn-danger"><i
                                                class="mdi mdi-trash-can d-block font-size-16"></i></button> 
                                            {{-- <button  class="btn btn-danger waves-effect waves-light" title="Delete"><i class="mdi mdi-trash-can d-block font-size-16"></i></button></td> --}}
                                    </tr>
                                    @php
                                    $u++;
                                    @endphp
                                    @endforeach

                                </thead>
                                <tbody id="addInput">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('footer_script')
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<script src="{{asset('assets/js/pages/sweet-alerts.init.js')}}"></script>

{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script> --}}
<script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<script>
    $(function() {
                $("select[id^=productname]").on('change', function() {
                    var id = $(this).val();
                    console.log(id);
                    var last_num = $(this).attr('id').slice(-1);
                    $.ajax({
                        url: "{{ route('sale/getData') }}",
                        type: 'GET',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $("#price" + last_num).val(response);
                        }
                    });
                });

                $("input[id^=price]").keyup(function() {
                    var price = Number($(this).val());
                    console.log(price);
                    var last_num = $(this).attr('id').slice(-1);
                    var qty = Number($("#qty" + last_num).val());
                    $("#total" + last_num).val(qty * price);
                });
            });

            $("input[id^=qty]").keyup(function() {
                var qty = Number($(this).val());
                var last_num = $(this).attr('id').slice(-1);
                var price = Number($("#price" + last_num).val());
                $("#total" + last_num).val(qty * price);
            });

  
    $(document).ready(function () {
        @php
                $i = $u + 1;
                @endphp

                let i = {{ $i}};
$("#button").on('click', function () {
    let rowData = "<tr>";
    rowData += "<td>"+i+"</td>";
    rowData += "<td> <select name='product_id[]' class='form-control' id='productname"+i+"' > <option value=''>Select Product</option>  @foreach ($products as $product)  <option value='{{$product->id}}'>{{$product->product_name}}</option> @endforeach </select></td>";
    rowData += "<td><input type='number'  name='price[]' id='price"+i+"'  placeholder='Price....' class='form-control' ></td>";
    rowData += "<td><input type='number'  name='quality[]' id='qty"+i+"'  placeholder='qty....' class='form-control' ></td>";
    rowData += "<td><input type='number'  name='total[]' id='total"+i+"'  placeholder='total....' class='form-control' ></td>";
    rowData += "</tr>"
    $("#addInput").append(rowData);
    i++; 
    $("select[id^=productname]").on('change', function () {
       var id = $(this).val();
       var last_num = $(this).attr('id').slice(-1);
           $.ajax({
        url: "{{route('sale/getData')}}",
        type: 'GET',
        data: { id: id },
        success: function (response) {
       $("#price"+last_num).val(response);
        }
    });
});
$("input[id^=qty]").keyup(function () {
        var qty = Number($(this).val());
        var last_num = $(this).attr('id').slice(-1);
        var price = Number($("#price" + last_num).val());
        $("#total" + last_num).val(qty * price);
    });
    $("input[id^=price]").keyup(function () {
        var price = Number($(this).val());
        var last_num = $(this).attr('id').slice(-1);
        var qty = Number($("#qty" + last_num).val());
        $("#total" + last_num).val(qty * price);
    });
});
});

</script>

<script>
    function deleteIt(id) {
        $.ajax({
            url: '{{ url('sale/orderDelete') }}/' + id,
            type: 'DELETE',
            dataType: 'JSON',
            data: {
                "_token": "{{ csrf_token() }}"
            }
        }).done(function(response) {
            // Handle success response if needed
            console.log("Delete request successful");
        }).fail(function(jqXHR, textStatus, errorThrown) {
            // Handle error response if needed
            console.error("Delete request failed:", textStatus, errorThrown);
        });
    }
</script>
@endpush 