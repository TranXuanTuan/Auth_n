@extends('layouts.back.master')

@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Post
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
                                <th>Title</th>
                                <th>Summary</th>
                                <th>Highlights</th>
                                <th>View</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr class="odd gradeX" align="center">
                                <td>{{$post->id}}</td>
                                <td>
                                    <p>{{$post->Title}}</p>
                                    <img width="100px"src="upload/post/{{$post->Image}}">
                                </td>
                                <td>{{$post->Summary}}</td>
                                <td>{{$post->Highlights}}</td>
                                <td>{{$post->View}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/posts/delete/{{$post->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/posts/edit/{{$post->id}}">Edit</a></td>
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