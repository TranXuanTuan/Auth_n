@extends('layouts.front.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Permission</div>


                <div class="panel-body">


                    @if(checkPermission(['user','editor','admin']))
                    <a href="{{ url('users') }}"><button>Access All Users</button></a>
                    @endif


                    @if(checkPermission(['editor','admin']))
                    <a href="{{ url('editor') }}"><button>Access Editor</button></a>
                    @endif


                    @if(checkPermission(['admin']))
                    <a href="{{ url('admin') }}"><button>Access Admin</button></a>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
