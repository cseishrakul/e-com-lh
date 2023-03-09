<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<form action="{{ route('brand.update') }}" method="POST" id="add-form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="brand_name">Brand Name</label>
            <input type="text" class="form-control" id="brand_name" name="brand_name"placeholder="Enter Brand" value="{{$data->brand_name}}">
            <small id="" class="form-text text-muted">This is your brand</small>
        </div>
        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="form-group">
            <label for="brand_logo">Brand Logo</label>
            <input type="file" class="form-control dropify" id="input-file-now" name="brand_logo" data-height="140">
            <input type="hidden" name="old_logo" value="{{$data->brand_logo}}">
            <small id="" class="form-text text-muted">This is your brand logo</small>
        </div>
        <div class="form-group">
            <label for="brand_logo">Home Page Show</label>
            <select name="front_page" class="form-control">
                <option value="1" @if ($data->front_page==1) selected @endif>Yes</option>
                <option value="0" @if ($data->front_page==0) selected @endif>No</option>
            </select>
            <small id="" class="form-text text-muted">Will This Brand Show in Homepage?</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $('.dropify').dropify();
    </script>