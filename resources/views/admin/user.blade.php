@extends('adminlte::layouts.app')

@section('main-content')

    <h1 class="page-header">{{$title}}</h1>


    <div class="row m-t-10">
        <form action="{{route('user-edit', $item->id)}}" method="post" enctype="multipart/form-data">
            <div class="col-md-8">

                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="ru">
                        <div class="panel panel-inverse">
                            <div class="panel-body">

                                <div class="form-group">
                                    <label for="title">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" data-target="#slug" value="{{object_get($item, 'name', old('name'))}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <h4 class="panel-title">Settings</h4>
                            </div>
                            <div class="panel-body">
                                {{--<div class="form-group">--}}
                                {{--<label>--}}
                                {{--<input type="checkbox" class="switchery" name="excludeFromRating" value="1" {{($company->excludeFromRating) ? 'checked' : ''}}/>Изключить с рейтинга--}}
                                {{--</label>--}}
                                {{--</div>--}}

                                <input type="submit" class="btn btn-success btn-block" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <h4 class="panel-title">Profile</h4>
                            </div>
                            <div class="panel-body">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle"
                                         @if($item->photo)
                                         src="/images/avatar/{{$item->photo->path}}{{$item->photo->name}}"
                                         @else
                                         src="{{ Gravatar::get($item->email) }}"
                                         @endif
                                         alt="User profile picture">

                                    <h3 class="profile-username text-center">{{$item->name}}</h3>

                                    <p class="text-muted text-center">{{$item->role}}</p>

                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>Email</b> <a class="pull-right">{{$item->email}}</a>
                                        </li>
                                    </ul>
                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>Posts count</b> <a class="pull-right">{{count($item->posts)}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <h4 class="panel-title">SEO</h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <?php
                                        $roles = [
                                            'user' => 'user',
                                            'manager' => 'manager',
                                            'admin' => 'admin'
                                        ];
                                        ?>
                                    <label for="status">Role</label>
                                    <select id="role" class="form-control selectpicker" name="role">
                                        <option value="0">-</option>
                                        @foreach($roles as $key=>$category)
                                            <option {{(!empty($item) ? $item->role : '') == $key ? 'selected' : ''}} value="{{$key}}">{{$category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($item->id)
                    <script>
                      var photo = {!! $photo  !!} || {};
                    </script>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-inverse">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Фото</h4>
                                </div>
                                <div class="panel-body">

                                    <input name="image" type="file" class="image-upload" data-upload-url="{{route('user-image-upload', $item->id)}}">

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </form>
    </div>

    {{--@if($item->id)--}}
        {{--<script>--}}
            {{--var gallery = {!!$gallery!!} || {};--}}
        {{--</script>--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="panel panel-inverse">--}}
                    {{--<div class="panel-heading">--}}
                        {{--<h4 class="panel-title">Галерея</h4>--}}
                    {{--</div>--}}
                    {{--<div class="panel-body">--}}
                        {{--<input name="image" type="file" multiple class="company-gallery-upload"--}}
                               {{--data-upload-url="{{route('item-gallery-upload', $item->id)}}">--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--@endif--}}
@stop