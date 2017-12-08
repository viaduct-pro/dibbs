@extends('adminlte::layouts.app')

@section('main-content')

    <h1 class="page-header">ICO-Items</h1>

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Select from table</h4>
                </div>
                <div class="panel-body">
                    <a href="{{route('item-edit')}}" class="btn btn-primary pull-right">Edit Item</a>
                    <div class="clearfix"></div>
                    <div class="table-responsive m-t-10">
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Coin</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Published</th>
                                <th class="width-50"></th>
                                <th class="width-50"></th>
                                <th class="width-50"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>
                                        @if($item->coins)
                                            @foreach($item->coins as $coin)
                                                <div data-main="{{$coin->value}}" class="btn btn-default coin-label"> {{$coin->symbol}}</div>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td>{{$item->published == 1 ? 'published' : 'not published'}}</td>

                                    <th class="width-50 text-center">
                                        @if($item->published == 1)
                                            <a class="send" link-data="{{route('item-unpublish', $item->id)}}" style="cursor: pointer;"><i data-title="Unpublish" class="publish fa fa-times"></i></a>
                                        @else
                                            <a class="send" link-data="{{route('item-publish', $item->id)}}" style="cursor: pointer;"><i data-title="Publish" class="publish fa fa-check"></i></a>
                                        @endif
                                    </th>
                                    <th class="width-50 text-center"><a class="send" href="{{route('item-edit', $item->id)}}"><i data-title="Edit" class="publish fa fa-pencil-square-o"></i></a></th>
                                    <th class="width-50 text-center"><a class="send" onclick="return window.confirm('Do you really want to delete?');" href="{{route('item-delete', $item->id)}}"><i data-title="Delete" class="publish fa fa-trash-o">

                                            </i></a></th>
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