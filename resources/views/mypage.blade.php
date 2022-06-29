@extends('common.user')

@section('content')
<div class="container mt-5 py-5">
  <div class="row pb-3 border-bottom border-dark">
    <img src="https://icongr.am/fontawesome/user-circle.svg?size=140&color=70e6a9" class="w-auto" alt="ユーザーアイコン">
    <div class="col d-flex align-items-center display-3">{{ Auth::user()->name }}</div>
    <div class="col-4 d-flex align-items-end">
      <a href="{{ route('team.create') }}" type="button" class="btn btn-warning btn-lg">チーム作成</a>
    </div>
  </div>
  <div class="row mt-5">
    <div class="h1">チーム</div>
  </div>
  <div class="row row-cols-1 row-cols-md-4 mb-4">
    @if($teams)
    @foreach($teams as $team)
    <div class="col mb-4">
      <div class="card p-3">
        <a href="{{ route('team.show', $team->id) }}" class="text-reset text-decoration-none">
          <div class="row">
            <div class="col-3 text-center">
              <img src="https://icongr.am/material/account-group.svg?size=65&color=8f8f8f" class="w-auto" alt="チームアイコン">
            </div>
            <div class="col-9">
              <div class="h2 d-flex align-items-center m-0 border-bottom">{{ $team->name }}</div>
              <div>{{ Str::limit($team->description, 30) }}</div>
            </div>
          </div>
        </a>
      </div>
    </div>
    @endforeach
    @else
    <div class="card">
      <div class="card-body">
        参加しているチームがありません
      </div>
    </div>
    @endif
  </div>
  <div class="row">
    <div class="h1">記事</div>
  </div>
  <div class="row row-cols-1 row-cols-md-5">
    @if($articles)
    @foreach($articles as $article)
    <div class="col-1 mb-4">
      <div class="card pt-4">
        <a href="{{ route('article.show', $article->id) }}" class="text-reset text-decoration-none">
          <div class="d-flex align-items-center justify-content-center mb-3">
            @if(!!($article->categories->first()->image))
            <img src="{{ $article->categories->first()->image }}" class="w-auto" alt="記事アイコン">
            @else
            <img src="https://icongr.am/fontawesome/book.svg?size=100" class="w-auto" alt="記事アイコン">
            @endif
          </div>
          <div class="card-body">
            <div class="card-title h2 border-bottom">{{ Str::limit($article->title, 15) }}</div>
            <p class="card-text mb-1">{{ Str::limit($article->abstract, 60) }}</p>
            <div>
              @foreach($article->categories as $category)
              <span class="w-auto badge rounded-pill bg-secondary bg-opacity-25 text-dark">{{ $category->name }}</span>
              @endforeach
            </div>
          </div>
        </a>
      </div>
    </div>
    @endforeach
    @else
    <div class="card">
      <div class="card-body">
        書いた記事がありません
      </div>
    </div>
    @endif
  </div>
</div>
@endsection