<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TotalItemLike extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_likes_total';

    /**
	 * Fillable array
     */
    protected $fillable = [];
}
