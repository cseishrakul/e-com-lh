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
                            <li class="breadcrumb-item active">Onpage SEO</li>
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
                    <div class="col-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Your Seo Settings</h3>
                            </div>
                            <form action="{{ route('seo.setting.update',$data->id) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title"
                                            placeholder="Meta Title" value="{{ $data->meta_title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_author">Meta Author</label>
                                        <input type="text" class="form-control" name="meta_author"
                                            placeholder="Meta Author" value="{{ $data->meta_author }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tag">Meta Tag</label>
                                        <input type="text" class="form-control" name="meta_tag" placeholder="Meta Tag"
                                            value="{{ $data->meta_tag }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keyword">Meta Keyword</label>
                                        <input type="text" class="form-control" name="meta_keyword"
                                            placeholder="Meta Keyword" value="{{ $data->meta_keyword }}">
                                        <small>Exmple:ecommerce, online shop</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" class="form-control">
                                            {{$data->meta_description}}
                                        </textarea>
                                    </div>
                                    <strong class="text-center"><-- Others --></strong><br><br>
                                    <div class="form-group">
                                        <label for="meta_keyword">Google Verification</label>
                                        <input type="text" class="form-control" name="google_verification"
                                            placeholder="Google Verification" value="{{ $data->google_verification }}">
                                            <small>Put Here Only Verification Code</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="alexa_verification">Alexa Verification</label>
                                        <input type="text" class="form-control" name="alexa_verification"
                                            placeholder="Alexa Verification" value="{{ $data->alexa_verification }}">
                                            <small>Put Here Only Verification Code</small>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="google_verification">Google Analytics</label>
                                        <textarea name="google_verification" class="form-control">
                                            {{$data->google_verification}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="google_analytics">Google Adsense</label>
                                        <textarea name="google_analytics" class="form-control">
                                            {{$data->google_analytics}}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" type="submit">Update Password</button>
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
