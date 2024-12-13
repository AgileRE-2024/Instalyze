<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadlineSearchHistory extends Model
{
    protected $fillable = ['user_id', 'headline'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}

