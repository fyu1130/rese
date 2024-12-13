@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endsection

@section('content')
<section class="shop__content">
    <div class="shop__header">
        <button onclick="location.href='/detail/{{ $shop->id == $last_id ? 1 : $shop->id + 1 }}'"
            class="next-shop__btn">＜</button>
        <h2 class="shop__name">{{ $shop->shop_name }}</h2>
    </div>
    <div class="card__img">
        <img src="{{asset('storage/' . $shop->photo_path . '.jpg')}}" alt="{{ $shop->shop_name }}" class="shop__image">
    </div>
    <div class="shop__tag">
        <p class="shop__tag--place">＃{{ $shop->area }}</p>
        <p class="shop__tag--genre">＃{{ $shop->category }}</p>
    </div>
    <div class="shop__detail">
        <p>{{ $shop->detail }}</p>
    </div>
</section>
<section class="reservation-form">
    <h3 class="form__ttl">予約</h3>
    <form action="{{ route('reserve.store') }}" method="POST">
        @csrf
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
        @error('shop_id')
            <div class="form__error">
                {{ $message }}
            </div>
        @enderror

        <!-- Date input -->
        <input type="date" name="date" id="date" value="{{ old('date', now()->format('Y-m-d')) }}">
        <div class="form__error">
            @error('date')
                <div class="form__error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Time input -->
        <input type="time" name="time" id="time" value="{{ old('time', '17:00') }}" list="data-list" step="1800">
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
            <div class="form__error">
                {{ $message }}
            </div>
        @enderror

        <!-- Number of people -->
        <select name="number" id="number">
            <option value="1">１人</option>
            <option value="2">２人</option>
            <option value="3">３人</option>
            <option value="4">４人</option>
            <option value="5">５人</option>
            <option value="6">６人</option>
            <option value="7">７人</option>
            <option value="8">８人</option>
        </select>
        @error('number')
            <div class="form__error">
                {{ $message }}
            </div>
        @enderror

        <div class="reservation-summary">
            <table>
                <tr>
                    <th>Shop</th>
                    <td id="summary-shop">{{ $shop->shop_name }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td id="summary-date">{{ old('date', now()->format('Y-m-d')) }}</td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td id="summary-time">{{ old('time', '17:00')}}</td>
                </tr>
                <tr>
                    <th>Number</th>
                    <td id="summary-number">{{ old('number', 1) }}人</td>
                </tr>
            </table>
        </div>
        <button class="reserve-btn" type="submit">予約する</button>
    </form>
</section>

<!-- JavaScript to update reservation summary -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateInput = document.getElementById('date');
        const timeInput = document.getElementById('time');
        const numberInput = document.getElementById('number');

        const summaryDate = document.getElementById('summary-date');
        const summaryTime = document.getElementById('summary-time');
        const summaryNumber = document.getElementById('summary-number');

        dateInput.addEventListener('input', function () {
            summaryDate.textContent = dateInput.value;
        });

        timeInput.addEventListener('input', function () {
            summaryTime.textContent = timeInput.value;
        });

        numberInput.addEventListener('input', function () {
            summaryNumber.textContent = numberInput.value + '人';
        });
    });
</script>
@endsection