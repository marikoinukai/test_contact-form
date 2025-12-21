<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  <style>
    /* 共通ヘッダーの最小限のスタイル */
    .header__inner {
      max-width: 1230px;
      margin: 0 auto;
      padding: 20px 15px;
    }

    .header-utilities {
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .header__logo {
      color: #8b7969;
      text-decoration: none;
      font-size: 24px;
      font-family: serif;
    }

    .header__nav {
      position: absolute;
      right: 0;
    }

    .header__button {
      background-color: #ebe6e1;
      color: #8b7969;
      padding: 8px 25px;
      border-radius: 4px;
      text-decoration: none;
      border: none;
      cursor: pointer;
      font-size: 14px;
    }
  </style>
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <a class="header__logo" href="/">FashionablyLate</a>
        <nav class="header__nav">
          @if (Auth::check())
          <form class="form" action="/logout" method="post">
            @csrf
            <button class="header__button" type="submit">logout</button>
          </form>
          @elseif (Request::is('login'))
          <a class="header__button" href="/register">register</a>
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
