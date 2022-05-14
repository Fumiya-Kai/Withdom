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
      </div>
    </header>
    @yield('content')
  </body>
</html>