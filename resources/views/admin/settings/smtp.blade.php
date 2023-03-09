@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">SMTP Mail</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">SMTP Mail Settings</h3>
                            </div>
                            <form action="{{ route('smtp.setting.update', $smtp->id) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="mailer">Mail Mailer</label>
                                        <input type="text" class="form-control" name="mailer" placeholder="Mail Mailer"
                                            value="{{ $smtp->mailer }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="host">Mail Host</label>
                                        <input type="text" class="form-control" name="host" placeholder="Mail Host"
                                            value="{{ $smtp->host }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="port">Mail Port</label>
                                        <input type="text" class="form-control" name="port" placeholder="Mail Port"
                                            value="{{ $smtp->port }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="user_name">Mail Username</label>
                                        <input type="text" class="form-control" name="user_name"
                                            placeholder="Mail Username" value="{{ $smtp->user_name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mail Password</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Mail Password" value="{{ $smtp->password }}">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" type="submit">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
