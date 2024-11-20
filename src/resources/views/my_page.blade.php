@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/my_page.css')}}">
@endsection

@section('content')
<div class="user-name">
    <h1>testさん</h1>
</div>
<div class="content">
    <section class="reservation-status">
        <h2>予約状況</h2>
        <div class="reservation-card">
            <div class="reservation-number">
                <div class="reservation-icon">🕝</div>
                <h3>予約１</h3>
            </div>
            <div class="reservation-summary">
                <table>
                    <tr>
                        <th>Shop</th>
                        <td>仙人</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>2021-04-01</td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td>17:00</td>
                    </tr>
                    <tr>
                        <th>Number</th>
                        <td>１人</td>
                    </tr>
                </table>
            </div>
            <button class="close-btn">×</button>
        </div>
    </section>
    <section class="favorite-shops">
        <h2>お気に入り店舗</h2>
        <div class="shop-list">
            <div class="shop-card">
                <div class="card__img"><img
                        src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="仙人"
                        class="shop__image"></div>
                <div class="card__content">
                    <h2 class="shop__name">仙人</h2>
                    <div class="shop__tag">
                        <p class="shop__tag--place">＃東京都</p>
                        <p class="shop__tag--genre">＃寿司</p>
                    </div>
                    <div class="card__btn">
                        <button class="details-btn">詳しく見る</button>
                        <button class="favorite-btn">♥</button>
                    </div>
                </div>
            </div>
            <div class="shop-card">
                <div class="card__img"><img
                        src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="仙人"
                        class="shop__image"></div>
                <div class="card__content">
                    <h2 class="shop__name">仙人</h2>
                    <div class="shop__tag">
                        <p class="shop__tag--place">＃東京都</p>
                        <p class="shop__tag--genre">＃寿司</p>
                    </div>
                    <div class="card__btn">
                        <button class="details-btn">詳しく見る</button>
                        <button class="favorite-btn">♥</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection