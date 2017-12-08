@extends('adminlte::layouts.app')

@section('main-content')

    <h1 class="page-header">{{$title}}</h1>


    <div class="row m-t-10">
        <form id="validate_agents" action="{{route('config-edit', $item->id)}}" method="post" enctype="multipart/form-data">
            <div class="col-md-8">

                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="ru">
                        <div class="panel panel-inverse">
                            <div class="panel-body">

                                {{--<div class="form-group">--}}
                                    {{--<label for="title">Name</label>--}}
                                    {{--<input type="text" name="name" class="form-control" id="name" placeholder="Name" data-target="#slug" value="{{object_get($item, 'name', old('name'))}}">--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <label for="title">Value</label>
                                    <input type="text" name="value" class="form-control" id="value" placeholder="Value" value="{{object_get($item, 'value', old('value'))}}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" class="form-control" id="description" placeholder="description" value="{{object_get($item, 'description', old('description'))}}">
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
                                {{--<div class="form-group">--}}
                                    {{--<label class="control-label" for="publish_date">Publish Date</label>--}}
                                    {{--<div class="input-group date datetimepicker">--}}
                                        {{--<input id="publish_date" name="publish_date" type="text" class="form-control" value="{{date('d.m.Y H:i', strtotime(object_get($item, 'publish_date', old('publish_date', date('d.m.Y H:i')))))}}"/>--}}
                                        {{--<span class="input-group-addon">--}}
                                            {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                                        {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <input type="submit" class="btn btn-success btn-block" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="row">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<div class="panel panel-inverse">--}}
                            {{--<div class="panel-heading">--}}
                                {{--<h4 class="panel-title">SEO</h4>--}}
                            {{--</div>--}}
                            {{--<div class="panel-body">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="slug">Slug</label>--}}
                                    {{--<input type="text" class="form-control" id="slug" name="slug" value="{{object_get($item, 'slug', old('slug'))}}">--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="old_id">Old ID</label>--}}
                                    {{--<input type="text" class="form-control" id="old_id" name="old_id" value="{{object_get($company, 'old_id', old('old_id'))}}">--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="meta_title">Meta title</label>--}}
                                    {{--<input type="text" class="form-control" id="meta_title" name="meta_title" value="{{object_get($district, 'meta_title', old('meta_title'))}}">--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="meta_description">Meta description</label>--}}
                                    {{--<input type="text" class="form-control" id="meta_description" name="meta_description" value="{{object_get($district, 'meta_description', old('meta_description'))}}">--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="meta_keywords">Meta keywords</label>--}}
                                    {{--<input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{object_get($district, 'meta_keywords', old('meta_keywords'))}}">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--@if($item->id)--}}
                    {{--<script>--}}
                        {{--var photo = {!! $photo  !!} || {};--}}
                    {{--</script>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-12">--}}
                            {{--<div class="panel panel-inverse">--}}
                                {{--<div class="panel-heading">--}}
                                    {{--<h4 class="panel-title">Photo</h4>--}}
                                {{--</div>--}}
                                {{--<div class="panel-body">--}}

                                    {{--<input name="image" type="file" class="image-upload" data-upload-url="{{route('item-image-upload', $item->id)}}">--}}

                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endif--}}
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