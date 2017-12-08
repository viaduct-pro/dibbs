<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Image;
use Request;
use Storage;

class User extends Authenticatable
{

//    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function photos() {
        return $this->morphMany('App\Models\Photo', 'imageable');
    }
    public function photo() {
        return $this->morphOne('App\Models\Photo', 'imageable')->where('type', '=', 'photo');
    }

    public static function boot() {
    }

    public function posts() {
        return $this->hasMany('App\Models\IcoItems', 'user_id', 'id');
    }

    public static function getAuthor($id)
    {
        $user = self::find($id);
        return [
            'id'     => $user->id,
            'name'   => $user->name,
            'email'  => $user->email,
            'url'    => '',  // Optional
            'avatar' => 'gravatar',  // Default avatar
            'admin'  => $user->role === 'admin', // bool
        ];
    }

    public function save(array $options = [])
    {
        if(!$this->role)
        {
            $this->role = 'user';
        }
        return parent::save($options);
    }

    public static function save_data($id, $data) {
        $item = User::findOrNew($id);
        $item->name = array_get($data, 'name');
        $item->role = array_get($data, 'role');
        $item->save();

        return $item->id;
    }

    public function delete() {
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
            if(!Storage::exists('/users/user/' . $id . '/')) {
                Storage::makeDirectory('/users/user/' . $id . '/');
            }
            $img->save(storage_path('app') . '/users/user/' . $id . '/' . md5($image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension(), 100);
            $company = User::find($id);
            $company->photo()->delete();
            $photo = Photo::create([
                'name' => md5($image->getClientOriginalName()). '.' . $image->getClientOriginalExtension(),
                'original_name' => $image->getClientOriginalName(),
                'path' => '/users/user/' . $id . '/',
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
