<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserve;
use App\Models\Like;
use App\Models\Shop;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // これからの予約
        $upcomingReserves = Reserve::where('user_id', $user->id)->whereRaw("CONCAT(date, ' ', time) >= ?", [now()])->with('shop')->get();

        // レビュー可能な過去の予約
        $pastReserves = Reserve::where('user_id', $user->id)->whereRaw("CONCAT(date, ' ', time) < ?", [now()])->with('shop')->get();

        $likes = Like::where('user_id', Auth::id());
        $likedShops = Shop::whereIn('id', Like::where('user_id',$user->id)->pluck('shop_id'))->get();

        return view('my_page', compact('user', 'upcomingReserves', 'pastReserves', 'likedShops'));
    }
}
