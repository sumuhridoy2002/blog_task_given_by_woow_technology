<?php

namespace App\Http\Controllers;

use App\Replay;
use Illuminate\Http\Request;

class ReplayController extends Controller
{
    public function store(Request $r)
    {
        $r->validate([
            'replay' => 'required'
        ]);

        Replay::create([
            'user_id' => auth()->id(),
            'comment_id' => $r->comment_id,
            'replay' => $r->replay
        ]);
        return redirect()->back();
    }

    public function destroy(Replay $replay)
    {
        $replay->delete();
        return redirect()->back()->with('success', 'Replay deleted successfully !');
    }
}
