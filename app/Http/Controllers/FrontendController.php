<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $posts = Post::whereStatus('Active')->latest()->paginate(2);
        return view('home', compact('posts'));
    }
}
