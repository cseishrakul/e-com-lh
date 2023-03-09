@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_responsive.css">
    @include('layouts.front_partial.collapse_nav')
    <!-- Cart -->
    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart_container">
                        <div class="cart_title">Your Wishlist</div>
                        <div class="cart_items">
                            <ul class="cart_list">
                                @foreach ($wishlist as $row)
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image"><img
                                                src="{{ asset('public/files/product/' . $row->thumbnail) }}"
                                                alt=""></div>
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">{{$row->name}}</div>
                                            </div>
                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title">Date</div>
                                                <div class="cart_item_text">
                                                    {{$row->date}}
                                                </div>
                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                
                                                <a href="{{route('product.details',$row->slug)}}" class="button cart_button_clear mt-5">Product Details</a>    
                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                
                                                <a href="{{route('wishlist.delete',$row->id)}}" class="text-danger">X</a>    
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <hr>
                                @endforeach
                            </ul>
                        </div>

                        <div class="cart-buttons">
                            
                        </div>
                        <div class="cart_buttons">
                            <a href="{{route('wishlist.clear')}}" class="button cart_button_checkout btn-info btn-right">Clear Wishlist</a>
                            <a href="{{url('/')}}" class="button cart_button_checkout btn-info btn-right">Back Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    
    <script src="{{ asset('frontend') }}/js/cart_custom.js"></script>
@endsection
