<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\IcoItems;
use Illuminate\Http\Request;
use View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = IcoItems::where(['published' => 1])->with('rating')->get();
        $sort = [];
        foreach ($items as $key=>$item){
            $sort[$key] = $item;
            $sort[$key]['likes'] = $item->likes();
        }
        usort($sort, function ($a, $b)
        {
            if ($a['likes'] == $b['likes']) {
                return 0;
            }
            return ($a['likes'] > $b['likes']) ? -1 : 1;
        });
        return view('site.home', [
            'items' => $sort,
        ]);
    }




    public function getCoins() {

        $res = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/'), true);
        return view('site.coins', [
            'coins' => $res
        ]);
    }

    public function ICOCheck() {
        $res = json_decode(file_get_contents('https://api.icowatchlist.com/public/v1/live/'), true);
        $icos = $res['ico']['live'];
        foreach ($icos as $ico) {
            $coin = Coin::where(['name' => $ico['name']])->first();
            if (!$coin) {
                $item = new IcoItems;
                $item->name = $ico['name'];
                $item->description = $ico['description'];
                $item->slug = strtolower($ico['name']);
                $item->published = 1;
                $item->save();
                $coin = new Coin;
                $coin->name = $ico['name'];
                $coin->value = $ico['name'];
                $coin->symbol = $ico['name'];
                $coin->type = 'ico_watch';
                $coin->save();
                $item->coins()->attach($coin->id);
                echo 1;
                dump($item->name);
            }
        }
    }

    public function getCoinAjax($id)
    {
        $coin = Coin::where(['value' => $id])->first();
        if ($coin && $coin->type == 'parse') {
            $res = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/'.$id), true);
            $html = View::make('includes.coin_ajax', ['coin' => $res])->render();
        } else {
            $html = "This currency is created custom by user and not available on the exchange!";
        }

        return $html;
    }

    public function parseCoins() {
        $coins = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/?limit=10000'), true);
        foreach ($coins as $coin) {
            $coin_is = Coin::where(['value' => $coin['id']])->first();
            if(!$coin_is)
            {
                $save_coin = new Coin;
                $save_coin->name = $coin['name'];
                $save_coin->value = $coin['id'];
                $save_coin->symbol = $coin['symbol'];
                $save_coin->rank = $coin['rank'];
                $save_coin->price_usd = $coin['price_usd'];
                $save_coin->price_btc = $coin['price_btc'];
                $save_coin->volume_usd_24h = $coin['24h_volume_usd'];
                $save_coin->market_cap_usd = $coin['market_cap_usd'];
                $save_coin->available_supply = $coin['available_supply'];
                $save_coin->total_supply = $coin['total_supply'];
                $save_coin->max_supply = $coin['max_supply'];
                $save_coin->percent_change_1h = $coin['percent_change_1h'];
                $save_coin->percent_change_24h = $coin['percent_change_24h'];
                $save_coin->percent_change_7d = $coin['percent_change_7d'];
                $save_coin->last_updated = $coin['last_updated'];
                $save_coin->type = 'parse';
                $save_coin->save();
                echo 1;
                dump($save_coin->symbol);
            } else {
                $coin_is->name = $coin['name'];
                $coin_is->value = $coin['id'];
                $coin_is->symbol = $coin['symbol'];
                $coin_is->rank = $coin['rank'];
                $coin_is->price_usd = $coin['price_usd'];
                $coin_is->price_btc = $coin['price_btc'];
                $coin_is->volume_usd_24h = $coin['24h_volume_usd'];
                $coin_is->market_cap_usd = $coin['market_cap_usd'];
                $coin_is->available_supply = $coin['available_supply'];
                $coin_is->total_supply = $coin['total_supply'];
                $coin_is->max_supply = $coin['max_supply'];
                $coin_is->percent_change_1h = $coin['percent_change_1h'];
                $coin_is->percent_change_24h = $coin['percent_change_24h'];
                $coin_is->percent_change_7d = $coin['percent_change_7d'];
                $coin_is->last_updated = $coin['last_updated'];
                $coin_is->type = 'parse';
                $coin_is->save();
                echo 2;
                dump($coin_is->symbol);
            }

        }
    }
}
