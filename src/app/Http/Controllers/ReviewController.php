<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Shop;
use App\Models\Reserve;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    public function create(Shop $shop){
        return view('reviews-create', compact('shop'));
    }
    public function store(ReviewRequest $request, Shop $shop)
    {
        $validated = $request->validated();
        $reservation = Reserve::where('user_id', auth()->id())
            ->where('shop_id', $shop->id)
            ->whereRaw("CONCAT(date, ' ', time) < ?", [now()])
            ->first();
        if ($reservation) {
            // レビューを作成
            Review::create([
                'user_id' => auth()->id(),
                'shop_id' => $shop->id,
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
            ]);

            // 該当予約を削除
            $reservation->delete();

            return redirect()->route('my_page')->with('status', 'レビューありがとうございました！');
        }

        return redirect()->route('my_page')->with('error', '該当する予約が見つかりませんでした。');
    }
}
