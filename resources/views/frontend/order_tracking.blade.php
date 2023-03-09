@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/shop_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/shop_responsive.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('') }}/styles/product_responsive.css">
@section('content')
    @include('layouts.front_partial.collapse_nav')
    <div class="home">
        <div class="" data-parallax="scroll"
            data-image-src="{{ asset('frontend') }}/images/shop_background.jpg"></div>
        <div class="home_overlay"></div>
        <div class="home_content d-flex flex-column align-items-center justify-content-center">
            <h2 class="home_title">Track Your Order Now</h2>
        </div>
    </div>
    <div class="shop">
        <div class="container">
            <div class="row">
                <div class="card col-md-8 mx-auto">
                    <form action="{{route('check.order')}}" method="POST" class="p-3">
                        @csrf
                        <label for="">Order Id</label>
                        <input type="text" name="order_id" class="form-control" placeholder="Write your order id">
                        <button class="btn btn-info my-3">Track Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
