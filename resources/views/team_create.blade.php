@extends('common.user')

@section('content')
<div class="container mt-5 pt-5">
  <div class="row">
    <div class="display-6">チーム作成</div>
  </div>
  <form action="" method="post" class="mt-5">
    <div class="w-50">
      <label for="name" class="form-label">チーム名</label>
      <input type="text" id="name" name="name" class="form-control" placeholder="チーム名を入力">
    </div>
    <div class="w-50 mt-4">
      <label for="description">説明</label>
      <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="チームの説明"></textarea>
    </div>
    <div class="w-50 mt-4">
      <label for="email" class="form-label">ユーザー招待</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="招待するユーザーのメールアドレスを入力">
    </div>
    <div class="mt-2">
      <button type="button" class="btn btn-success py-0 px-1">
        <img src="https://icongr.am/material/plus.svg?size=30&color=ffffff" alt="招待メンバー追加">
      </button>
    </div>
  </form>
</div>
@endsection