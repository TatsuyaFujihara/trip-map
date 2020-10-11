@extends('layouts.app')

@section('content')
<script src="{{ asset('/js/genre.js') }}"></script>

{{-- 画面 --}}
<h3>みんなの投稿</h3>
@foreach ($trips as $trip)
<div class="card mt-5">
    <div class="card-body">
        <h4 class="text-muted">{{$trip->title}}</h4>
    </div>
    @foreach($trip->images as $image) 
    <img class="post-img mb-3" src="{{Storage::disk('s3')->url($image->name)}}">
    @endforeach
    <div>
        <p class="card-text ml-5">場所 : {{$trip->locals}}</p>
        <p class="card-text ml-5">ジャンル : {{$trip->genres}}</p>
        <p class="card-text ml-5">コスト : {{$trip->cost}}</p>
        <p class="card-text ml-5">{{$trip->content}}</p>
        
        {{-- お気に入り機能 --}}
        @if ($trip->liked == null)
            <button type="button" id="favorite{{$trip->id}}" class="btn btn-outline-danger" onclick="favorite({{$trip->id}})">
                <i class="far fa-heart"></i>
            </button>
        @else 
            <button type="button" id="favorite{{$trip->id}}" class="btn btn-danger" onclick="favorite({{$trip->id}})">
                <i class="far fa-heart"></i>
            </button>
        @endif
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
</div>


@endforeach
@endsection