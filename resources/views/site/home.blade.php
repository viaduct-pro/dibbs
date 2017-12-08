@extends('layouts.app')

@section('content')
<div class="container col-md-12">
        <div class="col-md-12">
            @if(Auth::guest())
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>You are not logged in!</h4>
                    </div>
                    <div class="panel-body">
                        Login or register to start working!

                    </div>
                </div>
            @else
                <div id="status"></div>
                <div id="form-block">
                    <form id="item-form">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input required name="name" type="text" id="name" data-target="#slug" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea required rows="8" name="description" id="my_editor" class="form-control" placeholder="Enter text"></textarea>
                            <small class="form-text text-muted">Enter the text...</small>
                            <div id="red" style="float: right;">Last: <small id="counter">0</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <input required name="coins" id="coins" type="hidden" class="select-coin" style="width: 100%;">
                            {{--<select class="select-coin" name="coins" id="coins">--}}
                                {{----}}
                            {{--</select>--}}
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<select id="coins" class="select-coin" style="width: 100%;">--}}
                                {{--@foreach(\App\Models\Coin::all() as $coin)--}}
                                    {{--<option value="{{$coin->id}}">{{$coin->symbol}} ({{$coin->name}})</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                            <input type="hidden" name="slug" class="form-control" id="slug" placeholder="Password">
                            <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}">
                        <button style="width: 100%;" type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            @endif
                <div id="content">
                <table class="table table-definition table-responsive" style="font-size: 10px; margin-top: 15px;">
                    <thead>
                    <tr style="background-color: lightgrey; border-top: 2px solid grey!important;">
                        <th style="width: 100px; background-color: lightgrey;">Rating</th>
                        <th style="width: 250px;">Name</th>
                        <th>Platform</th>
                        <th>Total volume</th>
                        <th>Exchanges</th>
                        <th>Symbol</th>
                        <th colspan="2">ICO dates</th>
                        <th>ICO price</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Market Cap</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>
                                    <?php
                                    $like_item_id = $item->id;

                                    $data = \risul\LaravelLikeComment\Controllers\LikeController::getLikeViewData($like_item_id);
                                    ?>
                                    <div class="laravel-like">
                                        <i id="{{ $like_item_id }}-like"
                                           class="tooltiped icon {{ $data[$like_item_id.'likeDisabled'] }} {{ $data[$like_item_id.'likeIconOutlined'] }} laravelLike-icon thumbs up"
                                           data-item-id="{{ $like_item_id }}"
                                           data-vote="1"
                                           title="Vote up!">
                                        </i>
                                        <span id="{{ $like_item_id }}-total-like">{{ $data[$like_item_id.'total_like'] }}</span>
                                        <i id="{{ $like_item_id }}-dislike"
                                           class="tooltiped icon {{ $data[$like_item_id.'likeDisabled'] }} {{ $data[$like_item_id.'dislikeIconOutlined'] }} laravelLike-icon thumbs down"
                                           data-item-id="{{ $like_item_id }}"
                                           data-vote="-1"
                                           title="Vote down!">
                                        </i>
                                        <span id="{{ $like_item_id }}-total-dislike">{{ $data[$like_item_id.'total_dislike'] }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div style="height: 100%;">
                                    <a href="{{route('item', $item->slug)}}">{{$item->name}}</a>
                                    <?php
                                    $like_item_id = $item->id;

                                    $ratings = App\Http\Controllers\Site\RatingController::getRatingsViewData($like_item_id);
                                    $all_count_rating = $ratings[$like_item_id.'total_buy']+$ratings[$like_item_id.'total_hold']+$ratings[$like_item_id.'total_sell'];
                                    if($all_count_rating == 0) {
                                        $all_count_rating = 1;
                                    }
//                                    dump($ratings[$like_item_id.'total_buy']+$ratings[$like_item_id.'total_hold']+$ratings[$like_item_id.'total_sell']);
                                    ?>
                                    <div class="laravel-rating align-bottom"  style="padding-top: 70px;">
                                        <i id="{{ $like_item_id }}-buy"
                                           class="tooltiped icon {{ $ratings[$like_item_id.'ratingDisabled'] }} {{ $ratings[$like_item_id.'buyIconOutlined'] }} laravelRate-icon plus square"
                                           data-item-id="{{ $like_item_id }}"
                                           data-vote="1"
                                           title="Buy!">Buy!
                                        </i>
                                        <span style="padding-top: 15px; position: absolute;" id="{{ $like_item_id }}-total-buy">{{ ($ratings[$like_item_id.'total_buy']/$all_count_rating)*100 }} % </span>

                                        <i id="{{ $like_item_id }}-hold"
                                           class="tooltiped icon {{ $ratings[$like_item_id.'ratingDisabled'] }} {{ $ratings[$like_item_id.'holdIconOutlined'] }} laravelRate-icon bookmark"
                                           data-item-id="{{ $like_item_id }}"
                                           data-vote="2"
                                           title="Hold!">Hold!
                                        </i>
                                        <span style="padding-top: 15px; position: absolute;" id="{{ $like_item_id }}-total-hold">{{ ($ratings[$like_item_id.'total_hold']/$all_count_rating)*100 }} % </span>

                                        <i id="{{ $like_item_id }}-sell"
                                           class="tooltiped icon {{ $ratings[$like_item_id.'ratingDisabled'] }} {{ $ratings[$like_item_id.'sellIconOutlined'] }} laravelRate-icon minus square"
                                           data-item-id="{{ $like_item_id }}"
                                           data-vote="3"
                                           title="Sell!">Sell!
                                        </i>
                                        <span style="padding-top: 15px; position: absolute;" id="{{ $like_item_id }}-total-sell">{{ ($ratings[$like_item_id.'total_sell']/$all_count_rating)*100 }} %</span>

                                    </div>
                                    <div class="a2a_kit a2a_default_style" style="padding-top: 20px;" data-a2a-url="{{route('item', $item->slug)}}" data-a2a-title="{{$item->name}}">
                                        <a class="a2a_button_facebook"></a>
                                        <a class="a2a_button_twitter"></a>
                                        <a class="a2a_button_tumblr"></a>
                                        <a class="a2a_button_reddit"></a>
                                    </div>
                                    </div>
                                    {{--<div class="social-likes" style="padding-top: 15px;">--}}
                                        {{--<div class="facebook" data-url="{{route('item', $item->slug)}}" title="Share link on Facebook">Facebook</div>--}}
                                        {{--<div class="twitter" data-url="{{route('item', $item->slug)}}" title="Share link on Twitter">Twitter</div>--}}
                                        {{--<div class="plusone" data-url="{{route('item', $item->slug)}}" title="Share link on Google+">Google+</div>--}}
                                    {{--</div>--}}
                                </td>
                                <td>
                                    @if($item->coins)
                                        @foreach($item->coins as $coin)
                                            <div data-main="{{$coin->value}}" class="btn btn-default coin-label"> {{$coin->symbol}}</div>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if($item->coins)
                                        @foreach($item->coins as $coin)
                                            {{$coin->total_supply}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    -
                                </td>
                                <td>
                                    @if($item->coins)
                                        @foreach($item->coins as $coin)
                                            {{$coin->symbol}}
                                        @endforeach
                                    @endif
                                </td>
                                <td colspan="2">
                                    @if($item->coins)
                                        @foreach($item->coins as $coin)
                                            {{$coin->start_time ? date('d/M/Y H:i', strtotime($coin->start_time)) : ''}}
                                            <hr>
                                            {{$coin->end_time ? date('d/M/Y H:i', strtotime($coin->end_time)) : ''}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if($item->coins)
                                        @foreach($item->coins as $coin)
                                            {{$coin->price_usd}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if($item->coins)
                                        @foreach($item->coins as $coin)
                                            {{$coin->type}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if($item->coins)
                                        @foreach($item->coins as $coin)
                                            {{$coin->price_btc}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if($item->coins)
                                        @foreach($item->coins as $coin)
                                            {{$coin->volume_usd_24h}}
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
        </div>
</div>
@endsection
