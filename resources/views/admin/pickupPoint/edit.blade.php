<form action="{{ route('pickuppoint.update') }}" method="POST" id="edit-form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="pickup_point_name">Pickup Point Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="pickup_point_name" name="pickup_point_name" value="{{$data->pickup_point_name}}">
        </div>
        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="form-group">
            <label for="pickup_point_address">Pickup Address <span class="text-danger">*</span> </label>
            <input type="text" name="pickup_point_address" class="form-control"  value="{{$data->pickup_point_address}}">
        </div>

        <div class="form-group">
            <label for="pickup_point_phone">Phone Number <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="pickup_point_phone" name="pickup_point_phone" value="{{$data->pickup_point_phone}}">
        </div>

        <div class="form-group">
            <label for="pickup_point_phone_two">Another Phone Number</label>
            <input type="text" class="form-control" id="pickup_point_phone_two" name="pickup_point_phone_two" value="{{$data->pickup_point_phone_two}}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> <span class="d-none loader"> <i
                    class="fas fa-spinner"></i> loading </span> <span class="btn_submit"> <span
                    class="loader d-none">loading</span> Submit</span></button>
    </div>
</form>

<script>
    $('#edit-form').submit(function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var request =$(this).serialize();
        $.ajax({
          url:url,
          type: 'post',
          async: false,
          data: request,
          success: function(data){  
            toastr.success(data);
            $('#edit-form')[0].reset();
            $('#editModal').modal('hide');
            table.ajax.reload();
          }
        });
      });
      
</script>
