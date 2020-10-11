@extends('layouts.app')

@section('content')

{{-- 画面 --}}
<h3>お気に入り一覧</h3>
@foreach ($myfavorite as $favo)
<div class="card mt-5">
    <div class="card-body">
        <h4 class="text-muted">{{$favo->title}}</h4>
    </div>
    @foreach($favo->images as $image) 
    <img class="post-img mb-3" src="{{Storage::disk('s3')->url($image->name)}}">
    @endforeach
    <div>
        <p class="card-text ml-5">場所 : {{$favo->locals}}</p>
        <p class="card-text ml-5">ジャンル : {{$favo->genres}}</p>
        <p class="card-text ml-5">コスト : {{$favo->cost}}</p>
        <p class="card-text ml-5">{{$favo->content}}</p>
        
        {{-- お気に入り機能 --}}
        @if ($favo->liked == null)
            <button type="button" id="favorite{{$favo->id}}" class="btn btn-outline-danger" onclick="favorite({{$favo->id}})">
                <i class="far fa-heart"></i>
            </button>
        @else 
            <button type="button" id="favorite{{$favo->id}}" class="btn btn-danger" onclick="favorite({{$favo->id}})">
                <i class="far fa-heart"></i>
            </button>
        @endif
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
</div>


@endforeach
@endsection