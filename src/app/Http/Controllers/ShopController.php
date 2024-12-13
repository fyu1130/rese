<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        return view('shop_all', ['shops' => $shops, 'area' => 'all', 'category' => 'all', 'keyword' => '',]);
    }
    public function detail($shop_id){
        $last_id = Shop::latest('id')->first();
        $shop = Shop::find($shop_id);
        return view('shop_detail', ['shop' => $shop,'last_id'=>$last_id->id]);
    }
}
