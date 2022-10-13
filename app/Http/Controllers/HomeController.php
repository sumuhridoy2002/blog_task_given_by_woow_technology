<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(in_array(auth()->user()->role, ['Admin', 'Author'])){
            $sql = Post::latest();

            if(auth()->user()->role == 'Author'){
                $sql->whereUserId(auth()->id());
            }

            $posts = $sql->paginate(2);
            return view('dashboard', compact('posts'));
        }
        else return redirect('/');
    }
}
