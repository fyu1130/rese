@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/shop_detail.css')}}">
@endsection

@section('content')
<section class="shop__content">
    <div class="shop__header">
        <button class="next-shop__btn">＜</button>
        <h2 class="shop__name">仙人</h2>
    </div>
    <div class="card__img"><img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="仙人"
            class="shop__image"></div>
    <div class="shop__tag">
        <p class="shop__tag--place">＃東京都</p>
        <p class="shop__tag--genre">＃寿司</p>
    </div>
    <div class="shop__detail">
        <p>料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。</p>
    </div>
</section>
<section class="reservation-form">
    <h3 class="form__ttl">予約</h3>
    <form action="/" method="get">
        <input type="date" name="date" id="date" value="2021-04-01">
        <input type="time" name="time" id="time" value="17:00">
        <select name="number" id="number">
            <option value="1" selected>１人</option>
            <option value="2">２人</option>
            <option value="3">３人</option>
            <option value="4">４人</option>
        </select>
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
        <button class="reserve-btn" type="submit">予約する</button>
    </form>
</section>
@endsection