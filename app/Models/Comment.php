<?php namespace App\Models;

use risul\LaravelLikeComment\Models\Comment as CommentUse;
use Image;
use Request;

class Comment extends CommentUse {

    public function ratings() {
        return $this->hasMany('App\Models\Rating', 'com_id', 'id');
    }

    public function item() {
        return $this->hasOne('App\Models\IcoItems', 'id', 'item_id');
    }

    public function author() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}