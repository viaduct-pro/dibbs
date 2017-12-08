<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Photo;
use Request;

class PhotoController extends Controller {

	public function deletePhoto($id) {
		if(Request::ajax()) {
			Photo::find($id)->delete();
		}
	}

}
