<form action="{{ route('update.order.status') }}" method="POST" id="edit-form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="pickup_point_name">Customer Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="c_name" name="c_name" value="{{ $order->c_name }}" readonly>
        </div>
        <div class="form-group">
            <label for="">Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="c_email" name="c_email" value="{{ $order->c_email }}" readonly>
        </div>
        <input type="hidden" name="id" value="{{ $order->id }}">
        <div class="form-group">
            <label for="address">Address<span class="text-danger">*</span> </label>
            <input type="text" name="c_address" class="form-control" value="{{ $order->c_address }}" readonly>
        </div>

        <div class="form-group">
            <label for="pickup_point_phone">Phone Number <span class="text-danger">*</span></label>
            <input type="phone" class="form-control" id="c_phone" name="c_phone" value="{{ $order->c_phone }}" readonly>
        </div>

        <div class="form-group">
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
    $('#edit-form').submit(function(e) {
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
                $('#edit-form')[0].reset();
                $('#editModal').modal('hide');
                $('.loader').addClass('d-none');
                table.ajax.reload();
            }
        });
    });
</script>
