@extends('common.user')

@section('content')
<div class="container mt-5 pt-5">
  <div class="row pb-2 border-bottom border-dark">
    <img src="https://icongr.am/fontawesome/users.svg?size=140&color=5f5f5f" class="w-auto" alt="チームアイコン">
    <div class="col d-flex align-items-center display-3">TeamName</div>
    <div class="col gap-3 d-flex align-items-end">
      <a href="" type="button" class="btn btn-warning btn-lg col-4">
        <img src="https://icongr.am/fontawesome/user-plus.svg?size=30&color=currentColor" alt="メンバー追加アイコン">
        メンバー招待
      </a>
      <a href="" type="button" class="btn btn-warning btn-lg col-4">
        <img src="https://icongr.am/material/pencil-plus.svg?size=30&color=currentColor" alt="記事追加アイコン">
        記事作成
      </a>
    </div>
  </div>
  <div class="row mt-5">
    <div class="h1 col-5">メンバー</div>
  </div>
  <div class="row border-bottom mt-3">
    @for ($i = 0; $i < 6; $i++)
    <div class="badge rounded-pill bg-secondary bg-opacity-25 w-auto text-dark py-2 px-3 mb-3 me-1">
      <img src="https://icongr.am/fontawesome/user.svg?size=30&color=545454" class="w-auto" alt="ユーザーアイコン">
      <span class="h5">member</span>
    </div>
    @endfor
  </div>
  <div class="row mt-5">
    <div class="h1">記事</div>
  </div>
  <form action="" method="GET" class="row mt-3">
    <div class="col">
      <label for="user" class="form-label h5">ユーザー</label>
      <input type="text" class="form-control bg-white" id="user" placeholder="記事を書いたユーザーで検索">
    </div>
    <div class="col">
      <label for="category" class="form-label h5">カテゴリー</label>
      <input type="text" class="form-control bg-white" id="category" placeholder="記事のカテゴリーで検索">
    </div>
    <div class="col">
      <label for="keyword" class="form-label h5">キーワード</label>
      <input type="text" class="form-control bg-white" id="keyword" placeholder="キーワードで検索">
    </div>
    <div class="col d-flex align-items-end justify-content-center">
      <button type="submit" class="btn btn-warning w-50">
        <img src="https://icongr.am/fontawesome/search.svg?size=20&color=currentColor" alt="検索アイコン">
        検索
      </button>
    </div>
  </form>
  <div class="row row-cols-1 row-cols-md-5 mt-5">
    @for ($i = 0; $i < 6; $i++)
    <div class="col-1 mb-4">
      <div class="card pt-4">
        <div class="d-flex align-items-center justify-content-center mb-3">
          <img src="https://icongr.am/material/laravel.svg?size=100&color=8f8f8f" class="w-auto" alt="記事アイコン">
        </div>
        <div class="card-body">
          <div class="card-title h2 border-bottom">Article Title</div>
          <p class="card-text mb-1">This is a longer card of aritcle.This is a longer card of aritcle.</p>
          <div>
            <span class="w-auto badge rounded-pill bg-secondary bg-opacity-25 text-dark">html/css</span>
            <span class="w-auto badge rounded-pill bg-secondary bg-opacity-25 text-dark">javascript</span>
          </div>
        </div>
      </div>
    </div>
    @endfor
  </div>
</div>
@endsection