@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/admin/index.css')}}">
@endsection

@section('content')
<div class="admin-users-index__actions">
    <a href="{{ Route('admin.shops.index') }}" class="btn">店舗代表者の一覧</a>
    <a href="{{ Route('admin.users.store') }}" class="btn">店舗代表者を作成</a>
    <a href="{{ Route('admin.email.create') }}" class="btn">メール送信</a>
</div>
<div class="admin-users-index">
    <h1 class="admin-users-index__title">店舗代表者一覧</h1>
    <ul class="admin-users-index__list">
        @foreach ($shopManagers as $manager)
            <li class="admin-users-index__item"><span class="manager-name">{{ $manager->name }}</span>
            <span class="manager-email">({{ $manager->email }})</span>
            - <span class="shop-names">
                @if ($manager->shops->isEmpty())
                    店舗未割り当て
                @else
                    @foreach ($manager->shops as $shop)
                        <span class="shop-name">{{ $shop->shop_name }}</span>{{ !$loop->last ? ',' : '' }}
                    @endforeach
                @endif
            </span></li>
        @endforeach
    </ul>
</div>
@endsection