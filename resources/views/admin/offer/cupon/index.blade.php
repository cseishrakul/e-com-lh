@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cupon</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">+ Add
                                New</button>
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
                                <h3 class="card-title">Cupon List Here</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Cupon Code</th>
                                            <th>Cupon Amount</th>
                                            <th>Cupon Date</th>
                                            <th>Cupon Status</th>
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


    {{-- edit modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>
     {{-- Warehouse Modal --}} 
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Cupon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('cupon.store') }}" method="POST" id="add-form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cupon_code">Cupon Code</label>
                        <input type="text" class="form-control" id="cupon_code" name="cupon_code"
                            placeholder="Enter Cupon Code">
                    </div>
                    <div class="form-group">
                        <label for="type">Cupon Type </label>
                        <select name="type" class="form-control" id="">
                            <option value="1">Fixed</option>
                            <option value="2">Percentage</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cupon_amount">Amount</label>
                        <input type="text" class="form-control" id="cupon_amount" name="cupon_amount"
                            placeholder="Enter Amount">
                    </div>

                    <div class="form-group">
                        <label for="valid_date">Valid Date</label>
                        <input type="date" class="form-control" id="valid_date" name="valid_date"
                            placeholder="Enter Valid Date">
                    </div>
                    <div class="form-group">
                        <label for="status">Cupon Staus </label>
                        <select name="status" class="form-control" id="">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"> <span class="d-none loader"> <i
                                class="fas fa-spinner"></i> loading </span> <span class="btn_submit"> <span
                                class="loader d-none">loading</span> Submit</span></button>
                </div>
            </form>
        </div>
    </div>
    </div>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script>
        $(function cupon() {
            table = $('.ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('cupon.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'cupon_code',
                        name: 'cupon_code'
                    },
                    {
                        data: 'cupon_amount',
                        name: 'cupon_amount'
                    },
                    {
                        data: 'valid_date',
                        name: 'valid_date'
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



        // Store Cupon
        $('#add-form').submit(function(e) {
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
                    $('#add-form')[0].reset();
                    $('#addModal').modal('hide');
                    table.ajax.reload();
                }
            });
        });
        $('body').on('click', '.edit', function() {
            let id = $(this).data('id');
            $.get("cupon/edit/" + id, function(data) {
                $("#modal_body").html(data);
            });
        });

        $('#add-form').submit(function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var request = $(this).serialize();
            $.ajax({
                url: url,
                type: 'post',
                async: false,
                data: request,
                success: function(data) {
                    toastr.success(data);
                    $('#add-form')[0].reset();
                    $('#addModal').modal('hide');
                    table.ajax.reload();
                }
            });
        });


        $(document).ready(function() {
            $(document).on('click', '#delete_cupon', function(e) {
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
    </script>
@endsection
