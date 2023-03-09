@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pickup Point</h1>
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
                                <h3 class="card-title">Pickup Point List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Pickup Point</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Another Phone</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pickup Point</h5>
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
                <h5 class="modal-title" id="exampleModalLabel">Add New Pickup Point</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('pickuppoint.store') }}" method="POST" id="add-form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pickup_point_name">Pickup Point Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="pickup_point_name" name="pickup_point_name"
                            placeholder="Enter Pickup Point Name">
                    </div>
                    <div class="form-group">
                        <label for="pickup_point_address">Pickup Address <span class="text-danger">*</span> </label>
                        <input type="text" name="pickup_point_address" class="form-control" placeholder="Enter Pickup Address">
                    </div>

                    <div class="form-group">
                        <label for="pickup_point_phone">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="pickup_point_phone" name="pickup_point_phone"
                            placeholder="Enter Phone Number">
                    </div>

                    <div class="form-group">
                        <label for="pickup_point_phone_two">Another Phone Number</label>
                        <input type="text" class="form-control" id="pickup_point_phone_two" name="pickup_point_phone_two"
                            placeholder="Enter Another Phone Number">
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
                ajax: "{{ route('pickuppoint.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'pickup_point_name',
                        name: 'pickup_point_name'
                    },
                    {
                        data: 'pickup_point_address',
                        name: 'pickup_point_address'
                    },
                    {
                        data: 'pickup_point_phone',
                        name: 'pickup_point_phone'
                    },
                    {
                        data: 'pickup_point_phone_two',
                        name: 'pickup_point_phone_two'
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
            $.get("pickup-point/edit/" + id, function(data) {
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
            $(document).on('click', '#delete_pickup', function(e) {
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
