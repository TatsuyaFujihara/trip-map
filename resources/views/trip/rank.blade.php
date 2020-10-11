@extends('layouts.app')

@section('content')
<script src="{{ asset('/js/genre.js') }}"></script>

{{-- ランキング画面 --}}
<h3>ランキング</h3>
@foreach ($ranking as $key => $rank)
<div class="card mt-5">
    <div class="card-body">
        <h4 class="text-muted">{{$key+1}}位{{$rank->trip->title}}</h4>
    </div>
    @foreach($rank->images as $image) 
      <img class="post-img mb-3" src="{{Storage::disk('s3')->url($image->name)}}">
    @endforeach
    <div>
        <p class="card-text ml-5">場所 : {{$rank->trip->locals}}</p>
        <p class="card-text ml-5">ジャンル : {{$rank->trip->genres}}</p>
        <p class="card-text ml-5">コスト : {{$rank->trip->cost}}</p>
        <p class="card-text ml-5">{{$rank->trip->content}}</p>
        
        {{-- お気に入り機能 --}}
        @if ($rank->liked == null)
            <button type="button" id="favorite{{$rank->trip->id}}" class="btn btn-outline-danger" onclick="favorite({{$rank->trip->id}})">
                <i class="far fa-heart"></i>
            </button>
        @else 
            <button type="button" id="favorite{{$rank->trip->id}}" class="btn btn-danger" onclick="favorite({{$rank->trip->id}})">
                <i class="far fa-heart"></i>
            </button>
        @endif
       
        
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
    @endforeach
    
    @endsection
    
    {{-- @if ($rank->liked == null)
        <button type="submit" class="btn btn-outline-danger">
            <i class="far fa-heart"></i>
        </button>
    @else 
        <button type="submit" class="btn btn-danger">
            <i class="far fa-heart"></i>
        </button>
    @endif --}}
