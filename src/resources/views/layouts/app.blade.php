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
                        <ul class="nav_list">
                            <li class="nav_item"><a href="">Home</a></li>
                            <li class="nav_item"><a href="">Registration</a></li>
                            <li class="nav_item"><a href="">Login</a></li>
                        </ul>
                    </nav>
                </div>
                <h1>Rese</h1>
            </div>
            <div class="search-box">
                <select id="area" class="dropdown">
                    <option value="all">All area</option>
                    <option value="tokyo">東京都</option>
                    <option value="osaka">大阪府</option>
                    <option value="fukuoka">福岡県</option>
                </select>
                <select id="genre" class="dropdown">
                    <option value="all">All genre</option>
                    <option value="sushi">寿司</option>
                    <option value="yakiniku">焼肉</option>
                    <option value="izakaya">居酒屋</option>
                    <option value="ramen">ラーメン</option>
                    <option value="italian">イタリアン</option>
                </select>
                <input type="text" id="keyword" class="search-input" placeholder="Search ...">
                <button id="search-btn" class="search-button">検索</button>
            </div>
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