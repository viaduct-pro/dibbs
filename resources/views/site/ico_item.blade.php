@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{route('item', $item->slug)}}">{{$item->name}}</a>

                        @if($item->coins)
                            @foreach($item->coins as $coin)
                                <div data-main="{{$coin->value}}" class="btn btn-default coin-label"> {{$coin->symbol}}</div>
                            @endforeach
                        @endif
                        <?php
                        $like_item_id = $item->id;

//                        $ratings = App\Http\Controllers\Site\RatingController::getRatingsViewData($like_item_id);
                        ?>
                        {{--<div class="laravel-rating pull-right">--}}
                            {{--<i id="{{ $like_item_id }}-buy"--}}
                               {{--class="tooltiped icon {{ $ratings[$like_item_id.'ratingDisabled'] }} {{ $ratings[$like_item_id.'buyIconOutlined'] }} laravelRate-icon plus square"--}}
                               {{--data-item-id="{{ $like_item_id }}"--}}
                               {{--data-vote="1"--}}
                               {{--title="Buy!">--}}
                            {{--</i>--}}
                            {{--<span id="{{ $like_item_id }}-total-buy">{{ $ratings[$like_item_id.'total_buy'] }}</span>--}}

                            {{--<i id="{{ $like_item_id }}-hold"--}}
                               {{--class="tooltiped icon {{ $ratings[$like_item_id.'ratingDisabled'] }} {{ $ratings[$like_item_id.'holdIconOutlined'] }} laravelRate-icon bookmark"--}}
                               {{--data-item-id="{{ $like_item_id }}"--}}
                               {{--data-vote="2"--}}
                               {{--title="Hold!"--}}
                            {{-->--}}
                            {{--</i>--}}
                            {{--<span id="{{ $like_item_id }}-total-hold">{{ $ratings[$like_item_id.'total_hold'] }}</span>--}}

                            {{--<i id="{{ $like_item_id }}-sell"--}}
                               {{--class="tooltiped icon {{ $ratings[$like_item_id.'ratingDisabled'] }} {{ $ratings[$like_item_id.'sellIconOutlined'] }} laravelRate-icon minus square"--}}
                               {{--data-item-id="{{ $like_item_id }}"--}}
                               {{--data-vote="3"--}}
                               {{--title="Sell!">--}}
                            {{--</i>--}}
                            {{--<span id="{{ $like_item_id }}-total-sell">{{ $ratings[$like_item_id.'total_sell'] }}</span>--}}

                        {{--</div>--}}
                    </div>
                    {{--@can('update-post', $item)--}}
                    {{--11111--}}
                    {{--<!-- Текущий пользователь может обновить статью -->--}}
                    {{--@else--}}
                    {{--00000--}}
                    {{--<!-- Текущий пользователь не может обновить статью -->--}}
                    {{--@endcan--}}
                    <div class="panel-body">
                        <div class="сol-xs-12 col-md-7 col-lg-7">
                            {{$item->description}}
                        </div>
                        <div class="laravel-info pull-right align-top col-xs-12 col-lg-5 col-md-5 col-sm-5">
                            @foreach($item->coins as $coin)
                                @if($coin->type == 'parse')
                                    <table class="table table-striped table-bordered">
                                        {{--<thead>--}}
                                        {{--<tr>--}}
                                        {{--<th>Name</th>--}}
                                        {{--<th>Price USD</th>--}}
                                        {{--<th>Volume USD</th>--}}
                                        {{--<th>% change,  24h</th>--}}
                                        {{--</tr>--}}
                                        {{--</thead>--}}
                                        <tbody>
                                        {{--{{dump($coin)}}--}}
                                        <tr>
                                            <th>Price USD</th>
                                            <td>{{$coin->price_usd}}</td>
                                        </tr>
                                        <tr>
                                            <th>Volume USD, 24h</th>
                                            <td>{{$coin->volume_usd_24h}}</td>
                                        </tr>
                                        <tr>
                                            <th>% change, 24h</th>
                                            <td>
                                                @if($coin->percent_change_24h && $coin->percent_change_24h >= 0)
                                                    <i class="fa fa-caret-up" aria-hidden="true"></i>
                                                @elseif($coin->percent_change_24h && $coin->percent_change_24h < 0)
                                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                @else

                                                @endif
                                                {{abs($coin->percent_change_24h)}}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @elseif ($coin->type == 'custom')
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>
                                                This coin is custom and not trading!
                                            </th>
                                        </tr>
                                        </thead>

                                    </table>
                                @elseif ($coin->type == 'ico_watch')
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>
                                                This coin is created automaticaly from ICO Watchlist!
                                            </th>
                                        </tr>
                                        </thead>

                                    </table>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="panel-footer">
                        <?php

                        $data = \risul\LaravelLikeComment\Controllers\LikeController::getLikeViewData($like_item_id);
                        ?>
                        <div class="laravel-like">
                            <i id="{{ $like_item_id }}-like"
                               class="tooltiped icon {{ $data[$like_item_id.'likeDisabled'] }} {{ $data[$like_item_id.'likeIconOutlined'] }} laravelLike-icon thumbs up"
                               data-item-id="{{ $like_item_id }}"
                               data-vote="1"
                               title="Thumb up!">
                            </i>
                            <span id="{{ $like_item_id }}-total-like">{{ $data[$like_item_id.'total_like'] }}</span>
                            <i id="{{ $like_item_id }}-dislike"
                               class="tooltiped icon {{ $data[$like_item_id.'likeDisabled'] }} {{ $data[$like_item_id.'dislikeIconOutlined'] }} laravelLike-icon thumbs down"
                               data-item-id="{{ $like_item_id }}"
                               data-vote="-1"
                               title="Thumb dowm!">
                            </i>
                            <span id="{{ $like_item_id }}-total-dislike">{{ $data[$like_item_id.'total_dislike'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                @include('laravelLikeComment::comment', ['comment_item_id' => $item->id])
            </div>
        </div>
    </div>
@endsection