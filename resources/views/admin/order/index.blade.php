@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Order</h1>
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
                                <h3 class="card-title">All Order List Here</h3>
                            </div>
                            <div class="row p-2">
                                <div class="col-lg-2 form-group">
                                    <label for="">Payment Type</label>
                                    <select name="payment_type" id="payment_type" class="form-control submitable">
                                        <option value="All">All</option>
                                        <option value="Hand Cash">Hand Cash</option>
                                        <option value="AamarPay">AamarPay</option>
                                        <option value="Paypal">Paypal</option>
                                    </select>
                                </div>

                                <div class="col-lg-2 form-group">
                                    <label for="">Date</label>
                                    <input type="date" name="date" id="date"
                                        class="form-control submitable_input">
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label for="">Status</label>
                                    <select name="status" id="status" class="form-control submitable">
                                        <option value="0">All</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Recieved</option>
                                        <option value="2">Shipped</option>
                                        <option value="3">Completed</option>
                                        <option value="4">Return</option>
                                        <option value="5">Cancel</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id=""
                                    class="table table-bordered table-striped table-sm text-center ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Subtotal ({{ $setting->currency }})</th>
                                            <th>Total ({{ $setting->currency }})</th>
                                            <th>Payment Type</th>
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
        {{-- edit modal --}}
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="modal_body">

                    </div>
                </div>
            </div>
        </div>
        {{-- view modal --}}
        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="view_modal_body">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script>
        $(function products() {
            table = $('.ytable').DataTable({
                "processing": true,
                "serverSide": true,
                "searching": true,
                "ajax": {
                    "url": "{{ route('admin.order.index') }}",
                    "data": function(e) {
                        e.status = $("#status").val();
                        e.date = $("#date").val();
                        e.payment_type = $("#payment_type").val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'c_name',
                        name: 'c_name'
                    },
                    {
                        data: 'c_phone',
                        name: 'c_phone'
                    },
                    {
                        data: 'c_email',
                        name: 'c_email'
                    },
                    {
                        data: 'subtotal',
                        name: 'subtotal'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'payment_type',
                        name: 'payment_type'
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

        // Order Edit
        $('body').on('click', '.edit', function() {
            let id = $(this).data('id');
            var url = " {{ url('order/admin/edit') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    $('#modal_body').html(data);
                }
            });
        });

        // Order Edit
        $('body').on('click', '.view', function() {
            let id = $(this).data('id');
            var url = " {{ url('order/admin/view') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    $('#view_modal_body').html(data);
                }
            });
        });

        
        // submitable class call for every change
        $(document).on('change', '.submitable', function() {
            $('.ytable').DataTable().ajax.reload();
        });

        // submitable_input class call for every change
        $(document).on('blur', '.submitable_input', function() {
            $('.ytable').DataTable().ajax.reload();
        });
    </script>
@endsection
