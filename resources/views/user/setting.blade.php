@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @include('user.sidebar')
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Dashboard') }}
                        <a href="{{ route('write.review') }}" style="float:right;"><i class="fas fa-pencil-alt"></i> Write a
                            review</a>
                    </div>

                    <div class="card-body">
                        <h4>Your Default Shipping Credentials.</h4><br>
                        <div>
                            <form action="{{ route('store.review.website') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Shipping Name</label>
                                            <input type="text" class="form-control" name="shipping_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Shipping Phone</label>
                                            <input type="number" class="form-control" name="shipping_phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Shipping Email</label>
                                            <input type="email" class="form-control" name="shipping_email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Shipping Address</label>
                                            <input type="text" class="form-control" name="shipping_address">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">City</label>
                                            <input type="text" class="form-control" name="shipping_city">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Shipping Country</label>
                                            <input type="text" class="form-control" name="shipping_country">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Shipping Zipcode</label>
                                            <input type="text" class="form-control" name="shipping_zipcode">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                </div>

                                <input type="submit" class="btn btn-info" />
                            </form>
                        </div>
                    </div>

                    <hr>

                    {{-- Password Change --}}

                    <div class="card-body">
                        <h4>Change Your Password</h4><br>
                        <div>
                            <form action="{{ route('customer.password.change') }}" method="POST">
                                @csrf
                                    <div class="form-group">
                                        <label for="">Old Password</label>
                                        <input type="password" class="form-control" name="old_password"
                                            placeholder="Enter Your Old Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="">New Password</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Enter Your New Password">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Confirm Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password_confirmation" placeholder="Confirm Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary" type="submit">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
@endsection
