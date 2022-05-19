@extends('common.user')

@section('content')
<div class="container mt-5 pt-5">
  <div class="row">
    <div class="display-6">記事作成</div>
  </div>
  <form action="" method="post" class="mt-5">
    <div class="w-50">
      <label for="category" class="form-label h5">カテゴリー</label>
      <div class="category-form form-control text-secondary" style="cursor: text;">
        <input type="text" class="category-input border-0" style="background-color: rgba(0,0,0,0); outline: none;">
      </div>
      <ul class="category-list list-group rounded-0" style="display: none; position: fixed;">
        <li class="category-item list-group-item">
          <input class="category-checkbox form-check-input" type="checkbox" value="First checkbox" data-id="1" aria-label="...">
          First checkbox
        </li>
        <li class="category-item list-group-item">
          <input class="category-checkbox form-check-input" type="checkbox" value="Second checkbox" data-id="2" aria-label="...">
          Second checkbox
        </li>
        <li class="category-item list-group-item">
          <input class="category-checkbox form-check-input" type="checkbox" value="Third checkbox" data-id="3" aria-label="...">
          Third checkbox
        </li>
        <li class="category-item list-group-item">
          <input class="category-checkbox form-check-input" type="checkbox" value="Fourth checkbox" data-id="4" aria-label="...">
          Fourth checkbox
        </li>
        <li class="category-item list-group-item">
          <input class="category-checkbox form-check-input" type="checkbox" value="Fifth checkbox" data-id="5" aria-label="...">
          Fifth checkbox
        </li>
      </ul>
    </div>
    <div class="w-50 mt-4">
      <label for="title" class="form-label h5">タイトル</label>
      <input type="text" id="title" name="title" class="form-control" placeholder="記事のタイトルを入力">
    </div>
    <div class="w-50 mt-4">
      <label for="abstract" class="form-label h5">要約</label>
      <input type="text" id="abstract" name="abstract" class="form-control" placeholder="記事の要約を入力">
    </div>
    <div class="w-50 mt-4">
      <label for="content" class="form-label h5">本文</label>
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a href="#editor" class="nav-link active" data-bs-toggle="tab">マークダウン</a>
        </li>
        <li class="nav-item">
          <a href="#preview" class="nav-link" data-bs-toggle="tab">プレビュー</a>
        </li>
      </ul>
      <div class="tab-content">
        <div id="editor" class="tab-pane active">
          <textarea name="content" id="content" class="form-control border-top-0 rounded-0">コンテンツ1</textarea>
        </div>
        <div id="preview" class="tab-pane">
          <p>コンテンツ2</p>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <button type="submit" class="submit btn btn-warning col-1 offset-5">作成</button>
    </div>
  </form>
</div>
<style>
  .form-control:focus {
    box-shadow: none;
  }
</style>
@endsection