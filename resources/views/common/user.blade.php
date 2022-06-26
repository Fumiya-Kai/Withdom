<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Tempest</title>
    <meta name="description" content="学んだことのアウトプット、チームでの共有が可能" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    <header class="navbar fixed-top navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Tempest</a>
        @guest
        @else
        <a href="{{ route('mypage') }}" class="col-1 offset-10 text-white text-decoration-none">
          <img src="https://icongr.am/fontawesome/user-circle.svg?size=30&color=ffffff" class="w-auto" alt="ユーザーアイコン">
          {{ Auth::user()->name }}
        </a>
        @endguest
      </div>
    </header>
    @yield('content')
  </body>
</html>