<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function home() {
        return view('trip/home');
    }
}
