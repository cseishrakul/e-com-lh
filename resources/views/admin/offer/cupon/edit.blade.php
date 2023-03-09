<form action="{{route('cupon.update')}}" method="POST" id="edit-form">
    @csrf
    <div class="form-group">
        <div class="modal-body">
            <div class="form-group">
                <label for="cupon_code">Cupon Code</label>
                <input type="text" class="form-control" id="cupon_code" name="cupon_code" value="{{$data->cupon_code}}">
            </div>
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="form-group">
                <label for="type">Cupon Type </label>
                <select name="type" class="form-control" id="">
                    <option value="1" @if($data->type==1) selected @endif>Fixed</option>
                    <option value="2" @if($data->type==2) selected @endif>Percentage</option>
                </select>
            </div>

            <div class="form-group">
                <label for="cupon_amount">Amount</label>
                <input type="text" class="form-control" id="cupon_amount" name="cupon_amount"value={{$data->cupon_amount}}>
            </div>

            <div class="form-group">
                <label for="valid_date">Valid Date</label>
                <input type="date" class="form-control" id="valid_date" name="valid_date" value="{{$data->valid_date}}">
            </div>
            <div class="form-group">
                <label for="status">Cupon Status </label>
                <select name="status" class="form-control" id="">
                    <option value="Active" @if($data->status=="active") selected @endif>Active</option>
                    <option value="Inactive" @if($data->status=="Inactive") selected @endif>Inactive</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"> <span class="d-none loader"> <i
                        class="fas fa-spinner"></i> loading </span> <span class="btn_submit"> <span
                        class="loader d-none">loading</span> Update</span></button>
        </div>
        
    </div>
</form>

<script>
    $('#edit-form').submit(function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var request =$(this).serialize();
        $.ajax({
          url:url,
          type:'post',
          async:false,
          data:request,
          success:function(data){  
            toastr.success(data);
            $('#edit-form')[0].reset();
            $('#editModal').modal('hide');
            table.ajax.reload();
          }
        });
      });
      
</script>
