@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Ticket</h1>
                    </div>
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
                                <h3 class="card-title">All Ticket List Here</h3>
                            </div>
                            <div class="row p-2">
                                <div class="col-lg-2 form-group">
                                    <label for="">Type</label>
                                    <select name="type" id="type" class="form-control submitable">
                                        <option value="Technical">Technical</option>
                                        <option value="Payment">Payment</option>
                                        <option value="Affiliate">Affiliate</option>
                                        <option value="Return">Return</option>
                                        <option value="Refund">Refund</option>

                                    </select>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label for="">Status</label>
                                    <select name="status" id="status" class="form-control submitable">
                                        <option value="0">All</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Replied</option>
                                        <option value="2">Closed</option>

                                    </select>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label for="">Date</label>
                                    <input type="date" name="date" id="date"
                                        class="form-control submitable_input">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id=""
                                    class="table table-bordered table-striped table-sm text-center ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>User</th>
                                            <th>Subject</th>
                                            <th>Service</th>
                                            <th>Priority</th>
                                            <th>Date</th>
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
                    "url": "{{ route('ticket.index') }}",
                    "data": function(e) {
                        e.type = $("#type").val();
                        e.status = $("#status").val();
                        e.date = $("#date").val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'subject',
                        name: 'subject'
                    },
                    {
                        data: 'service',
                        name: 'service'
                    },
                    {
                        data: 'priority',
                        name: 'priority'
                    },
                    {
                        data: 'date',
                        name: 'date'
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

        $(document).ready(function() {
            $(document).on('click', '#delete_ticket', function(e) {
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
        $(document).on('change', '.submitable_input', function() {
            $('.ytable').DataTable().ajax.reload();
        });
    </script>
@endsection
