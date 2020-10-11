@extends('layouts.app')

@section('content')

{{-- スポット・ジャンルから絞る --}}
<div class="title-box">
  <h3 class="ml-3 mb-3">スポット・ジャンルから絞る</h3>
  <a href="/trip/genre" class="Everyone">スポット・ジャンルから絞る></a>
</div>
  <img class="genre-img mb-5" src="{{asset('img/genre.jpg')}}" alt="">

{{-- みんなの投稿一覧 --}}
<div class="title-box">
  <h3 class="ml-3 mb-3">みんなの投稿</h3>
  <a href="/trip/weekly" class="Everyone">みんなの投稿を見る></a>
</div>
<ul class="square-row-img mb-5">
  <li><img src="{{asset('img/trip.jpeg')}}" alt=""></li>
  <li><img src="{{asset('img/city.jpg')}}" alt=""></li>
  <li><img src="{{asset('img/color.jpg')}}" alt=""></li>
  <li><img src="{{asset('img/trip.jpeg')}}" alt=""></li>
  <li><img src="{{asset('img/city.jpg')}}" alt=""></li>
  <li><img src="{{asset('img/color.jpg')}}" alt=""></li>
  <li><img src="{{asset('img/trip.jpeg')}}" alt=""></li>
  <li><img src="{{asset('img/city.jpg')}}" alt=""></li>
</ul>

    {{-- ランキング --}}
  <div class="title-box">
    <h3 class="ml-3 mb-3">ランキング</h3>
    <a href="/trip/rank" class="Everyone">ランキングを見る></a>
  </div>
  <ul class="square-row-img">
    <li><img src="{{asset('img/trip.jpeg')}}" alt=""></li>
    <li><img src="{{asset('img/city.jpg')}}" alt=""></li>
    <li><img src="{{asset('img/color.jpg')}}" alt=""></li>
    <li><img src="{{asset('img/trip.jpeg')}}" alt=""></li>
    <li><img src="{{asset('img/city.jpg')}}" alt=""></li>
    <li><img src="{{asset('img/color.jpg')}}" alt=""></li>
    <li><img src="{{asset('img/trip.jpeg')}}" alt=""></li>
    <li><img src="{{asset('img/city.jpg')}}" alt=""></li>
  </ul>

@endsection