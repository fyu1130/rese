@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_manager/verify_reservation.css') }}">
@endsection

@section('content')
<div class="verify-reservation">
    <h1 class="verify-reservation__title">予約確認</h1>
    <div class="reservations-index__actions">
        <a href="{{ route('shop_manager.shops.index') }}" class="btn">管理店舗一覧</a>
        <a href="{{ route('shop_manager.shops.create') }}" class="btn">店舗を作成</a>
        <a href="{{ route('shop_manager.reservations.index') }}" class="btn">予約一覧を見る</a>
    </div>

    @if($reservation)
        <table class="verify-reservation__table">
            <tr>
                <th>予約ID</th>
                <td>{{ $reservation->id }}</td>
            </tr>
            <tr>
                <th>店舗名</th>
                <td>{{ $reservation->shop->shop_name }}</td>
            </tr>
            <tr>
                <th>日付</th>
                <td>{{ $reservation->date }}</td>
            </tr>
            <tr>
                <th>時間</th>
                <td>{{ $reservation->time }}</td>
            </tr>
            <tr>
                <th>人数</th>
                <td>{{ $reservation->member }}人</td>
            </tr>
        </table>
    @else
        <p class="verify-reservation__no-data">該当する予約が見つかりません。</p>
    @endif

    <a href="{{ route('shop_manager.reservations.index') }}" class="btn btn-primary">戻る</a>
</div>
@endsection