<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Checkout\Session as StripeSession;
use Stripe\PaymentIntent;
use App\Models\Payment;
use App\Models\Shop;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $shopId = $request->input('shop_id');
        $amount = $request->input('amount');
        $shop = Shop::find($shopId);

        if (!$shop) {
            return redirect()->route('my_page')->withErrors(['error' => '店舗情報が見つかりませんでした。']);
        }

        return view('payments.index', compact('shop', 'amount'));
    }

    public function payment(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'amount' => 'required|numeric|min:1',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkoutSession = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => 'Shop Payment - ' . Shop::find($request->shop_id)->shop_name,
                        ],
                        'unit_amount' => $request->amount,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('payments.complete', [], true) . '?session_id={CHECKOUT_SESSION_ID}&shop_id=' . $request->shop_id,
            'cancel_url' => route('payments.index', [], true),
        ]);

        return redirect($checkoutSession->url);
    }
    public function complete(Request $request)
    {
        // クエリパラメータを取得
        $sessionId = $request->query('session_id');
        $shopId = $request->query('shop_id');

        // バリデーション
        if (!$sessionId || !$shopId) {
            return redirect()->route('payments.index')->withErrors(['error' => '決済情報が不正です。']);
        }

        // Stripeセッション情報を取得
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $session = $stripe->checkout->sessions->retrieve($sessionId);

        // 決済情報を保存
        Payment::create([
            'user_id' => auth()->id(),
            'shop_id' => $shopId,
            'stripe_payment_id' => $session->payment_intent,
            'amount' => $session->amount_total,
            'status' => $session->payment_status,
        ]);

        return view('payments.complete', [
            'amount' => $session->amount_total,
            'shop' => Shop::find($shopId),
        ]);
    }
}
