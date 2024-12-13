@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/admin/create-email.css')}}">
@endsection

@section('content')
<div class="admin-users-index__actions">
    <a href="{{ Route('admin.shops.index') }}" class="btn">店舗代表者の一覧</a>
    <a href="{{ Route('admin.users.store') }}" class="btn">店舗代表者を作成</a>
    <a href="{{ Route('admin.email.create') }}" class="btn">メール送信</a>
</div>
<div class="admin-email-send">
    <h1 class="admin-email-send__title">メールを送信</h1>
    <form action="{{ route('admin.email.send') }}" method="POST" class="admin-email-send__form">
        @csrf
        <div class="form-group">
            <label for="recipients" class="form-label">送信先ユーザー</label>
            <select name="recipients[]" id="recipients" class="form-select" multiple required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
            <small class="form-text">Ctrl/Cmdを押しながらクリックで複数選択可能</small>
        </div>
        @error('recipients')
            <div class="form__error">{{ $message }}</div>
        @enderror
        @error('recipients.*')
            <div class="form__error">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="subject" class="form-label">件名</label>
            <input type="text" name="subject" id="subject" class="form-input" required>
        </div>
        @error('subject')
            <div class="form__error">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="message" class="form-label">メッセージ</label>
            <textarea name="message" id="message" rows="5" class="form-input" required></textarea>
        </div>
        @error('message')
            <div class="form__error">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">送信</button>
    </form>
</div>
@endsection