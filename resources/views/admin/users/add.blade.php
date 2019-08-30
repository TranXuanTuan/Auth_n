@extends('layouts.back.master')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
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
                        <form action="admin/users/add" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" placeholder="Please Enter Name" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Please Enter Email" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="password"  type="password" placeholder="Please Enter Password" />
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="form-control" type="password" name="password_confirmation" placeholder="Please Confirm Password" />
                            </div>
                            <button type="submit" class="btn btn-default">Add User</button>
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