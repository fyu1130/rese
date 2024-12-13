@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/reserve-edit.css')}}">
@endsection
@section('content')
<div class="reserve-edit-container">
    <h1 class="reserve-edit-title">予約を変更</h1>
    <form action="{{ route('reserve.update', $reserve->id) }}" method="POST" class="reserve-edit-form">
        @csrf
        @method('PUT')

        <input type="hidden" name="shop_id" value="{{ $reserve->shop_id }}">
        @error('shop_id')
            <div class="form__error">{{ $message }}</div>
        @enderror

        <label for="date">予約日:</label>
        <input type="date" name="date" id="date" value="{{ $reserve->date }}" required>
        @error('date')
            <div class="form__error">{{ $message }}</div>
        @enderror

        <label for="time">予約時間:</label>
        <input type="time" name="time" id="time" value="{{ \Carbon\Carbon::parse($reserve->time)->format('H:i') }}"
            list="data-list" step="1800" required>
        <datalist id="data-list">
            <option value="17:00"></option>
            <option value="17:30"></option>
            <option value="18:00"></option>
            <option value="18:30"></option>
            <option value="19:00"></option>
            <option value="19:30"></option>
            <option value="20:00"></option>
            <option value="20:30"></option>
            <option value="21:00"></option>
            <option value="21:30"></option>
            <option value="22:00"></option>
        </datalist>
        @error('time')
            <div class="form__error">{{ $message }}</div>
        @enderror

        <label for="member">人数:</label>
        <select name="number" id="number" required>
            <option value="1">1人</option>
            <option value="2">2人</option>
            <option value="3">3人</option>
            <option value="4">4人</option>
            <option value="5">5人</option>
            <option value="6">6人</option>
            <option value="7">7人</option>
            <option value="8">8人</option>
        </select>
        @error('number')
            <div class="form__error">{{ $message }}</div>
        @enderror

        <button type="submit" class="reserve-edit-button">予約を変更</button>
    </form>

    <a href="{{ route('my_page') }}" class="reserve-edit-back">戻る</a>
</div>
@endsection