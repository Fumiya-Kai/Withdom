@extends('common.user')

@section('content')
<div class="container mt-5 pt-5">
  <div class="row">
    <img src="https://icongr.am/fontawesome/user-circle.svg?size=140&color=70e6a9" class="w-auto" alt="ユーザーアイコン">
    <div class="col d-flex align-items-center display-3">UserName</div>
  </div>
  <div class="row mb-4">
    <div class="d-flex justify-content-end">
      <a href="" type="button" class="btn btn-warning btn-lg">チーム作成</a>
      <div class="col-2"></div>
    </div>
  </div>
  <div class="row">
    <div class="h1">チーム</div>
  </div>
  <div class="row row-cols-1 row-cols-md-4 mb-4">
    @for ($i = 0; $i < 6; $i++)
    <div class="col mb-4">
      <div class="card p-3">
        <div class="row">
          <div class="col text-center">
            <img src="https://icongr.am/material/account-group.svg?size=80&color=8f8f8f" class="w-auto" alt="チームアイコン">
          </div>
          <div class="col">
            <div class="h2 d-flex align-items-center m-0 border-bottom">TeamName</div>
            <div>This is a team. Member study about</div>
          </div>
        </div>
      </div>
    </div>
    @endfor
  </div>
  <div class="row">
    <div class="h1">記事</div>
  </div>
  <div class="row row-cols-1 row-cols-md-5">
    @for ($i = 0; $i < 6; $i++)
    <div class="col-1 mb-4">
      <div class="card pt-4">
        <div class="d-flex align-items-center justify-content-center mb-3">
          <img src="https://icongr.am/devicon/html5-original.svg?size=100&color=8f8f8f" class="w-auto" alt="記事アイコン">
        </div>
        <div class="card-body">
          <div class="card-title h2 border-bottom">Article Title</div>
          <p class="card-text mb-1">This is a longer card of aritcle.This is a longer card of aritcle.This is a longer card of aritcle.</p>
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