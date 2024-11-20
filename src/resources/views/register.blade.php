@extends('layouts.app') 

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="login__container">
    <form action="/register" class="form" method="post">
        @csrf
        <div class="form__header">Registration</div>
        <div class="form__body">
            <div class="form__group">
                <span class="icon">👤</span>
                <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required />
                <div class="form__error">
                    @error('username')
                        {{ $message }}
                    @enderror
                </div>
            </div>
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
            <button class="form__button" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection