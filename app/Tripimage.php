<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tripimage extends Model
{
    protected $fillable = [
        'trip_id', 'name',
    ];
}
