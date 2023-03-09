<form action="{{ route('warehouse.update') }}" method="Post" id="add-form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="warehouse_name">Warehouse Name</label>
            <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" value="{{$warehouse->warehouse_name}}">
        </div>
        <input type="hidden" name="id" value="{{$warehouse->id}}">
        <div class="form-group">
            <label for="warehouse_address">Warehouse Address</label>
            <input type="text" class="form-control" id="warehouse_address" name="warehouse_address" value="{{$warehouse->warehouse_address}}">
        </div>
        <div class="form-group">
            <label for="warehouse_phone">Warehouse Phone</label>
            <input type="text" class="form-control" id="warehouse_phone" name="warehouse_phone" value="{{$warehouse->warehouse_phone}}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> <span class="d-none loader"> <i class="fas fa-spinner"></i>
                loading </span> <span class="btn_submit">Update</span></button>
    </div>
</form>