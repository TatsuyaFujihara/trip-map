<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    // 配列内の要素を書き込み可能にする
  protected $fillable = ['trip_id','user_id'];

  public function reply()
  {
    return $this->belongsTo(Trip::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
