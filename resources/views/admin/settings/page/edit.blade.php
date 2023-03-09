@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Update Page</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update page</h3>
                            </div>
                            <form action="{{route('page.update',$page->id)}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="page_position">Page Position</label>
                                        <select name="page_position" class="form-control">
                                            <option value="1" @if($page->page_position == 1) selected @endif>Line One</option>
                                            <option value="2" @if($page->page_position == 2) selected @endif>Line Two</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="page_name">Page Name</label>
                                        <input type="text" class="form-control" name="page_name" value="{{$page->page_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="page_title">Page Title</label>
                                        <input type="text" class="form-control" name="page_title" value="{{$page->page_title}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Page Description</label>
                                        <textarea name="page_description" class="form-control textarea"> {{$page->page_description}} </textarea>
                                        <small>This data will show in your website</small>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" type="submit">Update Page</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
