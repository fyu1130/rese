@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_manager/shops-edit.css') }}">
@endsection

@section('content')
<div class="shops-edit">
    <h1 class="shops-edit__title">店舗情報編集</h1>

    <div class="reservations-index__actions">
        <a href="{{ route('shop_manager.shops.index') }}" class="btn">管理店舗一覧</a>
        <a href="{{ route('shop_manager.shops.create') }}" class="btn">店舗を作成</a>
        <a href="{{ route('shop_manager.reservations.index') }}" class="btn">予約一覧を見る</a>
    </div>
    @if (session('status'))
        <p class="shops-edit__status">{{ session('status') }}</p>
    @endif

    <form action="{{ route('shop_manager.shops.update', ['shop' => $shop->id]) }}" method="POST"
        class="shops-edit__form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="shop_name" class="form-label">店舗名:</label>
            <input type="text" name="shop_name" id="shop_name" class="form-input"
                value="{{ old('shop_name', $shop->shop_name) }}" required>
        </div>
        @error('shop_name')
            <div class="form__error">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="area" class="form-label">エリア:</label>
            <select id="area" name="area" class="form-select">
                <option value="東京都" {{ old('area', $shop->area) == '東京都' ? 'selected' : '' }}>東京都</option>
                <option value="大阪府" {{ old('area', $shop->area) == '大阪府' ? 'selected' : '' }}>大阪府</option>
                <option value="福岡県" {{ old('area', $shop->area) == '福岡県' ? 'selected' : '' }}>福岡県</option>
            </select>
        </div>
        @error('shop_category')
            <div class="form__error">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="category" class="form-label">カテゴリー:</label>
            <select id="category" name="category" class="form-select">
                <option value="寿司" {{ old('category', $shop->category) == '寿司' ? 'selected' : '' }}>寿司</option>
                <option value="焼肉" {{ old('category', $shop->category) == '焼肉' ? 'selected' : '' }}>焼肉</option>
            </select>
        </div>

        <div class="form-group">
            <label for="photo_path" class="form-label">写真パス:</label>
            <input type="text" name="photo_path" id="photo_path" class="form-input"
                value="{{ old('photo_path', $shop->photo_path) }}" required>
        </div>

        <div class="form-group">
            <label for="detail" class="form-label">詳細:</label>
            <textarea name="detail" id="detail" class="form-input" rows="4"
                required>{{ old('detail', $shop->detail) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
    </form>
</div>
@endsection