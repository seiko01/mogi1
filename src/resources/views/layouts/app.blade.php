<!DOCTYPE html>
<html lang="ja">

    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    </head>

    <body>
        <header class="header">
            <div class="header__inner">
                <div class="header__logo">
                    <img src="{{ asset('img/logo.svg') }}" alt="COACHTECH">
                </div>
                @if (!in_array(Route::currentRouteName(), ['login', 'register']))
                    <form class="header__search-form" action="{{ route('items.search') }}" method="GET">
                        <input type="text" name="query" placeholder="なにをお探しですか？">
                    </form>
                <nav class="header__nav">
                @if (Auth::check())
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">ログイン</a>
                @endif
                    <a href="{{ route('mypage') }}">マイページ</a>
                    <a href="{{ route('items.create') }}" class="sell-button">出品</a>
                </nav>
                @endif
            </div>
        </header>
        <main>
            @yield('content')
        </main>
    </body>

</html>
