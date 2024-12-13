@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/payments/index.css')}}">
@endsection

@section('content')
<div class="payment-page">
    <h1>お支払い</h1>
    <div class="shop-info">
        <h2>店舗情報</h2>
        <p>店舗名: {{ $shop->shop_name }}</p>
    </div>
    <div class="payment-info">
        <h2>支払金額: {{ number_format($amount) }}円</h2>
    </div>
    <form action="{{ route('payments.payment') }}" method="POST">
        @csrf
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <button type="submit" class="payment-btn">Stripeで支払う</button>
    </form>
    <a href="{{ route('my_page') }}" class="back-btn">マイページに戻る</a>
</div>
@endsection