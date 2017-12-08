<?php

namespace App\Console\Commands;

use App\Models\IcoItems;
use Illuminate\Console\Command;
use App\Models\Coin;

class CronController extends Command
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    protected $signature = 'coins:start';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle() {
        $coins = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/?limit=10000'), true);
        foreach ($coins as $coin) {
            $coin_is = Coin::where(['symbol' => $coin['symbol']])->get();
            foreach ($coin_is as $coin_i){
                if(!$coin_i)
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
                } else {
                    if ($coin->type == 'ico_watch'){
                        $coin_i->name = $coin['name'];
                        $coin_i->value = $coin['id'];
                        $coin_i->symbol = $coin['symbol'];
                        $coin_i->rank = $coin['rank'];
                        $coin_i->price_usd = $coin['price_usd'];
                        $coin_i->price_btc = $coin['price_btc'];
                        $coin_i->volume_usd_24h = $coin['24h_volume_usd'];
                        $coin_i->market_cap_usd = $coin['market_cap_usd'];
                        $coin_i->available_supply = $coin['available_supply'];
                        $coin_i->total_supply = $coin['total_supply'];
                        $coin_i->max_supply = $coin['max_supply'];
                        $coin_i->percent_change_1h = $coin['percent_change_1h'];
                        $coin_i->percent_change_24h = $coin['percent_change_24h'];
                        $coin_i->percent_change_7d = $coin['percent_change_7d'];
                        $coin_i->last_updated = $coin['last_updated'];
                        $coin_i->type = 'ico_checked';
                        $coin_i->save();
                    } else {
                        $coin_i->name = $coin['name'];
                        $coin_i->value = $coin['id'];
                        $coin_i->symbol = $coin['symbol'];
                        $coin_i->rank = $coin['rank'];
                        $coin_i->price_usd = $coin['price_usd'];
                        $coin_i->price_btc = $coin['price_btc'];
                        $coin_i->volume_usd_24h = $coin['24h_volume_usd'];
                        $coin_i->market_cap_usd = $coin['market_cap_usd'];
                        $coin_i->available_supply = $coin['available_supply'];
                        $coin_i->total_supply = $coin['total_supply'];
                        $coin_i->max_supply = $coin['max_supply'];
                        $coin_i->percent_change_1h = $coin['percent_change_1h'];
                        $coin_i->percent_change_24h = $coin['percent_change_24h'];
                        $coin_i->percent_change_7d = $coin['percent_change_7d'];
                        $coin_i->last_updated = $coin['last_updated'];
                        $coin_i->type = 'parse';
                        $coin_i->save();
                    }
                }
            }

        }
    }
}
