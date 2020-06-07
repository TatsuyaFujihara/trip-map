@extends('layouts.app')

@section('content')
{{-- みんなの投稿一覧 --}}
<h3 class="ml-3 mb-3">みんなの投稿</h3>
<div class="row">
    <div class="col-md-4">
      <img src="{{asset('img/color.jpg')}}" alt="img" class="img-fulied">
    </div>
    <div class="col-md-4  img-hidden">
      <img src="image/d.jpg" alt="img" class="img-fulied">
    </div>
    <div class="col-md-4  img-hidden">
      <img src="image/d.jpg" alt="img" class="img-fulied">
    </div>
  </div>

{{-- ランキング --}}
<h3  class="ml-3 mb-3">ランキング</h3>

@endsection