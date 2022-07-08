<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Tempest</title>
    <meta name="description" content="学んだことのアウトプット、チームでの共有が可能" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/common.js') }}"></script>
  </head>
  <body>
    <header class="navbar fixed-top navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand fs-3" href="{{ route('mypage') }}">Tempest</a>
        @guest
        @else
        @if(Auth::id() === 1)
        <div class="user-head col-1 offset-10 text-white">
          <div class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown">
            <img src="https://icongr.am/fontawesome/user-circle.svg?size=30&color=ffffff" class="w-auto" alt="ユーザーアイコン">
            {{ Auth::user()->name }}
          </div>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="{{ route('mypage') }}">ゲストマイページ</a></li>
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                 ログイン
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </div>
        @else
        <div class="user-head col-1 offset-10 text-white">
          <div class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown">
            <img src="https://icongr.am/fontawesome/user-circle.svg?size=30&color=ffffff" class="w-auto" alt="ユーザーアイコン">
            {{ Auth::user()->name }}
          </div>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="{{ route('mypage') }}">マイページ</a></li>
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                 ログアウト
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </div>
        @endif
        @endguest
      </div>
    </header>
    @yield('content')
  </body>
</html>