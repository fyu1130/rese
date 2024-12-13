<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $area = $request->input('area', 'all');
        $category = $request->input('category', 'all');
        $keyword = $request->input('keyword', '');

        $query = Shop::query();

        if ($area !== 'all') {
            $query->where('area', $area);
        }
        if ($category !== 'all') {
            $query->where('category', $category);
        }
        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword) {
                $query->where('shop_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('detail', 'LIKE', "%{$keyword}%");
            });
        }

        $shops = $query->get();
        return view('shop_all', compact('shops', 'area', 'category', 'keyword'));
    }
}