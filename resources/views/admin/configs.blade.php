@extends('adminlte::layouts.app')

@section('main-content')

    <h1 class="page-header">Configs</h1>

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Select from table</h4>
                </div>
                <div class="panel-body">
                    <a href="{{route('config-edit')}}" class="btn btn-primary pull-right">Add Config</a>
                    <div class="clearfix"></div>
                    <div class="table-responsive m-t-10">
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Value</th>
                                <th>Description</th>
                                <th class="width-50"></th>
                                <th class="width-50"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->value}}</td>
                                    <td>{{$item->description}}</td>

                                    <th class="width-50 text-center"><a href="{{route('config-edit', $item->id)}}"><i class="fa fa-pencil-square-o"></i></a></th>
                                    <th class="width-50 text-center"><a onclick="return window.confirm('Do you really want to delete?');" href="{{route('config-delete', $item->id)}}"><i class="fa fa-trash-o"></i></a></th>
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