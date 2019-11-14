 @extends('layouts.backend.master')

 @section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('flash_message'))
                        <div class="alert alert-success">
                            {{session('flash_message')}}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Date/Time Added</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if($user->is_permission == 2)
                                        {{"Admin"}}
                                        @elseif($user->is_permission == 1)
                                        {{"Editor"}}
                                        @else
                                        {{"User"}}
                                        @endif
                                    </td>
                                    <td>{{$user->created_at->format('F d, Y h:ia') }}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/users/delete/{{$user->id}}"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/users/edit/{{$user->id}}">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection