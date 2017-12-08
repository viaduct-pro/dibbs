<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemLike extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_likes';

    /**
	 * Fillable array
     */
    protected $fillable = ['user_id', 'item_id', 'vote'];
}
