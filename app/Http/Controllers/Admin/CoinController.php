<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCoinRequest;
use App\Http\Requests\AdminConfigRequest;
use App\Models\Coin;
use Request;
use Session;

class CoinController extends Controller
{
    public function getCoins() {
        return view('admin.coins', [
            'coins' => Coin::all()
        ]);
    }

    public function getCoinEdit($id = 0) {
        $item = Coin::findOrNew($id);

        $photo = [];

        $gallery = [
            'initialPreview' => [],
            'initialPreviewConfig' => []
        ];

        if (!$id) {
            $title = 'Creating new coin';
        } else {
            $title = 'Editing ' . $item->name;

            $image = $item->photo;

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
        }
        return view('admin.config', [
            'title' => $title,
            'item' => $item,
            'photo' => json_encode($photo),
        ]);

    }

    public function getCommentSave(AdminCoinRequest $request, $id = 0) {
        $id = Coin::save_data($id, $request);
        Session::push('messages', 'Updated!');
        return redirect()->route('coin-edit', ['id' => $id]);
    }

    public function deleteComment($id) {
        Comment::find($id)->delete();
        Session::push('messages', 'Deleted!');
        return redirect()->route('coins');
    }
}
