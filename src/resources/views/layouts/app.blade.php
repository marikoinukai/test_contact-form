<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>A-Shop</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />

  {{-- ここから追記：直接スタイルを書く --}}
  <style>
    .header-utilities {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        position: relative !important;
        width: 100% !important;
    }

    .header__nav {
        position: absolute !important;
        right: 0 !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
    }

    .header__button {
        display: inline-block !important;
        text-decoration: none !important;
        background-color: #ebe6e1 !important; /* 薄いベージュ */
        color: #8b7969 !important;           /* 茶色 */
        padding: 8px 25px !important;
        border-radius: 4px !important;
        font-size: 14px !important;
        border: none !important;
        cursor: pointer;
    }
  </style>
  {{-- ここまで追記 --}}

  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <a class="header__logo" href="/">FashionablylLate</a>
        
        {{-- ボタンの切り替えロジック --}}
            <nav class="header__nav">
    {{-- ログインしている場合（管理画面など） --}}
          @if (Auth::check())
              <form class="form" action="/logout" method="post">
                  @csrf
                  <button class="header__button" type="submit">logout</button>
              </form>

          {{-- ログインしていない、かつログイン画面にいる場合 --}}
          @elseif (Request::is('login'))
              <a class="header__button" href="/register">register</a>

          {{-- ログインしていない、かつ登録画面にいる場合 --}}
          @elseif (Request::is('register'))
              <a class="header__button" href="/login">login</a>
          @endif
      </nav>


      </div>  
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>

</html>