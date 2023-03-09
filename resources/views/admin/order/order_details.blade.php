<form action="{{route('update.order.status')}}" method="POST" id="view_edit_form">
    @csrf
    <input type="hidden" name="id" value="{{$order->id}}">
    <input type="hidden" name="c_name" value="{{$order->c_name}}">
    <input type="hidden" name="c_phone" value="{{$order->c_phone}}">
    <input type="hidden" name="c_email" value="{{$order->c_email}}">
    <input type="hidden" name="c_address" value="{{$order->c_address}}">
    <div class="modal-body">
        <strong>Order Details</strong>
        <div class="row">
            <div class="col-md-5">
                Name: {{$order->c_name}}
            </div>
            <div class="col-md-2">
                Phone: {{$order->c_phone}}
            </div>
            <div class="col-md-5">
                Email: {{$order->c_email}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Country: {{$order->c_country}}
            </div>
            <div class="col-md-4">
                City: {{$order->c_city}}
            </div>
            <div class="col-md-4">
                Zipcode: {{$order->c_zipcode}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Order Id: {{$order->order_id}}
            </div>
            <div class="col-md-4">
                Subtotal: {{$order->subtotal}} {{$setting->currency}}
            </div>
            <div class="col-md-4">
                Total: {{$order->total}} {{$setting->currency}}
            </div><br>
            <div>
                <table class="table">
                    <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Price * Qty</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_detail as $key => $row)
                                    <tr>
                                        <td> {{ $row->product_name }} </td>
                                        <td> {{ $row->color }} </td>
                                        <td> {{ $row->size }} </td>
                                        <td> {{ $row->single_price }} * {{ $row->quantity }} {{ $setting->currency }} </td>
                                        <td> {{ $row->subtotal_price }} {{ $setting->currency }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                </table>
            </div>
        </div>
        <div class="form-group mt-5">
            <label for="pickup_point_phone_two">Order Status</label>
            <select name="status" id="status" class="form-control">
                <option value="0" @if ($order->status == 0) selected @endif>All</option>
                <option value="0" @if ($order->status == 0) selected @endif>Pending</option>
                <option value="1" @if ($order->status == 1) selected @endif>Recieved</option>
                <option value="2" @if ($order->status == 2) selected @endif>Shipped</option>
                <option value="3" @if ($order->status == 3) selected @endif>Completed</option>
                <option value="4" @if ($order->status == 4) selected @endif>Return</option>
                <option value="5" @if ($order->status == 5) selected @endif>Cancel</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> <span class="d-none loader"> <i class="fas fa-spinner"></i>
                loading </span> <span class="btn_submit"> <span class="loader d-none">loading</span>
                Submit</span></button>
    </div>
</form>

<script>
    $('#view_edit_form').submit(function(e) {
        e.preventDefault();
        $('.loader').removeClass('d-none');
        var url = $(this).attr('action');
        var request = $(this).serialize();
        $.ajax({
            url: url,
            type: 'post',
            async: false,
            data: request,
            success: function(data) {
                toastr.success(data);
                $('#view_edit_form')[0].reset();
                $('#viewModal').modal('hide');
                $('.loader').addClass('d-none');
                table.ajax.reload();
            }
        });
    });
</script>
