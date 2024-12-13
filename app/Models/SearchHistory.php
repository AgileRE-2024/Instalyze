<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    protected $fillable = ['user_id', 'username'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}

