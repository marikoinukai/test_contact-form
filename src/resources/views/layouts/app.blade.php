<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>A-Shop</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <a class="header__logo" href="/">FashionablylLate</a>
        
        {{-- ボタンの切り替えロジック --}}
            <nav class="header__nav">
                @if (Request::is('login'))
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