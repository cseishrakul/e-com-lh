<form action="{{route('childcategory.update')}}" method="POST" id="add-form">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Category/Subcategory</label>
            <select class="form-control" name="subcategory_id" required>
                @foreach ($category as $row)
                    @php
                     $subcat = DB::table('subcategories')->where('category_id',$row->id)->get();   
                    @endphp
                    <option disabled=""> {{$row->category_name}} </option>
                    @foreach($subcat as $row)
                        <option value="{{ $row->id }}" @if($row->id == $data->subcategory_id) selected @endif>---- {{ $row->subcategory_name }} </option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="form-group">
            <label for="category_name">Child Category Name</label>
            <input type="text" class="form-control" id="childcategory_name" name="childcategory_name" placeholder="Enter Child Category" required  value="{{$data->childcategory_name}}">
            <small id="" class="form-text text-muted">This is your child category</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>