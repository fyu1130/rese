<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>

    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__left">
                <!-- ハンバーガーメニュー部分 -->
                <div class="nav">
                    <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
                    <input id="drawer_input" class="drawer_hidden" type="checkbox">
                    <!-- ハンバーガーアイコン -->
                    <label for="drawer_input" class="drawer_open"><span></span></label>
                    <!-- メニュー -->
                    <nav class="nav_content">
                    @if(Auth::check() && !Gate::allows('admin') && !Gate::allows('shop_manager'))
                        <ul class="nav_list">
                            <li class="nav_item"><a href="/">Home</a></li>
                            <li class="nav_item">
                                <form method="POST" action="{{ route('logout') }}" class="nav_item">
                                    @csrf
                                    <button type="submit">Logout</button>
                                </form>
                            </li>
                            <li class="nav_item"><a href="{{ route('my_page') }}">Mypage</a></li>
                        </ul>
                    @else
                        <ul class="nav_list">
                            <li class="nav_item"><a href="/login">Login</a></li>
                            <li class="nav_item"><a href="/register">Registration</a></li>
                        </ul>
                    @endif
                    </nav>
                </div>
                <h1>Rese</h1>
            </div>
            @if(Auth::check() && request()->is('/'))
                <form action="{{ route('shop.search') }}" method="post">
                    @csrf
                    <div class="search-box">
                        <select id="area" name="area" class="dropdown">
                            <option value="all" {{ $area == 'all' ? 'selected' : ''}}>All area</option>
                            <option value="東京都" {{ $area == '東京都' ? 'selected' : ''}}>東京都</option>
                            <option value="大阪府" {{ $area == '大阪府' ? 'selected' : ''}}>大阪府</option>
                            <option value="福岡県" {{ $area == '福岡県' ? 'selected' : ''}}>福岡県</option>
                        </select>
                        <select id="category" name="category" class="dropdown">
                            <option value="all" {{ $category == 'all' ? 'selected' : ''}}>All genre</option>
                            <option value="寿司" {{ $category == '寿司' ? 'selected' : ''}}>寿司</option>
                            <option value="焼肉" {{ $category == '焼肉' ? 'selected' : ''}}>焼肉</option>
                            <option value="居酒屋" {{ $category == '居酒屋' ? 'selected' : ''}}>居酒屋</option>
                            <option value="ラーメン" {{ $category == 'ラーメン' ? 'selected' : ''}}>ラーメン</option>
                            <option value="イタリアン" {{ $category == 'イタリアン' ? 'selected' : ''}}>イタリアン</option>
                        </select>
                        <input type="text" name="keyword" id="keyword" class="search-input" placeholder="Search ..."
                            value="{{ $keyword }}">
                        <button type="submit" id="search-btn" class="search-button">検索</button>
                    </div>
                </form>
            @endif
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>



<!-- <div class="nav">
    <input id="drawer__input" type="checkbox" class="drawer__hidden">
    <label for="drawer__input" class="drawer__open"><span></span></label>
    <nav class="nav__content">
        <ul class="nav__list">
            <li class="nav__item">Home</li>
            <li class="nav__item">Registration</li>
            <li class="nav__item">Login</li>
        </ul>
    </nav>
</div> -->