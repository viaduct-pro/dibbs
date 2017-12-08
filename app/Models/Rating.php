<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Image;
use Request;

class Rating extends Model {

    protected $table = 'rating';

    protected $fillable = ['user_id', 'comment_id', 'value'];

    public function comment() {
        return $this->hasOne('App\Models\Comment', 'id', 'comment_id');
    }
}