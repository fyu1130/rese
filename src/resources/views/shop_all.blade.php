@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/shop_all.css')}}">
@endsection

@section('content')
@if($shops->isEmpty())
    <p class="no-result">検索結果が見つかりませんでした。</p>
@else
    <div class="shop-list">
        @foreach($shops as $shop)
            <div class="shop-card">
                <div class="card__img"><img src="{{asset('storage/' . $shop->photo_path . '.jpg')}}
                        " alt="{{$shop->shop_name}}" class="shop__image"></div>
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
                                <button class="like-btn"><div class="like"></div></button>
                            </form>
                        @else
                            <form action="{{ route('like.store') }}" method="POST" class="favorite">
                                @csrf
                                <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                <button class="no-like-btn"><div class="no-like"></div></button>
                            </form>
                        @endif



                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection