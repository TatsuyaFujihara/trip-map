<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Trip;
use App\Tripimage;
use App\Favorite;


class RankController extends Controller
{
    // ランキングコントローラーで運用
    public function rank(Request $request) {
        $ranking = Favorite::selectRaw('trip_id, COUNT("trip_id") as rank')->groupBy('trip_id')->orderBy('rank', 'DESC')->get();
        foreach ($ranking as $rank) {
            $trip = Trip::find($rank->trip_id);
            $rank->trip = $trip;
            $images = Tripimage::where('trip_id', '=', $rank->trip_id)->get();
            $rank->images = $images;
            $liked = Favorite::where('trip_id', '=', $rank->trip_id)
                ->where('user_id', '=', Auth::id())->first();
            $rank->liked = $liked;
        }
        return view('trip/rank', [
            'ranking' => $ranking,
        ]);
    }

    
}