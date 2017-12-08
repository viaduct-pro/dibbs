<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Image;
use Request;
use Storage;

class IcoItems extends Model {

    protected $table = 'ico_items';

    public function comments() {
        return $this->hasMany('App\Models\Comment', 'item_id', 'id');
    }

    public function coins() {
        return $this->belongsToMany('App\Models\Coin', 'pivot_items_coins', 'item_id', 'coin_id');
    }

    public function rating() {
        return $this->hasOne('risul\LaravelLikeComment\Models\TotalLike', 'item_id', 'id');
    }

    public function photos() {
        return $this->morphMany('App\Models\Photo', 'imageable');
    }
    public function photo() {
        return $this->morphOne('App\Models\Photo', 'imageable')->where('type', '=', 'photo');
    }

    public function likes()
    {
        if($this->rating)
        {
            return $this->rating->total_like - $this->rating->total_dislike;
        };
    }

    public static function save_data($id, $data) {
        $item = IcoItems::findOrNew($id);
        $item->name = array_get($data, 'name');
        $item->description = array_get($data, 'description');
        $item->slug = array_get($data, 'slug');
        $item->links = array_get($data, 'links');
        $item->user_id = \Auth::id();

        $item->save();
        $coin_name = array_get($data, 'coins');
        $coin = Coin::where(['value' => $coin_name])->orWhere(['name' => $coin_name])->first();
//        if (!$coin) {
//            $coin = new Coin;
//            $coin->name = $coin_name;
//            $coin->value = $coin_name;
//            $coin->symbol = $coin_name;
//            $coin->type = 'custom';
//            $coin->save();
//        }
//        foreach(array_get($data, 'coins', []) as $coin) {
        if($coin){
            $item->coins()->attach($coin->id);

        }
//        }

        return $item->id;

    }

    public function delete() {
        $this->coins()->detach();
        $this->photo()->delete();
        return parent::delete();
    }

    public static function upload_image($request, $id) {
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $img = Image::make($image);
            $img->resize(2000, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            if(!Storage::exists('/items/item/' . $id . '/')) {
                Storage::makeDirectory('/items/item/' . $id . '/');
            }
            $img->save(storage_path('app') . '/items/item/' . $id . '/' . md5($image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension(), 100);
            $company = IcoItems::find($id);
            $company->photo()->delete();
            $photo = Photo::create([
                'name' => md5($image->getClientOriginalName()). '.' . $image->getClientOriginalExtension(),
                'original_name' => $image->getClientOriginalName(),
                'path' => '/items/item/' . $id . '/',
                'meta_alt' => $image->getClientOriginalName(),
                'meta_title' => $image->getClientOriginalName(),
                'type' => 'photo'
            ]);
            $company->photo()->save($photo);
            return $photo;
        }
        return false;
    }
}