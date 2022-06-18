<!DOCTYPE html>
<html lang="ja">
  <body>
    <p>{{ $text }}</p><br>
    <p>以下のURLからユーザー登録またはログインしてください。URLの有効期限は30分です。</p><br>
    <a href="{{ $url }}">{{ $url }}</a>
    <br>
    <p>本メールは送信専用メールアドレスから配信されています。ご返信いただいてもお答え致しかねますのでご了承ください。</p>
  </body>
</html>