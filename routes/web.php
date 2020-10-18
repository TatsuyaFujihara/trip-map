<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Trip Mapのホーム画面
Route::get('/trip', 'TripController@home');

// Trip Mapの絞り込み画面
Route::get('/trip/genre', 'TripController@genre');

// Trip Mapの最近の投稿画面
Route::get('/trip/weekly', 'TripController@weekly');

// Trip Mapのランキング画面
Route::get('/trip/rank', 'RankController@rank');

// ログイン状況確認
Route::group(['middleware' =>['auth']], function (){
  
// Trip Mapのマイページ
Route::get('/trip/mypage', 'TripController@mypage');
Route::get('/trip/myfavorite', 'TripController@myfavorite');

// Goneマップの詳細ページ
Route::get('/trip/mypage/gone', 'TripController@gone');

// Trip Mapの新規投稿画面
Route::get('/trip/post', 'TripController@post');
Route::post('/post/create', 'TripController@store');

// いいね機能
Route::post('/trip/like', 'TripController@like');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
