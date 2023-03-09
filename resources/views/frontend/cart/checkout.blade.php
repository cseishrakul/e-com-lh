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
                <div class="col-lg-8">
                    <div class="cart_container card p-3">
                        <div class="cart_title text-center my-3">Billing Address</div>
                        <form action="{{route('order.place')}}" method="POST" id="order_place">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="">Customer Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="c_name"
                                        value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">Customer Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="c_phone"
                                        value="{{ Auth::user()->phone }}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">Email Address </label>
                                    <input type="email" class="form-control" name="c_email" placeholder="your@email.com">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">Shipping Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="c_address" placeholder="Your Address"
                                        required>
                                </div>
                                
                                <div class="form-group col-lg-6">
                                    <label for="">City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="c_city"
                                        placeholder="City">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="">Country <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="c_country" placeholder="Your Country"
                                        required>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">Zip Code <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="c_zipcode" placeholder="Zipcode"
                                        required>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">Extra Phone </label>
                                    <input type="number" class="form-control" name="c_extra_phone"
                                        placeholder="Extra Phone">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <label>Paypal</label>
                                    <input type="radio" name="payment_type" value="Paypal">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>Bkash/Rocket/Nagad </label>
                                    <input type="radio" name="payment_type" value="Aamarpay" checked="">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>Hand Cash</label>
                                    <input type="radio" name="payment_type" value="Hand Cash">
                                </div>

                            </div>

                            <button type="submit" class="btn btn-info mb-3">Order Place</button>
                            <div class="spinner-grow" role="status">
                                <span class="visually-hidden d-none">Loading...</span>
                              </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="p-4">
                            <div class="pl-4 pt-2">
                                <p style="color: black;">Subtotal: <span style="float: right; padding-right: 5px;">{{ Cart::subtotal() }} {{ $setting->currency }}</span> </p>
                                {{-- coupon apply --}}
                                @if(Session::has('coupon'))
                                <p style="color: black;">coupon:({{ Session::get('coupon')['name'] }}) <a href="{{route('coupon.remove')}}" class="text-danger">X</a> <span style="float: right; padding-right: 5px;">{{ Session::get('coupon')['discount'] }} {{ $setting->currency }}</span>  </p>
                                @else
                                @endif
    
                                <p style="color: black;">Tax: <span style="float: right; padding-right: 5px;">0.00 %</span></p>
                                <p style="color: black;">shipping: <span style="float: right; padding-right: 5px;">0.00 {{ $setting->currency }}</span></p>
    
                                @if(Session::has('coupon'))
                                <p style="color: black;"><b> Total: <span style="float: right; padding-right: 5px;"> {{ Session::get('coupon')['after_discount'] }} {{ $setting->currency }} </span></b></p>
                                @else
                                    <p style="color: black;"><b> Total: <span style="float: right; padding-right: 5px;"> {{ Cart::total() }} {{ $setting->currency }} </span></b></p>
                                @endif
                            </div><hr>
    
                            @if(!Session::has('coupon'))
                            <form action="{{ route('apply.coupon') }}" method="post">
                                @csrf
                                <div class="p-4">
                                  <div class="form-group">
                                    <label>Coupon Apply</label>
                                    <input type="text" class="form-control" name="coupon" required="" placeholder="Coupon Code" autocomplete="off">
                                  </div>
                                  <div class="form-group">
                                      <button type="submit" class="btn btn-info">Apply Coupon</button>
                                  </div>
                                </div>	
                            </form>
                            @endif
                        </div>
                    </div>
                    <div class="cart_buttons">
                        <a href="{{ route('checkout') }}" class="button cart_button_checkout">Payment Now</a>
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
