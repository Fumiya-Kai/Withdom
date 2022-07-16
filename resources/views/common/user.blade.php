<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Withdom</title>
    <meta name="description" content="学んだことのアウトプット、チームでの共有が可能" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/common.js') }}"></script>
  </head>
  <body>
    <header class="navbar fixed-top navbar-dark bg-primary">
      <div class="container-fluid justify-content-between">
        <a class="navbar-brand fs-3" href="{{ route('mypage') }}">Withdom</a>
        @guest
        @else
        @if(Auth::id() === 1)
        <div class="user-head col-4 col-md-1 text-white">
          <div class="dropdown-toggle d-flex align-items-center" id="dropdownMenuButton1" data-bs-toggle="dropdown">
            <img src="https://icongr.am/fontawesome/user-circle.svg?size=30&color=ffffff" class="w-auto" alt="ユーザーアイコン">
            <div class="ms-2">
              {{ Auth::user()->name }}
            </div>
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
        <div class="user-head col-4 col-md-1 text-white">
          <div class="dropdown-toggle d-flex align-items-center" id="dropdownMenuButton1" data-bs-toggle="dropdown">
            <img src="https://icongr.am/fontawesome/user-circle.svg?size=30&color=ffffff" class="w-auto" alt="ユーザーアイコン">
            <div class="ms-2">
              {{ Auth::user()->name }}
            </div>
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