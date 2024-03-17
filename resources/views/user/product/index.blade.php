@extends('user.layouts.app')
@section('title', 'Product')
@push('header_script')
<link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"
    type="text/css" />
{{--
<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/toastr/build/toastr.min.css')}}"> --}}


@endpush
@section('main-content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Product Details</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item"><a class="btn btn-primary text-white"
                            href="{{route('product/create')}}"> <i class="ri-add-fill"></i>Add</a></li>
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
                            <th>Photo</th>
                            <th>Category Name</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Opertion</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>


                </table>

            </div>
        </div>
    </div>

</div>
@endsection
@push('footer_script')
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<script src="{{asset('assets/js/pages/sweet-alerts.init.js')}}"></script>

<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<!-- toastr init -->
{{-- <script src="{{asset('assets/js/pages/toastr.init.js')}}"></script>

<!-- Sweet alert init js-->
<script src="{{asset('assets/js/pages/sweet-alerts.init.js')}}"></script> --}}

<script>
    $(function (){

var table=$('#datatable').DataTable({
    processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true, 
    ajax:{
        url: '{{route('product/getData')}}'
    },
    columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            // {data: 'image', name: 'image '},
            {
                data: 'image',
                name: 'image',
                render: function(data, type, full, meta) {
                    // Manipulate the data here to render the image
                    return '<img src="{{ asset('storage/') }}/' + data + '" width="100" height="100" />';
                }
            },
            // {data: 'image', name: 'image', orderable: false, searchable: false},

            {data: 'name', name: 'name'},

            {data: 'product_name', name: 'product_name'},
            {data: 'price', name: 'price'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
})
});
</script>
<script>
    function deleteIt(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ml-2 mt-2",
            buttonsStyling: !1,
        }).then(function (e) {
            if (e.value) {
                $.ajax({
                    url: '{{ url('product/delete') }}/' + id,
                    type: 'delete',
                    dataType: "JSON",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function () {
                        $("#datatable").DataTable().draw(false);
                    }
                });

                Swal.fire({title: "Deleted!", text: "Your file has been deleted.", icon: "success"})
            } else {
                Swal.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                })
            }
        })
    }
</script>
@endpush