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

<script>
  $(document).ready(function() {
    $('.tooltiped').tooltipster({
      theme: 'tooltipster-shadow',
    });
  });



//  $(document).ready(function() {
//    $('.coin-label').tooltipster({
//      theme: 'tooltipster-shadow',
//      content: 'Loading...',
//      contentAsHTML: true,
//      maxWidth: 150,
//      // 'instance' is basically the tooltip. More details in the "Object-oriented Tooltipster" section.
//      functionBefore: function(instance, helper) {
//
//        var $origin = $(helper.origin);
//        val = $origin.attr('data-coin');
//        console.log($origin.attr('data-main'));
//        // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
//        if ($origin.data('loaded') !== true) {
//
//          $.get('/coin-ajax/'+val, function(data) {
//            console.log(data);
//            // call the 'content' method to update the content of our tooltip with the returned data.
//            // note: this content update will trigger an update animation (see the updateAnimation option)
//            instance.content(data);
//
//            // to remember that the data has been loaded
//            $origin.data('loaded', true);
//          });
//        }
//      }
//
//    });
//  });



  $('.laravelLike-icon').on('click', function(){
    if($(this).hasClass('disabled'))
      return false;

    var item_id = $(this).data('item-id');
    var vote = $(this).data('vote');

    $.ajax({
      method: "get",
      url: "/laravellikecomment/like/vote",
      data: {item_id: item_id, vote: vote},
      dataType: "json"
    })
      .done(function(msg){
        if(msg.flag == 1){
          if(msg.vote == 1){
            $('#'+item_id+'-like').removeClass('outline');
            $('#'+item_id+'-dislike').addClass('outline');
          }
          else if(msg.vote == -1){
            $('#'+item_id+'-dislike').removeClass('outline');
            $('#'+item_id+'-like').addClass('outline');
          }
          else if(msg.vote == 0){
            $('#'+item_id+'-like').addClass('outline');
            $('#'+item_id+'-dislike').addClass('outline');
          }
          $('#'+item_id+'-total-like').text(msg.totalLike == null ? 0 : msg.totalLike);
          $('#'+item_id+'-total-dislike').text(msg.totalDislike == null ? 0 : msg.totalDislike);
        }
        $("#content").load("/ajax-items");
      })
      .fail(function(msg){
        alert(msg);
      });
  });

  $('.laravelRate-icon').on('click', function(){
    if($(this).hasClass('disabled'))
      return false;

    var item_id = $(this).data('item-id');
    var vote = $(this).data('vote');

    $.ajax({
      method: "get",
      url: "/rating/vote",
      data: {item_id: item_id, vote: vote},
      dataType: "json"
    })
      .done(function(msg){
        if(msg.flag){
          if(msg.vote == 1){
            $('#'+item_id+'-sell').addClass('outline');
            $('#'+item_id+'-hold').addClass('outline');
            $('#'+item_id+'-buy').removeClass('outline');
          }
          else if(msg.vote == 2){
            $('#'+item_id+'-buy').addClass('outline');
            $('#'+item_id+'-sell').addClass('outline');
            $('#'+item_id+'-hold').removeClass('outline');
          }
          else if(msg.vote == 3){
            $('#'+item_id+'-buy').addClass('outline');
            $('#'+item_id+'-hold').addClass('outline');
            $('#'+item_id+'-sell').removeClass('outline');
          }
          var total = (msg.totalBuy == null ? 0 : msg.totalBuy)+(msg.totalHold == null ? 0 : msg.totalHold)+(msg.totalSell == null ? 0 : msg.totalSell);
          if (total == 0){
            total = 1;
          }
          $('#'+item_id+'-total-buy').text(msg.totalBuy == null ? 0+' % ' : msg.totalBuy/total*100+' % ');
          $('#'+item_id+'-total-hold').text(msg.totalHold == null ? 0+' % ' : msg.totalHold/total*100+' % ');
          $('#'+item_id+'-total-sell').text(msg.totalSell == null ? 0+' % ' : msg.totalSell/total*100+' % ');
          /*console.log(msg.totalBuy == 0);
          if (msg.totalBuy == 0) {
            console.log(1);
            $('#'+item_id+'-buy').removeClass('outline');
          }
          if (msg.totalHold == 0) {
            console.log(2);
            $('#'+item_id+'-total-hold').removeClass('outline');
          }
          if (msg.totalSell == 0) {
            console.log(3);
            $('#'+item_id+'-sell').removeClass('outline');
          }*/
        }
        $("#content").load("/ajax-items");
      })
      .fail(function(msg){
        alert(msg);
      });
  });
</script>