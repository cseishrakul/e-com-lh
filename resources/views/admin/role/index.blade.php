@extends('layouts.admin')

@section('admin_content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User Role</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{route('create.role')}}" class="btn btn-primary">+ Add
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
                                <h3 class="card-title">All User Role</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped text-center">
                                    <thead>
                                         <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td>
                                                    @if ($row->category == 1) <span class="badge badge-success">Category</span>@endif
                                                    @if ($row->product == 1) <span class="badge badge-success">Product</span>@endif
                                                    @if ($row->offer == 1) <span class="badge badge-success">Offer</span>@endif
                                                    @if ($row->order == 1) <span class="badge badge-success">Order</span>@endif
                                                    @if ($row->blog == 1) <span class="badge badge-success">Blog</span>@endif
                                                    @if ($row->pickup == 1) <span class="badge badge-success">Pickup</span>@endif
                                                    @if ($row->ticket == 1) <span class="badge badge-success">Ticket</span>@endif
                                                    @if ($row->contact == 1) <span class="badge badge-success">Contact</span>@endif
                                                    @if ($row->report == 1) <span class="badge badge-success">Report</span>@endif
                                                    @if ($row->setting == 1) <span class="badge badge-success">Setting</span>@endif
                                                    @if ($row->userrole == 1) <span class="badge badge-success">Userrole</span>@endif
                                                </td>
                                                <td>
                                                    <a href="{{route('role.edit',$row->id)}}" class="btn btn-info"> <i class="fas fa-edit"></i> </a>
                                                    <a href="{{ route('role.delete',$row->id) }}" class="btn btn-danger"
                                                        id="delete"> <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

@endsection
