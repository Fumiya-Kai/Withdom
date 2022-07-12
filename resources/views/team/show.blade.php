@extends('common.user')

@section('content')
<div class="container mt-5 py-5">
  <div class="row pb-3 border-bottom border-dark">
    <img src="https://icongr.am/fontawesome/users.svg?size=140&color=5f5f5f" class="w-auto" alt="チームアイコン">
    <div class="col d-flex align-items-center display-3">{{ $team->name }}</div>
    <div class="col gap-3 d-flex align-items-end justify-content-end">
      <a href="@if(Auth::id() === 1)@else{{ route('invite.form') }}@endif" type="button" class="btn btn-warning btn-lg col-4 @if(Auth::id() === 1) disabled @endif">
        <img src="https://icongr.am/fontawesome/user-plus.svg?size=30&color=currentColor" alt="メンバー追加アイコン">
        メンバー招待
      </a>
      <a href="{{ route('article.create') }}" type="button" class="btn btn-warning btn-lg col-4">
        <img src="https://icongr.am/material/pencil-plus.svg?size=30&color=currentColor" alt="記事追加アイコン">
        記事作成
      </a>
    </div>
  </div>
  <div class="row mt-5">
    <div class="h1 col-5">メンバー</div>
  </div>
  <div class="row border-bottom mt-3">
    @foreach($team->users as $user)
    <div class="badge rounded-pill bg-secondary bg-opacity-25 w-auto text-dark py-2 px-3 mb-3 me-1">
      <img src="@if($user->avatar){{ $user->avatar }}@else https://icongr.am/fontawesome/user.svg?size=30&color=545454 @endif" class="w-auto" alt="ユーザーアイコン">
      <span class="h5">{{ $user->name }}</span>
    </div>
    @endforeach
  </div>
  <div class="row mt-5">
    <div class="h1">記事</div>
  </div>
  @if(Auth::id() === 1)
  <span class="text-danger">ゲストの記事は定期的に削除されます</span>
  @endif
  <div class="row row-cols-1 row-cols-md-5 mt-5">
    @if(! $articles->isEmpty())
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
            <div class="card-title h2 border-bottom">{{ Str::limit($article->title, 12) }}</div>
            <p class="card-text mb-1">{{ Str::limit($article->abstract, 60) }}</p>
            <div>
              @foreach($article->categories as $category)
              <span class="w-auto badge rounded-pill bg-secondary bg-opacity-25 text-dark">{{ $category->name}}</span>
              @endforeach
            </div>
          </div>
        </a>
      </div>
    </div>
    @endforeach
    @else
    <div class="card bg-info">
      <div class="card-body text-white">
        記事がありません
      </div>
    </div>
    @endif
  </div>
  <div class="row">
    {{ $articles->appends(request()->input())->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection