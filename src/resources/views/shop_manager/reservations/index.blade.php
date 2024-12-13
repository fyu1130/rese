@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_manager/reservations-index.css') }}">
@endsection

@section('content')
<div class="reservations-index">
    <h1 class="reservations-index__title">予約情報一覧</h1>

    <div class="reservations-index__actions">
        <a href="{{ route('shop_manager.shops.index') }}" class="btn">管理店舗一覧</a>
        <a href="{{ route('shop_manager.shops.create') }}" class="btn">店舗を作成</a>
        <a href="{{ route('shop_manager.reservations.index') }}" class="btn">予約一覧を見る</a>
    </div>

    @if ($reserves->isEmpty())
        <p class="reservations-index__no-data">現在、予約情報はありません。</p>
    @else
        <table class="reservations-index__table">
            <thead>
                <tr>
                    <th>店舗名</th>
                    <th>予約者名</th>
                    <th>予約日時</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reserves as $reserve)
                    <tr>
                        <td>{{ $reserve->shop->shop_name }}</td>
                        <td>{{ $reserve->user->name }}</td>
                        <td>{{ $reserve->date }} {{ $reserve->time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection