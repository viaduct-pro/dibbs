<?php namespace App\Http\Controllers\Admin;
	
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminConfigRequest;
use App\Http\Requests\AdminItemRequest;
use App\Models\GlobalConfig;
use App\Models\IcoItems;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Config;
use Request;

class ConfigController extends Controller {

	/*==================ICO-ITEMS===================*/


	public function getItems() {
		return view('admin.configs', [
			'items' => GlobalConfig::all()
		]);
	}

    public function getItemEdit($id = 0) {
        $item = GlobalConfig::findOrNew($id);

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
        return view('admin.config', [
            'title' => $title,
            'item' => $item,
            'photo' => json_encode($photo),
//            'gallery' => json_encode($gallery)
        ]);

    }

    public function getItemSave(AdminConfigRequest $request, $id = 0) {
        $id = GlobalConfig::save_data($id, $request);
        Session::push('messages', 'Updated!');
        return redirect()->route('config-edit', ['id' => $id]);
    }

    public function deleteItem($id) {
        Agent::find($id)->delete();
        Session::push('messages', 'Deleted!');
        return redirect()->route('configs');
    }
}
