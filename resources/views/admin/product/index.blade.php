@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('product.create') }}" class="btn btn-primary">+ Add
                                New</a>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Product List Here</h3>
                            </div>
                            <div class="row p-2">
                                <div class="col-lg-2 form-group">
                                    <label for="">Category</label>
                                    <select name="category_id" class="form-control submitable" id="category_id">
                                        <option value="">All</option>
                                        @foreach ($category as $row)
                                            <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label for="">Brand</label>
                                    <select name="brand_id" id="brand_id" class="form-control submitable">
                                        <option value="">All</option>
                                        @foreach ($brand as $row)
                                            <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                               
                                <div class="col-lg-2 form-group">
                                    <label for="">Warehouse</label>
                                    <select name="warehouse" id="warehouse" class="form-control submitable">
                                        <option value="">All</option>
                                        @foreach ($warehouse as $row)
                                            <option value="{{ $row->warehouse_name }}">{{ $row->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label for="">Status</label>
                                    <select name="status" id="status" class="form-control submitable">
                                        <option value="1">All</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>

                                    </select>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped table-sm text-center ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Thumbnail</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Brand</th>
                                            <th>Featured</th>
                                            <th>Today Deal</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <form id="deleted_form" action="" method="delete">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script>
        $(function products() {
            table = $('.ytable').DataTable({
                "processing": true,
                "serverSide": true,
                "searching": true,
                "ajax": {
                    "url": "{{route('product.index')}}",
                    "data": function(e) {
                        e.category_id = $("#category_id").val();
                        e.brand_id = $("#brand_id").val();
                        e.status = $("#status").val();
                        e.warehouse_name = $("#warehouse_name").val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'thumbnail',
                        name: 'thumbnail'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'subcategory_name',
                        name: 'subcategory_name'
                    },
                    {
                        data: 'brand_name',
                        name: 'brand_name'
                    },
                    {
                        data: 'featured',
                        name: 'featured'
                    },
                    {
                        data: 'today_deal',
                        name: 'today_deal'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        });

        // dactive featured
        $('body').on('click', '.dactive_featured', function() {
            let id = $(this).data('id');
            var url = " {{ url('product/not-featured') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    table.ajax.reload();
                }
            });
        });

        // active featured
        $('body').on('click', '.active_featured', function() {
            let id = $(this).data('id');
            var url = " {{ url('product/active-featured') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    table.ajax.reload();
                }
            });
        });

        // dactive Today Deal
        $('body').on('click', '.dactive_today_deal', function() {
            let id = $(this).data('id');
            var url = " {{ url('product/dactive_today_deal') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    table.ajax.reload();
                }
            });
        });

        // active Today Deal
        $('body').on('click', '.active_today_deal', function() {
            let id = $(this).data('id');
            var url = " {{ url('product/active_today_deal') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    table.ajax.reload();
                }
            });
        });

        // dactive Status
        $('body').on('click', '.dactive_status', function() {
            let id = $(this).data('id');
            var url = " {{ url('product/dactive_status') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    table.ajax.reload();
                }
            });
        });

        // active Status
        $('body').on('click', '.active_status', function() {
            let id = $(this).data('id');
            var url = " {{ url('product/active_status') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    table.ajax.reload();
                }
            });
        });


        $(document).ready(function() {
            $(document).on('click', '#delete_product', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $('#deleted_form').attr('action', url);
                Swal.fire({
                        title: 'Are you want to delete?',
                        text: "",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $('#deleted_form').submit();
                        } else {
                            Swal('Your Data Is Safe!');
                        }
                    });
            });

            // Data passed here
            $('#deleted_form').submit(function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var request = $(this).serialize();
                $.ajax({
                    url: url,
                    type: 'post',
                    async: false,
                    data: request,
                    success: function(data) {
                        toastr.success(data)
                        $('#deleted_form')[0].reset();
                        table.ajax.reload();
                    }
                });
            });
        });

        // submitable class call for every change
        $(document).on('change', '.submitable', function() {
            $('.ytable').DataTable().ajax.reload();
        });
    </script>
@endsection
