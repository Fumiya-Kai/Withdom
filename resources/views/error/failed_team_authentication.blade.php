@extends('common.user')

@section('content')
<div class="container mt-5 pt-5">
  <div class="row">
    <img src="https://icongr.am/material/alert.svg?color=ffc107" style="height: 50px;" alt="アラートアイコン">
  </div>
  <div class="row justify-content-center h3">
    チームの認証に失敗しました。チームIDに間違いがあります。
  </div>
  <div class="row mt-4">
    <div class="w-auto offset-md-9 offset-7">
      <a href="{{ route('mypage') }}" class="btn btn-secondary">マイページへ</a>
    </div>
  </div>
</div>
@endsection