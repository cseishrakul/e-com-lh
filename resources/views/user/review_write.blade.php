@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('user.sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                    <a href="{{route('write.review')}}" style="float:right;"><i class="fas fa-pencil-alt"></i> Write a review</a>
                </div>

                <div class="card-body">
                   <h4>Write Your Valuable Review Based On Our Product Quality and Services.</h4><br>
                   <div>
                       <form action="{{route('store.review.website')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Customer Name</label>
                            <input type="text" class="form-control" readonly="" value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group">
                            <label for="">Review</label>
                            <textarea name="review" id="" cols="20" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Rating</label>
                            <select name="rating" id="" class="form-control" style="min-width: 120px;">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5" selected>5</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-info" />
                       </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection
