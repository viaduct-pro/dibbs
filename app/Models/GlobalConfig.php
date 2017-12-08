<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Image;
use Request;
use Storage;

class GlobalConfig extends Model {

    protected $table = 'global_config';


    public static function save_data($id, $data) {
        $item = GlobalConfig::findOrNew($id);
//        $item->name = array_get($data, 'name');
        $item->value = array_get($data, 'value');
        $item->description = array_get($data, 'description');

        $item->save();

        return $item->id;

    }

    public function delete() {
        return parent::delete();
    }
}