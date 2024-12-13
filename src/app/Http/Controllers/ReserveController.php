<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ReserveController extends Controller
{
    public function store(ReserveRequest $request)
    {
        $validated = $request->validated();
        Reserve::create([
            'user_id' => Auth::id(),
            'shop_id' => $validated['shop_id'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'member' => $validated['number'],
        ]);

        return view('done');
    }
    public function destroy($id)
    {
        $reserve = Reserve::where('id', $id)->where('user_id', Auth::id())->first();
        if ($reserve) {
            $reserve->delete();
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $reserve = Reserve::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$reserve) {
            return redirect()->back()->withErrors('予約が見つかりません。');
        }

        return view('reserve-edit', compact('reserve'));
    }

    public function update(ReserveRequest $request, $id)
    {
        $validated = $request->validated();

        $reserve = Reserve::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$reserve) {
            return redirect()->back()->withErrors('予約が見つかりません。');
        }

        $reserve->update([
            'date' => $validated['date'],
            'time' => $validated['time'],
            'member' => $validated['number'],
        ]);

        return redirect()->route('my_page')->with('status', '予約が更新されました。');
    }
    public function generateQrCode($id)
    {
        $reserve = Reserve::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$reserve) {
            return redirect()->back()->withErrors('予約が見つかりません。');
        }
        // 店舗確認用のURLを生成
        $url = route('reserve.verify', [
            'shop_id' => $reserve->shop_id,
            'date' => $reserve->date,
            'time' => $reserve->time,
            'member' => $reserve->member,
        ]);


        $qrCode = QrCode::size(200)->generate($url);

        return view('reserve-qr', compact('reserve', 'qrCode'));
    }

}
