<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content', 'genres', 'locals', 'cost',
    ];
}
