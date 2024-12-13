@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_manager/shops-index.css') }}">
@endsection

@section('content')
<div class="shops-index">
    <h1 class="shops-index__title">管理店舗一覧</h1>

    <div class="reservations-index__actions">
        <a href="{{ route('shop_manager.shops.index') }}" class="btn">管理店舗一覧</a>
        <a href="{{ route('shop_manager.shops.create') }}" class="btn">店舗を作成</a>
        <a href="{{ route('shop_manager.reservations.index') }}" class="btn">予約一覧を見る</a>
    </div>

    @if($shops->isEmpty())
        <p class="shops-index__no-data">管理している店舗はありません。</p>
    @else
        <div class="shop-list">
            @foreach($shops as $shop)
                <div class="shop-card">
                    <div class="card__img">
                        <img src="{{ asset('storage/' . $shop->photo_path . '.jpg') }}" alt="{{ $shop->shop_name }}"
                            class="shop__image">
                    </div>
                    <div class="card__content">
                        <h2 class="shop__name">{{ $shop->shop_name }}</h2>
                        <div class="shop__tag">
                            <p class="shop__tag--place">＃{{ $shop->area }}</p>
                            <p class="shop__tag--genre">＃{{ $shop->category }}</p>
                        </div>
                        <div class="card__btn">
                            <a href="{{Route('shop_manager.shops.edit', ['shop' => $shop->id])}}" class="edit-btn">編集する</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection