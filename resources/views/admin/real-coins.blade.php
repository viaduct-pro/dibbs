@extends('adminlte::layouts.app')

@section('main-content')

    <h1 class="page-header">Coins</h1>

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Select from table</h4>
                </div>
                <div class="panel-body">
                    <div class="clearfix"></div>
                    <div class="table-responsive m-t-10">
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Symbol</th>
                                <th>Price USD</th>
                                <th>Price BTC</th>
                                {{--<th class="width-50"></th>--}}
                                {{--<th class="width-50"></th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coins as $coin)
                                <tr>
                                    <td>{{$coin['name']}}</td>
                                    <td>{{$coin['symbol']}}</td>
                                    <td>{{$coin['price_usd']}}</td>
                                    <td>{{$coin['price_btc']}}</td>

                                    {{--<th class="width-50 text-center"><a href="{{route('item-edit', $item->id)}}"><i class="fa fa-pencil-square-o"></i></a></th>--}}
                                    {{--<th class="width-50 text-center"><a onclick="return window.confirm('Do you really want to delete?');" href="{{route('item-delete', $item->id)}}"><i class="fa fa-trash-o"></i></a></th>--}}
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