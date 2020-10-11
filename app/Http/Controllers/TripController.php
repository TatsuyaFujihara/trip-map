<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Trip;
use App\Tripimage;
use App\Favorite;
use Storage;
use Carbon\Carbon;


class TripController extends Controller
{
// ホーム画面
    // TripMapのホーム画面を表示
    public function home() {
        return view('trip/home');
    }

// ジャンル絞り込み画面
    // 絞り込み画面を表示
    public function genre(Request $request) {
        $query = Trip::query();
        $keyword = $request->input('keyword');
        if ($keyword) {
            $query->where('content', 'like', '%' . $keyword . '%');
        }
        
        // [キーワード] and [ジャンル1 or ジャンル2]
        $genres = $request->input('genre');
        if ($genres) {
            $query->where(function($query) use ($genres) {
                foreach($genres as $genre) {
                    $query->orWhere('genres', '=', $genre);
                }
            });
        }

        // [キーワード] and [ジャンル1 or ジャンル2] and [local]
        $locals = $request->input('local');
        if ($locals) {
            $query->where(function($query) use ($locals) {
                foreach($locals as $local) {
                    $query->orWhere('locals', '=', $local);
                }
            });
        }

        // 画像の読み込み
        $trips = $query->get();

        foreach($trips as $trip) {
            // 画像情報
            $images = Tripimage::where('trip_id', '=', $trip->id)->get();
            $trip->images = $images;

            // お気にい入り情報
            $liked = Favorite::where('trip_id', '=', $trip->id)
                ->where('user_id', '=', Auth::id())->first();
            $trip->liked = $liked;
            
        }

        // ｛genre.blade.phpページを表示する}と{genreメソッドで使用した変数をgenre.blade.phpへ引き渡す}処理
        return view('/trip/genre', [
            'trips' => $trips,
            'keyword' => $keyword,
            'genres' => $genres ? $genres : [],
            'locals' => $locals ? $locals : []
        ]); 
    }

    // お気に入り機能実装
    public function like(Request $request) {
        $liked = Favorite::where('trip_id', '=', $request->trip_id)
            ->where('user_id', '=', Auth::id())->first();
        if ($liked == null) {
            $favorite = Favorite::create([
                'user_id' => Auth::id(),
                'trip_id' => $request->trip_id,
            ]);
        } else {
            $liked->delete();
        }
                
                
        $is_liked = $liked == null;
        return response()->json([
            'is_liked' => $is_liked,
         ]);
    }

 // 今週のみんなの投稿
    public function weekly(Request $request) {
        $query = Trip::query();
        $dt = new Carbon();
        $dt->subDay(7);
        $query->where('created_at', '>=', $dt);
        $trips = $query->get();

        foreach($trips as $trip) {
            // 画像情報
            $images = Tripimage::where('trip_id', '=', $trip->id)->get();
            $trip->images = $images;

            // お気にい入り情報
            $liked = Favorite::where('trip_id', '=', $trip->id)
                ->where('user_id', '=', Auth::id())->first();
            $trip->liked = $liked;
            
        }

        return view('trip/weekly', [
            'trips' => $trips,
        ]);
    }

// 〜新規投稿〜
    // 新規投稿画面を表示
    public function post() {
        return view('trip/post');
    }

    // 新規投稿画面で入力された情報を入手・入力された情報に過不足が無いかを確認
    public function store(Request $request) {
        $validatedData = $request->validate([
            // 'user_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'genres' => 'required',
            'locals' => 'required',
            'cost' => 'required',
        ]);
    // 入力された情報をTripモデル（緑字）を介して、Tripsデータベースとやりとり
        $trip = Trip::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'genres' => $request->genres,
            'locals' => $request->locals,
            'cost' => $request->cost,
        ]);
        // $file = $request->file('image')->store('trip_images');
        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('tripimagebox', $image, 'public');
        Tripimage::create([
            'trip_id' => $trip->id,
            'name' => $path,
        ]);
    // 問題なく投稿内容をデータベースにやりとりが実行されたら"/post"へページジャンプする
        return redirect('/trip/post');
    }

// 〜マイページ〜
    // お気に入り一覧//
    public function mypage() {
        $myfavorite = Favorite::where('user_id', '=', Auth::id())->take(4)->get();
        foreach ($myfavorite as $favo) {
            $trip = Trip::find($favo->trip_id);
            $favo->trip = $trip;
            $images = Tripimage::where('trip_id', '=', $favo->trip_id)->get();
            $favo->images = $images;
            $liked = Favorite::where('trip_id', '=', $favo->trip_id)
                ->where('user_id', '=', Auth::id())->first();
            $favo->liked = $liked;
        }

         // 過去の投稿表示 //
        $trips = Trip::take(4)->get();
        foreach($trips as $trip) {
            $images = Tripimage::where('trip_id', '=', $trip->id)->take(1)->get();
            $trip->images = $images;
        }

        $map_db = Trip::select('locals')->where('user_id', '=', Auth::id())->groupBy('locals')->get();
        $map = [];
        foreach ($map_db as $m) {
            array_push($map, $m->locals);
        }
        // dd($map);

        return view('trip/mypage' ,[
            'trips' => $trips,
            'myfavorite' => $myfavorite,
            'map' => $map
            ]);
    }

// 自身のお気に入り一覧全表示
    public function myfavorite() {
        $myfavorite = Favorite::where('user_id', '=', Auth::id())->get();
        foreach ($myfavorite as $favo) {
            $trip = Trip::find($favo->trip_id);
            $favo->trip = $trip;
            $images = Tripimage::where('trip_id', '=', $favo->trip_id)->get();
            $favo->images = $images;
            $liked = Favorite::where('trip_id', '=', $favo->trip_id)
                ->where('user_id', '=', Auth::id())->first();
            $favo->liked = $liked;
        }
        return view('trip/myfavorite' ,[
            'myfavorite' => $myfavorite
            ]);
    }

// 過去の投稿全表示画面
    public function mypost() {
        $trips = Trip::get();
        foreach($trips as $trip) {
            $images = Tripimage::where('trip_id', '=', $trip->id)->take(1)->get();
            $trip->images = $images;
        }
        return view('trip/mypost' ,[
            'trips' => $trips,
            ]);
    }

}