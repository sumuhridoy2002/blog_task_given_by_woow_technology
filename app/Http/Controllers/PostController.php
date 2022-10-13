<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $MODULE_VIEW = 'posts.';

    public function create()
    {
        return view($this->MODULE_VIEW . 'create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'title' => 'required|min:5|max:100',
            'body'  => 'required'
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'title'   => $r->title,
            'body'    => $r->body
        ]);
        return redirect('/')->with('success', 'Post created successfully !');
    }

    public function details(Post $post)
    {
        return view($this->MODULE_VIEW . 'details', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted successfully !');
    }

    public function updateStatus(Post $post)
    {
        $post->update([
            'status' => $post->status == 'Active' ? 'Inactive' : 'Active'
        ]);
        return redirect()->back()->with('success', 'Post updated successfully !');
    }

    public function edit(Post $post)
    {
        return view($this->MODULE_VIEW . 'edit', compact('post'));
    }

    public function update(Request $r, Post $post)
    {
        $r->validate([
            'title' => 'required|min:5|max:100',
            'body'  => 'required'
        ]);

        $post->update([
            'title'   => $r->title,
            'body'    => $r->body
        ]);
        return redirect('/dashboard')->with('success', 'Post updated successfully !');
    }
}
