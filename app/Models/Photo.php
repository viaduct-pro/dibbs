<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Photo extends Model {

    protected $table = 'photos';

    protected $fillable = ['name', 'original_name', 'path', 'type', 'meta_title', 'meta_alt'];

    public function imageable() {
        return $this->morphTo();
    }

    public function delete() {
        if(Storage::exists($this->path . $this->name)) {
            Storage::delete($this->path . $this->name);
        }
        return parent::delete();
    }
}