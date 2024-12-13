<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HashtagSearchHistory extends Model
{
    protected $fillable = ['user_id', 'hashtag'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}

