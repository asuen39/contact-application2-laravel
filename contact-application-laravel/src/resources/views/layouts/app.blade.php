<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__utilities">
                <h1 class="header__logo">FashionablyLate</h1>
                <nav>
                    <ul class="header__nav">
                        @if (Auth::check())
                        <li class="header__nav-item">
                            <form class="form" action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="header__nav__button">ログアウト</button>
                            </form>
                        </li>
                        @elseif (Request::is('register'))
                        <li class="header__nav-item">
                            <a href="{{ route('login') }}" class="header__nav__button">Login</a>
                        </li>
                        @elseif (Request::is('login'))
                        <li class="header__nav-item">
                            <a href="{{ route('register') }}" class="header__nav__button">Register</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>