<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
         {{-- 後の章で説明します --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
        <title>@yield('title')</title>

        <!-- Scripts -->
         {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
        <script src="{{ secure_asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込みます --}}
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        {{-- この章の後半で作成するCSSを読み込みます --}}
        <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            {{-- 画面上部に表示するナビゲーションバーです。 --}}
            <header class="blog-header py-3">
                <div class="row flex-nowrap justify-content-between align-items-center">
                    <div class="col-2 d-flex justify-content-end align-items-center">
                        <a class="link-secondary" href="#" aria-label="Search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
                        </a>
                        <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
                    </div>
                    <div class="col-8 text-center">
                        <a href="{{ route('home') }}">
                            <h1 class="blog-header-logo text-dark">SundayRIDERS</h1>
                        </a>
                    </div>
                    
                    <div class="col-2 header-logo">
                        @guest
                        <li><a class="p-2 link-secondary" href="{{ route('login') }}">{{ __('messages.login') }}</a></li>
                        {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <ul>
                                    <li>
                                        <a class="dropdown-item" href="{{ url('home') }}">ホーム</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                        {{ __('messages.logout') }}
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </div>    
                </div>
            </header>
        </div>    
        <ul class="nav nav-pills nav-fill">
          <li class="nav-item">
              <a class="nav-link"  href="{{ url('home') }}">ホーム</a>
          </li>
          <li class="nav-item">
              <a class="nav-link"  href="{{ route('blog.index') }}">ブログ一覧</a>
          </li>
          <li class="nav-item">
              <a class="nav-link"  href="{{ route('board.index') }}">掲示板</a>
          </li>
          <li class="nav-item">
              <a class="nav-link"  href="{{ route('blog.create') }}">ブログを書く</a>
          </li>
          <li class="nav-item">
              <a class="nav-link"  href="{{ route('board.create') }}">掲示板を書く</a>
          </li>
      </ul>
      <div class="p-4 p-md-5 m-4 text-white rounded bg-dark">
          <div class="col-md-6 px-0">
              <h1 class="display-4 fst-italic">Sunday RIDER'S</h1>
              <p class="lead my-3">おすすめスポットをのせれるブログとツーリング仲間を募集する掲示板<br>
              初心者から上級者まで気軽に書き込んでください</p>
              <p class="lead mb-0"><a href="#" class="text-white fw-bold">管理人ブログ</a></p>
          </div>
      </div>
      
        @yield('content')
            
    </body>
</html>