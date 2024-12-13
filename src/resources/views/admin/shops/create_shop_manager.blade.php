@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/admin/create-shop-manager.css')}}">
@endsection

@section('content')
<div class="admin-users-index__actions">
    <a href="{{ Route('admin.shops.index') }}" class="btn">店舗代表者の一覧</a>
    <a href="{{ Route('admin.users.store') }}" class="btn">店舗代表者を作成</a>
    <a href="{{ Route('admin.email.create') }}" class="btn">メール送信</a>
</div>
<div class="admin-users-create">
    <h1 class="admin-users-create__title">店舗代表者登録</h1>
    @if (session('status'))
        <p class="admin-users-create__status">{{ session('status') }}</p>
    @endif
    <form action="{{ route('admin.users.create') }}" method="POST" class="admin-users-create__form">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">名前:</label>
            <input type="text" name="name" id="name" class="form-input" required>
        </div>
        @error('name')
            <div class="form__error">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="email" class="form-label">メールアドレス:</label>
            <input type="email" name="email" id="email" class="form-input" required>
        </div>
        @error('email')
            <div class="form__error">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="password" class="form-label">パスワード:</label>
            <input type="password" name="password" id="password" class="form-input" required>
        </div>
        @error('password')
            <div class="form__error">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="password_confirmation" class="form-label">パスワード確認:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="shop_id" class="form-label">店舗を割り当て:</label>
            <select name="shop_id" id="shop_id" class="form-select" required>
                @foreach ($shops as $shop)
                    <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                @endforeach
            </select>
        </div>
        @error('shop_id')
            <div class="form__error">{{ $message }}</div>
        @enderror
        <input type="hidden" name="role_id" value="2">
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>
@endsection