<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $r, $post_id)
    {
        $r->validate([
            'comment' => 'required'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post_id,
            'comment' => $r->comment
        ]);
        return redirect()->back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully !');
    }
}
