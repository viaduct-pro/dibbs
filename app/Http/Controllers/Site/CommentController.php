<?php namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Request;
use Auth;

class CommentController extends Controller
{
    public function getComment($id) {
        $comment = Comment::where(['id' => $id])->first();

        return view('site.comment', [
            'comment' => $comment
        ]);
    }
}
