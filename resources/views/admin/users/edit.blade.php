@extends('layouts.backend.master')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>{{$user->name}}</small>
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
                        <form action="admin/users/edit/{{$user->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" placeholder="Please Enter Name" value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Please Enter Email" value="{{$user->email}}" readonly />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="changePassword" id="changePassword">
                                <label>Password</label>
                                <input class="form-control password" name="password"  type="password" placeholder="Please Enter Password" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="form-control password" type="password" name="password_confirmation" placeholder="Please Confirm Password" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>User Level</label>
                                <label class="radio-inline">
                                    <input name="is_permission" value="2"
                                    @if($user->is_permission == 2)
                                        {{"checked"}}
                                    @endif

                                     type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="is_permission" value="1"
                                    @if($user->is_permission == 1)
                                        {{"checked"}}
                                    @endif type="radio">Editor
                                </label>
                                <label class="radio-inline">
                                    <input name="is_permission" value=" "
                                    @if($user->is_permission == 0)
                                        {{"checked"}}
                                    @endif type="radio">User
                                </label>
                            </div>
                            
                            <button type="submit" class="btn btn-default">Edit User</button>
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

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#changePassword").change(function(){
                if ($(this).is(":checked")) 
                {
                    $(".password").removeAttr('disabled');
                }
                else
                {
                    $(".password").attr('disabled',' ');
                }
            });
        });
    </script>
@endsection