<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="{{ Route::currentRouteName() }}">
    <div id="app">
    @if (!in_array(Route::currentRouteName(), ['login', 'register']))
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/index') }}">
                    <img src="{{ asset('images/main_logo.png') }}" alt="ロゴ" style="height: 60px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                    <img src="{{ Auth::user()->icon_image ? asset('storage/' . Auth::user()->icon_image) : asset('images/dawn.png') }}" alt="プロフィール画像" class="rounded-circle" style="height: 30px;">
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/index') }}"> {{ __('HOME') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('myProfile') }}"> {{ __('プロフィール編集画面') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endif

        <main class="layout-container">
            <div class="content py-4">
                @yield('content')
            </div>

            @if (!in_array(Route::currentRouteName(), ['login', 'register']))
            <aside class="sidebar">
                <a>{{ Auth::user()->name }}さんの</a>
                <div class="follow-num">
                   <span class="left">フォロー数</span>
                   <span class="right">{{ Auth::user()->followings->count() }}名</span>
                </div>
                <a class="btn btn-followlist" href="{{ route('followList') }}">
                    {{ __('フォローリスト') }}
                </a>

                <div class="follow-num">
                   <span class="left">フォロワー数</span>
                   <span class="right">{{ Auth::user()->followers->count() }}名</span>
                </div>
                <a class="btn btn-followlist" href="{{ route('followerList') }}">
                    {{ __('フォロワーリスト') }}
                </a>

                <hr>
                <div>
                <a class="btn btn-usersearch" href="{{ route('usersSearch') }}">
                    {{ __('ユーザー検索') }}
                </a>
                </div>
            </aside>
        </main>
        @endif
    </div>
</body>
</html>
