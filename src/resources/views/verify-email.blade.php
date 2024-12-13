@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection
@section('content')
<div class="verify-email">
    <h1 class="verify-email__title">メール認証</h1>
    <p>登録時に入力したメールアドレスに確認リンクを送信しました。</p>
    <form action="/logout" method="post">
        @csrf
        <button class="btn btn-secondary">ログアウト</button>
    </form>
</div>
<!-- 再送信はなし -->
@endsection