@extends('common.user')

@section('content')
<div class="container mt-5 pt-5">
  <div class="row">
    <div class="display-6">チーム作成</div>
  </div>
  <form action="{{ route('team.store') }}" method="post" class="mt-5">
    @csrf
    <div class="w-50">
      <label for="name" class="form-label h5">チーム名</label>
      <input type="text" id="name" name="name" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="チーム名を入力">
      <span class="invalid-feedback">{{ $errors->first('name') }}</span>
    </div>
    <div class="w-50 mt-4">
      <label for="description" class="form-label h5">説明</label>
      <textarea name="description" id="description" cols="30" rows="10" class="form-control @if($errors->has('description')) is-invalid @endif" placeholder="チームの説明"></textarea>
      <span class="invalid-feedback">{{ $errors->first('description') }}</span>
    </div>
    <div class="first-members w-50 mt-4">
      <label for="email" class="form-label h5">ユーザー招待</label>
      <input type="email" id="email" name="emails[0]" class="form-control @if($errors->has('emails')) is-invalid @endif" placeholder="招待するユーザーのメールアドレスを入力">
      <span class="invalid-feedback">{{ $errors->first('emails') }}</span>
    </div>
    <div class="mt-2">
      <button type="button" class="btn-add-form btn btn-success py-0 px-1">
        <img src="https://icongr.am/material/plus.svg?size=30&color=ffffff" alt="招待メンバー追加">
      </button>
    </div>
    <div class="row mt-3">
      <button class="submit btn btn-warning col-1 offset-5">作成</button>
    </div>
  </form>
</div>
<script src="{{ mix('js/addForm.js') }}"></script>
@endsection