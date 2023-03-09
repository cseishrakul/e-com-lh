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
                        <div class="cart_title">Shopping Cart</div>
                        <div class="cart_items">
                            <ul class="cart_list">
                                @foreach ($content as $row)
                                    @php
                                        $product = DB::table('products')
                                            ->where('id', $row->id)
                                            ->first();
                                        $color = explode(',', $product->color);
                                        $sizes = explode(',', $product->size);
                                    @endphp
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image"><img
                                                src="{{ asset('public/files/product/' . $row->options->thumbnail) }}"
                                                alt=""></div>
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">{{ substr($row->name, 0, 20) }}..</div>
                                            </div>
                                            @if ($row->options->color != null)
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title">Color</div>
                                                    <div class="cart_item_text">
                                                        <select name="color" class="custom-select form-control-sm color" data-id="{{$row->rowId}}"
                                                            style="min-width:100px;">
                                                            @foreach ($color as $color)
                                                                <option value="{{ $color }}"
                                                                    @if ($color == $row->options->color) selected @endif>
                                                                    {{ $color }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($row->options->size != null)
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title">Size</div>
                                                    <div class="cart_item_text">
                                                        <select name="size" class="custom-select form-control-sm size" data-id="{{$row->rowId}}"
                                                            style="min-width:100px;">
                                                            @foreach ($sizes as $size)
                                                                <option
                                                                    value="{{ $size }}"@if ($size == $row->options->size) selected @endif>
                                                                    {{ $size }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title">Quantity</div>
                                                <div class="cart_item_text">
                                                    <input type="number" name="qty"
                                                        class="custom-select form-control-sm qty" data-id="{{$row->rowId}}" value="{{$row->qty}}"
                                                        min="1" style="max-width:90px;" />
                                                </div>
                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title">Price</div>
                                                <div class="cart_item_text">{{ $setting->currency }} {{ $row->price }} x
                                                    {{ $row->qty }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Total</div>
                                                <div class="cart_item_text">{{ $setting->currency }}
                                                    {{ $row->qty * $row->price }} </div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Action</div>
                                                <div class="cart_item_text"><a href="#" class="text-danger"
                                                        data-id="{{ $row->rowId }}" id="removeProduct">X</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <hr>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Order Total -->
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount">{{$setting->currency}} {{ Cart::total() }}</div>
                            </div>
                        </div>

                        <div class="cart_buttons">
                            <a href="{{route('cart.empty')}}" class="button cart_button_clear">Empty Cart</a>
                            <a href="{{route('checkout')}}" class="button cart_button_checkout">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript">
        $('body').on('click', '#removeProduct', function() {
            let id = $(this).data('id');
            $.ajax({
                url: '{{ url('cartproduct/remove/') }}/' + id,
                type: 'get',
                async: false,
                success: function(data) {
                    toastr.success(data);
                    location.reload();
                }
            });
        });

        // qty change with ajax
        $('body').on('blur', '.qty', function() {
            let qty = $(this).val();
            let rowId = $(this).data('id');
            $.ajax({
                url: '{{ url('cartproduct/updateqty/') }}/' + rowId + '/' + qty,
                type: 'get',
                async: false,
                success: function(data) {
                    toastr.success(data);
                    location.reload();
                }
            });
        });

        // color change with ajax
        $('body').on('blur', '.color', function() {
            let color = $(this).val();
            let rowId = $(this).data('id');
            $.ajax({
                url: '{{ url('cartproduct/updatecolor/') }}/' + rowId + '/' + color,
                type: 'get',
                async: false,
                success: function(data) {
                    toastr.success(data);
                    location.reload();
                }
            });
        });

        // size change with ajax
        $('body').on('blur', '.size', function() {
            let size = $(this).val();
            let rowId = $(this).data('id');
            $.ajax({
                url: '{{ url('cartproduct/updatesize/') }}/' + rowId + '/' + size,
                type: 'get',
                async: false,
                success: function(data) {
                    toastr.success(data);
                    location.reload();
                }
            });
        });
    </script>
    <script src="{{ asset('frontend') }}/js/cart_custom.js"></script>
@endsection
