@extends('layouts.backend.master')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Post
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                        @endif

                        @if(session('flash_message'))
                            <div class="alert alert-success">
                                {{session('flash_message')}}
                            </div>
                        @endif
                        <form action="admin/posts/add" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" name="Title" placeholder="Please Enter Title" />
                            </div>
                            <div class="form-group">
                                <label>Summary</label>
                                <textarea id="demo" name="Summary" class="form-control ckeditor" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Body</label>
                                <textarea id="demo" name="Body" class="form-control ckeditor" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input class="form-control" type="file" name="Image">
                            </div>
                            <div class="form-group">
                                <label>Highlights</label>
                                <label class="radio-inline">
                                    <input name="Highlights" value="0" type="radio">No
                                </label>
                                <label class="radio-inline">
                                    <input name="Highlights" value="1" type="radio">Yes
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection