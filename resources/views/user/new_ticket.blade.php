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
                       <form action="{{route('store.ticket')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" name="subject">
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="">Priority</label>
                                <select name="priority" class="form-control" style="min-width:120px;">
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="">Service</label>
                                <select name="service" class="form-control" style="min-width:120px;">
                                    <option value="Technical">Technical</option>
                                    <option value="Payment">Payment</option>
                                    <option value="Affiliate">Affiliate</option>
                                    <option value="Return">Return</option>
                                    <option value="Refund">Refund</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="">Message</label>
                                <textarea name="message" cols="50" rows="" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="">Image</label>
                                <input type="file" name="image">
                            </div>
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
