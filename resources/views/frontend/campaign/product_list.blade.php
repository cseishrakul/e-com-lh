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
            <h2 class="home_title">Campaign Product</h2>
        </div>
    </div>
    <div class="shop">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- Shop Content -->

                    <div class="shop_content">
                        <div class="shop_bar clearfix">
                            <div class="shop_product_count"><span>{{ count($product) }}</span> products found</div>
                            <div class="shop_sorting">
                                <span>Sort by:</span>
                                <ul>
                                    <li>
                                        <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></i></span>
                                        <ul>
                                            <li class="shop_sorting_button"
                                                data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                                            <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name
                                            </li>
                                            <li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="product_grid row">
                            <div class="product_grid_border"></div>
                            @foreach ($product as $row)
                                <div class="product_item is_new col-lg-2">
                                    <div class="product_border"></div>
                                    <div
                                        class="product_image d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset('public/files/product/' . $row->thumbnail) }}" alt="">
                                    </div>
                                    <a href="" class="quick_view mt-2" id="{{ $row->id }}"
                                        data-toggle="modal" data-target="#exampleModalCenter"><i
                                            class="fas fa-eye"></i></a>
                                    <div class="product_content">
                                            <div class="product_price">{{ $setting->currency }}{{ $row->selling_price }}
                                            </div>
                                        <div class="product_name">
                                            <div><a href="{{ route('product.details', $row->slug) }}"
                                                    tabindex="0">{{ $row->name }}</a></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <!-- Shop Page Navigation -->

                        <div class="shop_page_nav d-flex flex-row">
                            <ul class="page_nav d-flex flex-row">
                                {{ $product->links() }}
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('frontend') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('frontend') }}/plugins/Isotope/isotope.pkgd.min.js"></script>
    <script src="{{ asset('frontend') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <script src="{{ asset('frontend') }}/plugins/parallax-js-master/parallax.min.js"></script>
    <script src="{{ asset('frontend') }}/js/shop_custom.js"></script>
 
@endsection
