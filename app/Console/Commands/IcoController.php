<?php

namespace App\Console\Commands;

use App\Models\IcoItems;
use Illuminate\Console\Command;
use App\Models\Coin;

class IcoController extends Command
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    protected $signature = 'ico:start';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle() {
        $res = json_decode(file_get_contents('https://api.icowatchlist.com/public/v1/finished/'), true);
        $icos = $res['ico']['finished'];
        foreach ($icos as $ico) {
            $coin = Coin::where(['name' => $ico['name']])->first();
            if (!$coin) {
                $item = new IcoItems;
                $item->name = $ico['name'];
                $item->description = $ico['description'];
                $item->slug = strtolower($ico['name']);
                $item->published = 0;
                $item->save();
                $coin = new Coin;

            }
            $coin->start_time = $ico['start_time'];
            $coin->end_time = $ico['end_time'];
            $coin->name = $ico['name'];
            $coin->value = $ico['name'];
            $coin->symbol = $ico['coin_symbol'];
            $coin->price_usd = $ico['price_usd'];
            $coin->type = 'ico_watch';
            $coin->save();
            $item->coins()->attach($coin->id);
            echo 1;
            dump($item->name);
            dump($coin->value);
        }
    }
}
