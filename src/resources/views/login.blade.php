@extends('layouts.app') 

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__container">
    <form action="/login" class="form" method="post">
        @csrf
        <div class="form__header">Login</div>
        <div class="form__body">
            <div class="form__group">
                <span class="icon">📧</span>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
                <div class="form__error">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <span class="icon">🔒</span>
                <input type="password" name="password" placeholder="Password" required />
                <div class="form__error">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__footer">
            <button class="form__button" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection
