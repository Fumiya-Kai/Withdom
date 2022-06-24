@extends('common.user')

@section('content')
<div class="container mt-5 pt-5">
  <div class="row">
    <div class="display-6">記事作成</div>
  </div>
  <form action="{{ route('article.store') }}" method="post" class="mt-5">
    @csrf
    <div class="w-50">
      <label for="category" class="form-label h5">カテゴリー</label>
      <div class="category-form form-control text-secondary @if($errors->has('categories') or $errors->has('new-categories')) is-invalid @endif" style="cursor: text;">
        <input type="text" class="category-input border-0" style="background-color: rgba(0,0,0,0); outline: none;">
      </div>
      <span class="invalid-feedback">{{ $errors->first('categories') }}</span>
      <span class="invalid-feedback">{{ $errors->first('new-categories') }}</span>
      <ul class="category-list list-group rounded-0" style="display: none; position: absolute; height: 300px; overflow-y: scroll;">
        @foreach($categories as $category)
        <li class="category-item list-group-item">
          <input class="category-checkbox form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" data-name="{{ $category->name }}" aria-label="...">
          <span class="category-name" id="category-name-{{ $category->name }}">{{ $category->name }}</span>
        </li>
        @endforeach
      </ul>
    </div>
    <div class="w-50 mt-4">
      <label for="title" class="form-label h5">タイトル</label>
      <input type="text" id="title" name="title" class="form-control @if($errors->has('title')) is-invalid @endif" placeholder="記事のタイトルを入力">
      <span class="invalid-feedback">{{ $errors->first('title') }}</span>
    </div>
    <div class="w-50 mt-4">
      <label for="abstract" class="form-label h5">要約</label>
      <input type="text" id="abstract" name="abstract" class="form-control @if($errors->has('abstract')) is-invalid @endif" placeholder="記事の要約を入力">
      <span class="invalid-feedback">{{ $errors->first('abstract') }}</span>
    </div>
    <div class="w-75 mt-4">
      <label for="content" class="form-label h5">本文</label>
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a href="#editor" class="nav-link active" data-tab-id="#editor" data-bs-toggle="tab">マークダウン</a>
        </li>
        <li class="nav-item">
          <a href="#preview" class="nav-link" data-tab-id="#preview"data-bs-toggle="tab">プレビュー</a>
        </li>
      </ul>
      <div class="tab-content">
        <div id="editor" class="tab-pane active">
          <textarea name="content" id="content" class="article-content form-control border-top-0 rounded-0 @if($errors->has('content')) is-invalid @endif" style="min-height: 300px;"></textarea>
          <span class="invalid-feedback">{{ $errors->first('content') }}</span>
        </div>
        <div id="preview" class="preview tab-pane">
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <button type="submit" class="submit btn btn-warning col-1 offset-5">作成</button>
    </div>
  </form>
</div>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/darcula.min.css">
<script type="text/javascript" async
    src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML">
</script>
<script src="{{ mix('js/comboBox.js') }}"></script>
<script src="{{ mix('js/editor.js') }}"></script>

@endsection