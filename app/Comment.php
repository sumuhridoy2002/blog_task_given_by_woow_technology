<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function replays()
    {
        return $this->hasMany(Replay::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
