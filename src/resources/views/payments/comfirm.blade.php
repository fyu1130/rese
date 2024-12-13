@extends('layouts.app')

@section('content')
<h1>お支払い確認</h1>

<div id="payment-form">
    <button id="pay-button">支払いを確定する</button>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ env('STRIPE_PUBLIC') }}");
    const clientSecret = "{{ $clientSecret }}";

    document.getElementById('pay-button').addEventListener('click', async () => {
        const { error } = await stripe.confirmCardPayment(clientSecret, {
            payment_method: {
                card: {
                    // Stripe Elementsのカードフィールド
                    number: '4242424242424242',
                    exp_month: 12,
                    exp_year: 2024,
                    cvc: '123'
                },
            },
        });

        if (error) {
            alert('決済に失敗しました: ' + error.message);
        } else {
            alert('決済が完了しました');
            window.location.href = "{{ route('my_page') }}";
        }
    });
</script>
@endsection