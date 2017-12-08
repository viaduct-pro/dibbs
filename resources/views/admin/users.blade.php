@extends('adminlte::layouts.app')

@section('main-content')
    <h1 class="page-header">Users</h1>

    <div class="row">

        <div class="col-md-12">


            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Select user</h4>
                </div>
                <div class="panel-body">
                    <a href="{{route('user-edit')}}" class="btn btn-primary pull-right">Add user</a>
                    <div class="clearfix"></div>
                    <div class="table-responsive m-t-10">
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                {{--<th class="width-xs">Фото</th>--}}
                                <th>Name</th>
                                <th>Avatar</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="width-50"></th>
                                <th class="width-50"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td class="width-xs text-center">
                                        @if($user->photo)
                                            <img class="profile-user-img img-responsive img-circle" src="/images/small/{{$user->photo->path}}/{{$user->photo->name}}">
                                        @endif
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role}}
                                    </td>
                                    <th class="width-50 text-center"><a href="{{route('user-edit', $user->id)}}"><i class="fa fa-pencil-square-o"></i></a></th>
                                    <th class="width-50 text-center"><a onclick="return window.confirm('Do you really want to delete?');" href="{{route('user-delete', $user->id)}}"><i class="fa fa-trash-o"></i></a></th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@stop