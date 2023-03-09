<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<form action="{{ route('campaign.update') }}" method="POST" id="add-form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="brand_name">Campaign Title </label>
            <input type="text" class="form-control" id="title" name="title"placeholder="Enter Brand" value="{{$data->title}}">
        </div>
        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Start Date <span class="text-danger">*</span></label>
                    <input type="date" name="start_date" value="{{$data->start_date}}" class="form-control" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">End Date <span class="text-danger">*</span></label>
                    <input type="date" name="end_date" value="{{$data->end_date}}" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for=""> Discount (%) <span class="text-danger">*</span></label>
                    <input type="number" name="discount" value="{{$data->discount}}" class="form-control" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for=""> Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control" id="">
                        <option value="1" @if($data->status==1) selected ="" @endif>Active</option>
                        <option value="0" @if($data->status==0) selected ="" @endif>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="brand_logo">Campaign Banner</label>
            <input type="file" class="form-control dropify" id="input-file-now" name="image" data-height="140">
            <input type="hidden" name="old_image" value="{{$data->image}}">
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