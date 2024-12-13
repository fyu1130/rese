<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Reserve;
use Illuminate\Http\Request;
use App\Http\Requests\ShopManagerRequest;

class ShopManagerController extends Controller
{
    public function index()
    {
        $shops = Shop::where('manager_id', auth()->id())->get();
        return view('shop_manager.shops.index', compact('shops'));
    }
    public function store()
    {
        return view('shop_manager.shops.create');
    }

    public function create(ShopManagerRequest $request)
    {
        $validated = $request->validated();

        Shop::create([
            'shop_name' => $validated['shop_name'],
            'category' => $validated['category'],
            'area' => $validated['area'],
            'photo_path' => $validated['photo_path'],
            'detail' => $validated['detail'],
            'manager_id' => auth()->id(),
        ]);

        return redirect()->route('shop_manager.shops.create')->with('status', '店舗を作成しました。');
    }
    public function edit(Shop $shop)
    {
        $this->authorize('update', $shop); // 店舗管理者であるか確認

        return view('shop_manager.shops.edit', compact('shop'));
    }
    public function update(ShopManagerRequest $request, Shop $shop)
    {
        $this->authorize('update', $shop); // ポリシーで制御

        $validated = $request->validated();

        $shop->update([
            'shop_name' => $validated['shop_name'],
            'category' => $validated['category'],
            'area' => $validated['area'],
            'photo_path' => $validated['photo_path'],
            'detail' => $validated['detail'],
        ]);

        return redirect()->route('shop_manager.shops.index')->with('status', '店舗情報を更新しました。');
    }
    public function reservations()
    {
        $reserves = Reserve::whereIn('shop_id', auth()->user()->shops->pluck('id'))->get();
        return view('shop_manager.reservations.index', compact('reserves'));
    }
    public function verify(Request $request)
{
    $shopId = $request->query('shop_id');
    $date = $request->query('date');
    $time = $request->query('time');
    $member = $request->query('member');

    $reservation = Reserve::where('shop_id', $shopId)->where('date', $date)->where('time', $time)->where('member', $member)->first();

    if (!$reservation) {
        return response()->json(['error' => '予約が見つかりません。'], 404);
    }

        return view('shop_manager.verify_reservation', compact('reservation'));
}

}
