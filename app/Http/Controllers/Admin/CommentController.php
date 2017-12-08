<?php namespace App\Http\Controllers\Admin;
	
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminConfigRequest;
use App\Http\Requests\AdminItemRequest;
use App\Models\Comment;
use App\Models\GlobalConfig;
use App\Models\IcoItems;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Config;
use Request;

class CommentController extends Controller {


	public function getComments() {
		return view('admin.comments', [
			'items' => Comment::all()
		]);
	}

    public function getCommentEdit($id = 0) {
        $item = Comment::findOrNew($id);

        $photo = [];

        $gallery = [
            'initialPreview' => [],
            'initialPreviewConfig' => []
        ];

        if (!$id) {
            $title = 'Creating new ico-item';
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

    public function getCommentSave(AdminConfigRequest $request, $id = 0) {
        $id = Comment::save_data($id, $request);
        Session::push('messages', 'Updated!');
        return redirect()->route('config-edit', ['id' => $id]);
    }

    public function deleteComment($id) {
        Comment::find($id)->delete();
        Session::push('messages', 'Deleted!');
        return redirect()->route('comments');
    }
}
