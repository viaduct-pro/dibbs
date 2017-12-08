<?php namespace App\Http\Controllers\Admin;
	
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminItemPublishRequest;
use App\Http\Requests\AdminItemRequest;
use App\Http\Requests\AdminUploadImageRequest;
use App\Models\IcoItems;
use Request;
use Session;

class ItemController extends Controller {

	/*==================ICO-ITEMS===================*/


	public function getItems() {
		return view('admin.items', [
			'items' => IcoItems::all()
		]);
	}

    public function getItemEdit($id = 0) {
        $item = IcoItems::findOrNew($id);

        $photo = [];

        $gallery = [
            'initialPreview' => [],
            'initialPreviewConfig' => []
        ];

        if (!$id) {
            $title = 'Creating new ico-item';
        } else {
            $title = 'Editing ' . $item->name;

//            foreach ($item->gallery as $photo) {
//                $gallery['initialPreview'][] = view('includes.admin_gallery_preview', ['photo' => $photo])->render();
//                $gallery['initialPreviewConfig'][] = [
//                    'caption' => $photo->original_name,
//                    'url' => route('photo-delete', $photo->id),
//                    'key' => $photo->id,
//                ];
//                $gallery['initialPreviewThumbTags'][] = [
//                    'meta_title' => $photo->meta_title,
//                    'meta_alt' => $photo->meta_alt
//                ];
//            }

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
        return view('admin.item', [
            'title' => $title,
            'item' => $item,
            'photo' => json_encode($photo),
//            'gallery' => json_encode($gallery)
        ]);

    }

    public function getItemSave(AdminItemRequest $request, $id = 0) {
        $id = IcoItems::save_data($id, $request);
        Session::push('messages', 'Updated!');
        return redirect()->route('item-edit', ['id' => $id]);
    }

    public function getItemPublish($id = 0) {
        $item = IcoItems::where(['id' => $id])->first();
        $item->published = 1;
        $item->save();
        Session::push('messages', 'Published!');
        return redirect()->route('items');
    }

    public function getItemUnpublish($id = 0) {
        $item = IcoItems::where(['id' => $id])->first();
        $item->published = null;
        $item->save();
        Session::push('messages', 'Unpublished!');
        return redirect()->route('items');
    }

    public function deleteItem($id) {
        IcoItems::find($id)->delete();
        Session::push('messages', 'Deleted!');
        return redirect()->route('items');
    }

    public function uploadItemImage(AdminUploadImageRequest $request, $id) {
        if(Request::ajax()) {
            $photo = IcoItems::upload_image($request, $id);
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
