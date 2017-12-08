<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUploadImageRequest;
use App\Http\Requests\AdminUserRequest;
use App\Models\User;
use Request;
use Session;

class UserController extends Controller {

    public function index() {

        $users = User::all();

        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function getUser($id = 0) {
        $user = User::findOrNew($id);


        if (!$id) {
            $title = 'Creating new user';
        } else {
            $title = 'Editing ' . $user->name;
        }
        $photo = [];

        $image = $user->photo;

        if ($image) {
            $photo = [
                'initialPreview' => [
                    view('includes.admin_gallery_preview', ['photo' => $image])->render()
                ],
                'initialPreviewConfig' => [[
                    'caption' => $image->original_name,
                    'url' => route('photo-delete', $image->id),
                    'key' => $image->id,
                ]],
                'initialPreviewThumbTags' => [[
                    'meta_title' => $image->meta_title,
                    'meta_alt' => $image->meta_alt
                ]]
            ];
        }

        return view('admin.user', [
            'title' => $title,
            'item' => $user,
            'photo' => json_encode($photo),
        ]);
    }

    public function getUserSave(AdminUserRequest $request, $id = 0) {
        $id = User::save_data($id, $request);
        Session::push('messages', 'Updated!');
        return redirect()->route('user-edit', ['id' => $id]);
    }

    public function deleteUser($id) {
        User::find($id)->delete();
        Session::push('messages', 'Deleted!');
        return redirect()->route('users');
    }

    public function uploadUserImage(AdminUploadImageRequest $request, $id) {
        if(Request::ajax()) {
            $photo = User::upload_image($request, $id);
            echo json_encode([
                'initialPreview' => [view('includes.admin_gallery_preview', ['photo' => $photo])->render(),
                ],
                'initialPreviewConfig' => [
                    ['caption' => $photo->original_name, 'url' => route('photo-delete', $photo->id), 'key' => $photo->id],
                ],
                'append' => true
            ]);
        }
        die();
    }

}