@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/reserve-qr.css')}}">
@endsection

@section('content')
<div class="reserve-qr">
    <h1 class="reserve-qr__title">予約QRコード</h1>
    <div class="reserve-qr__details">
        <h2>店舗名: {{ $reserve->shop->shop_name }}</h2>
        <p>日付: {{ $reserve->date }}</p>
        <p>時間: {{ $reserve->time }}</p>
        <p>人数: {{ $reserve->member }}人</p>
    </div>
    <div class="reserve-qr__code">
        {!! $qrCode !!}
    </div>
    <a href="{{ route('my_page') }}" class="btn btn-primary">マイページに戻る</a>
</div>
@endsection