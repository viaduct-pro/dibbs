@extends('adminlte::layouts.app')

@section('main-content')

    <h1 class="page-header">{{$title}}</h1>


    <div class="row m-t-10">
        <form action="{{route('item-edit', $item->id)}}" method="post" enctype="multipart/form-data">
            <div class="col-md-8">

                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="ru">
                        <div class="panel panel-inverse">
                            <div class="panel-body">

                                <div class="form-group">
                                    <label for="title">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" data-target="#slug" value="{{object_get($item, 'name', old('name'))}}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="textarea form-control" name="description" id="my_editor" placeholder="Enter text ..." rows="20">{{object_get($item, 'description', old('description'))}}</textarea>

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

                                <input type="submit" class="btn btn-success btn-block" value="Save">
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
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{object_get($item, 'slug', old('slug'))}}">
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
                                    <h4 class="panel-title">Photo</h4>
                                </div>
                                <div class="panel-body">

                                    <input name="image" type="file" class="image-upload" data-upload-url="{{route('item-image-upload', $item->id)}}">

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        </form>
    </div>
@stop