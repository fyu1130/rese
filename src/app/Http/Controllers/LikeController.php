<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request){
        $like = new Like();
        $like->user_id = Auth::id();
        $like->shop_id = $request->input('shop_id');
        $like->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $like = Like::where('user_id', Auth::id())->where('shop_id', $id);
        if($like){
            $like->delete();
        }
        return redirect()->back();
    }
}
