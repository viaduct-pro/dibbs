<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Image;
use Request;
use Storage;

class Coin extends Model {

    protected $table = 'coins';


    public static function save_data($id, $data) {
        $item = Coin::findOrNew($id);
        $item->name = array_get($data, 'name');
        $item->value = array_get($data, 'value');

        $item->save();

        return $item->id;

    }
}