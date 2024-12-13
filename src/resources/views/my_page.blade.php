@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/my_page.css')}}">
@endsection

@section('content')
<div class="user-name">
    <h1>{{$user->name}}さん</h1>
</div>
<div class="content">
    <section class="reservation-status">
        <h2>予約状況</h2>
        <div class="upcoming-reservations">
            <h3>これからの予約</h3>
            @forelse ($upcomingReserves as $reserve)
                            <div class="reservation-card">
                                <div class="reservation-number">
                                    <div class="reservation-icon">🕝</div>
                                    <h4>予約{{$loop->iteration}}</h4>
                                </div>
                                <div class="reservation-summary">
                                    <table>
                                        <tr>
                                            <th>Shop</th>
                                            <td>{{ $reserve->shop->shop_name ?? '不明な店舗' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <td>{{$reserve->date}}</td>
                                        </tr>
                                        <tr>
                                            <th>Time</th>
                                            <td>{{$reserve->time}}</td>
                                        </tr>
                                        <tr>
                                            <th>Number</th>
                                            <td>{{$reserve->member}}人</td>
                                        </tr>
                                    </table>
                                </div>
                                <form action="{{ route('reserve.cancel', ['id' => $reserve->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="close-btn">×</button>
                                </form>
                                <div class="btn-content">
                                    <form action="{{ route('reserve.qr', ['id' => $reserve->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="QR-btn">QRコード表示</button>
                                    </form>
                                    <form action="{{ route('reserve.edit', ['id' => $reserve->id]) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="reserve-edit-btn">予約変更</button>
                                    </form>
                                    @if($reserve->is_paid)
                                        <!-- 支払い済みラベル -->
                                        <span class="paid-label">支払い済み</span>
                                    @else
                                        <!-- 支払い画面への遷移ボタン -->
                                        <form action="{{ route('payments.index') }}" method="GET">
                                            @csrf
                                            <input type="hidden" name="shop_id" value="{{ $reserve->shop_id }}">
                                            <input type="hidden" name="amount" value="10000"> <!-- 金額は固定値や動的に設定可能 -->
                                            <button type="submit" class="payments-create-btn">先払い画面へ</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
            @empty
                <p class="no-result">これからの予約はありません。</p>
            @endforelse
        </div>
        <div class="past-reservations">
            <h3>レビュー可能な予約</h3>
            @forelse ($pastReserves as $reserve)
                <div class="reservation-card">
                    <div class="reservation-number">
                        <div class="reservation-icon">⭐</div>
                        <h4>予約{{$loop->iteration}}</h4>
                    </div>
                    <div class="reservation-summary">
                        <table>
                            <tr>
                                <th>Shop</th>
                                <td>{{ $reserve->shop->shop_name ?? '不明な店舗' }}</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>{{$reserve->date}}</td>
                            </tr>
                            <tr>
                                <th>Time</th>
                                <td>{{$reserve->time}}</td>
                            </tr>
                        </table>
                    </div>
                    <a href="{{ route('reviews.create', ['shop' => $reserve->shop->id]) }}" class="review-btn">レビューを書く</a>
                </div>
            @empty
                <p class="no-result">レビュー可能な予約はありません。</p>
            @endforelse
        </div>
    </section>
    <section class="favorite-shops">
        <h2>お気に入り店舗</h2>
        <div class="shop-list">
            @forelse ($likedShops as $shop)
                <div class="shop-card">
                    <div class="card__img"><img src="{{asset('storage/' . $shop->photo_path . '.jpg')}}" alt="{{$shop->shop_name}}" class="shop__image"></div>
                    <div class="card__content">
                        <h2 class="shop__name">{{$shop->shop_name}}</h2>
                        <div class="shop__tag">
                            <p class="shop__tag--place">＃{{$shop->area}}</p>
                            <p class="shop__tag--genre">＃{{$shop->category}}</p>
                        </div>
                        <div class="card__btn">
                            <a href="/detail/{{$shop->id}}" class="details-btn">詳しく見る</a>
                            @if($shop->likes->contains('user_id', Auth::id()))
                                <form action="{{ route('like.destroy', ['id' => $shop->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="like-btn">
                                        <div class="like"></div>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('like.store') }}" method="POST" class="favorite">
                                    @csrf
                                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                    <button class="no-like-btn">
                                        <div class="no-like"></div>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="no-result">お気に入り店舗はまだありません。</p>
            @endforelse
        </div>
    </section>
</div>
@endsection