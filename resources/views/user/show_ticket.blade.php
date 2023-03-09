@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @include('user.sidebar')
            </div>
            <div class="col-md-8">
                <div class="card p-2">
                    <h3>Your Ticket Details</h3>
                    <div class="row">
                        <div class="col-lg-9">
                            <strong>Subject: {{ $tickets->subject }}</strong><br>
                            <strong>Service: {{ $tickets->service }}</strong><br>
                            <strong>Priority: {{ $tickets->priority }}</strong><br>
                            <strong>Message: {{ $tickets->message }}</strong>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ asset($tickets->image) }}" class="">
                                <img src="{{ asset($tickets->image) }}" style="height:100px;width:100px;" alt=""
                                    class="">
                            </a>
                        </div>
                    </div>
                </div>

                {{-- All Message Reply Here! --}}
                @php
                    $replies = DB::table('replies')
                        ->where('ticket_id', $tickets->id)
                        ->orderBy('id', 'DESC')
                        ->get();
                @endphp

                <div class="card p-2 mt-2">
                    <strong>All Reply Message</strong>
                    <div class="card-body" style="height:400px;overflow-y:scroll">
                        @isset($replies)
                            @foreach ($replies as $row)
                                <div class="card @if($row->user_id==0) ml-4 mt-3 @endif">
                                    <div class="card-header @if($row->user_id==0) bg-info @else bg-danger @endif text-light"> <i class="fa fa-user"></i> @if ($row->user_id == 0) Admin @else {{ Auth::user()->name }}@endif </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p>{{$row->message}}</p>
                                            <footer class="blockquote-footer"> {{date('d F Y'),strtotime('$row->reply_date')}} </footer>
                                        </blockquote>
                                    </div>
                                </div>
                            @endforeach
                        @endisset

                    </div>
                    <form action="{{route('reply.ticket')}}" method="post" enctype="multipart/form-data">
                        @csrf
                           <div class="row">
                          <!-- left column -->
                          <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                              <div class="card-header">
                                <h3 class="card-title">Reply Ticket Message</h3>
                              </div>
                              <!-- /.card-header -->
                                <div class="card-body">
                                  <div class="row">
                                    <div class="form-group col-lg-12">
                                      <label for="exampleInputEmail1">Message<span class="text-danger">*</span> </label>
                                      <textarea type="text" class="form-control" name="message" required=""> </textarea>
                                      <input type="hidden" name="ticket_id" value="{{$tickets->id}}">
                                    </div>
                                    <div class="form-group col-lg-12">
                                      <label for="exampleInputPassword1">Image  </label>
                                      <input type="file" class="form-control"  name="image">
                                    </div>
                                  </div>
                                  <div>
                                      <button type="submit" class="btn btn-info">Reply Message</button>
                                  </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <a href="" class="btn btn-danger" style="float:right;"> Close Ticket </a>
                           </div>
                        </form> 
                </div>
            </div>
        </div>
    </div>
    <hr>
@endsection
