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
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Payment Gateway</li>
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
                    <div class="col-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">AamerPay Payment Gateway</h3>
                            </div>
                            <form action="{{ route('update.aamerpay') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $aamerPay->id }}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="mailer">Store Id</label>
                                        <input type="text" class="form-control" name="store_id"
                                            value="{{ $aamerPay->store_id }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="mailer">Signature Key</label>
                                        <input type="text" class="form-control" name="signature_key"
                                            value="{{ $aamerPay->signature_key }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="status" value="1"
                                            @if ($aamerPay->status == 1) checked @endif>
                                        <label for="mailer">Live Server</label>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">SurjoPay Payment Gateway</h3>
                            </div>
                            <form action="{{ route('update.surjopay') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $surjoPay->id }}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="mailer">Store Id</label>
                                        <input type="text" class="form-control" name="store_id"
                                            value="{{ $surjoPay->store_id }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="mailer">Signature Key</label>
                                        <input type="text" class="form-control" name="signature_key"
                                            value="{{ $surjoPay->signature_key }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="status" value="1"
                                            @if ($aamerPay->status == 1) checked @endif>
                                        <label for="mailer">Live Server</label>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">SSL Commerze Payment Gateway</h3>
                            </div>
                            <form action="{{ route('update.ssl') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $ssl->id }}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="mailer">Store Id</label>
                                        <input type="text" class="form-control" name="store_id"
                                            value="{{ $ssl->store_id }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="mailer">Signature Key</label>
                                        <input type="text" class="form-control" name="signature_key"
                                            value="{{ $ssl->signature_key }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="status" value="1"
                                            @if ($aamerPay->status == 1) checked @endif>
                                        <label for="mailer">Live Server</label>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" type="submit">Update</button>
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
