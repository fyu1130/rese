@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_manager/shops-create.css') }}">
@endsection

@section('content')
<div class="shops-create">
    <h1 class="shops-create__title">店舗作成</h1>
    <div class="reservations-index__actions">
        <a href="{{ route('shop_manager.shops.index') }}" class="btn">管理店舗一覧</a>
        <a href="{{ route('shop_manager.shops.create') }}" class="btn">店舗を作成</a>
        <a href="{{ route('shop_manager.reservations.index') }}" class="btn">予約一覧を見る</a>
    </div>

    @if (session('status'))
        <p class="shops-create__status">{{ session('status') }}</p>
    @endif

    <form action="{{ route('shop_manager.shops.create') }}" method="POST" class="shops-create__form">
        @csrf
        <div class="form-group">
            <label for="shop_name" class="form-label">店名:</label>
            <textarea name="shop_name" id="shop_name" class="form-input" placeholder="店舗名を入力" required></textarea>
        </div>
        @error('shop_name')
            <div class="form__error">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="area" class="form-label">エリア:</label>
            <select id="area" name="area" class="form-select">
                <option value="東京都">東京都</option>
                <option value="大阪府">大阪府</option>
                <option value="福岡県">福岡県</option>
            </select>
        </div>
        @error('area')
            <div class="form__error">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="category" class="form-label">カテゴリー:</label>
            <select id="category" name="category" class="form-select">
                <option value="寿司">寿司</option>
                <option value="焼肉">焼肉</option>
                <option value="居酒屋">居酒屋</option>
            </select>
        </div>
        @error('category')
            <div class="form__error">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="photo_path" class="form-label">写真パス:</label>
            <select id="photo_path" name="photo_path" class="form-select">
                <option value="sushi">sushi</option>
                <option value="yakiniku">yakiniku</option>
            </select>
        </div>
        @error('photo_path')
            <div class="form__error">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="detail" class="form-label">詳細:</label>
            <textarea name="detail" id="detail" class="form-input" placeholder="詳細を入力" rows="4" required></textarea>
        </div>
        @error('detail')
            <div class="form__error">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">店舗を作成</button>
    </form>
</div>
@endsection