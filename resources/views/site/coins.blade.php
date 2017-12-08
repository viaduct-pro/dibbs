@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-striped table-bordered table-list">
            <thead>
            <tr>
                <th>Name</th>
                <th>Symbol</th>
                <th>Price USD</th>
                <th>Price BTC</th>
                <th>available_supply</th>
                <th>max_supply</th>
                {{--<th class="width-50">percent_change_7d</th>--}}
                <th>last_updated</th>
                {{--<th class="width-50"></th>--}}
                {{--<th class="width-50"></th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($coins as $coin)
                <tr>
                    <td><a href="{{route('coin-front', $coin['id'])}}">{{$coin['name']}}</a></td>
                    <td>{{$coin['symbol']}}</td>
                    <td>{{$coin['price_usd']}}</td>
                    <td>{{$coin['price_btc']}}</td>
                    <td>{{$coin['available_supply']}}</td>
                    <td>{{$coin['max_supply']}}</td>
                    {{--<td>{{$coin['percent_change_7d']}}</td>--}}
                    <td><small>{{date('d-m-Y H:i', $coin['last_updated'])}}</small></td>

                    {{--<th class="width-50 text-center"><a href="{{route('item-edit', $item->id)}}"><i class="fa fa-pencil-square-o"></i></a></th>--}}
                    {{--<th class="width-50 text-center"><a onclick="return window.confirm('Do you really want to delete?');" href="{{route('item-delete', $item->id)}}"><i class="fa fa-trash-o"></i></a></th>--}}
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
