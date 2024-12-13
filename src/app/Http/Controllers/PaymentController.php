<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $payment = Payment::create([
            'user_id' => auth()->id(),
            'shop_id' => $request->shop_id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return view('payments.create', compact('payment'));
    }

    public function charge(Request $request, $paymentId)
    {
        $payment = Payment::findOrFail($paymentId);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $intent = PaymentIntent::create([
                'amount' => $payment->amount * 100, // Stripeはセント単位
                'currency' => 'jpy',
                'metadata' => ['payment_id' => $payment->id],
                'automatic_payment_methods' => ['enabled' => true], // 自動的な支払い方法のサポート
            ]);

            $payment->update([
                'stripe_payment_id' => $intent->id,
            ]);

            return view('payments.confirm', [
                'clientSecret' => $intent->client_secret,
                'payment' => $payment,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('決済に失敗しました: ' . $e->getMessage());
        }
    }

    public function complete(Request $request, $paymentId)
    {
        $payment = Payment::findOrFail($paymentId);

        if ($payment->stripe_payment_id) {
            $payment->update(['status' => 'completed']);
            return redirect()->route('my_page')->with('status', '決済が完了しました！');
        }

        return redirect()->route('my_page')->withErrors('決済が完了できませんでした。');
    }
}
