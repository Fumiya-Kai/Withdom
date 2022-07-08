@extends('common.user')

@section('content')
<div class="container mt-5 py-5">
  <div class="row">
    <div class="col-2 offset-10">
      <a href="{{ route('article.edit', $article->id) }}" class="btn btn-warning w-75">編集</a>
      <a href="{{ route('team.show', $article->team_id) }}" class="btn btn-secondary w-75">チームページへ</a>
    </div>
  </div>
  <div class="card mt-3">
    <h1 class="display-3">{{ $article->title }}</h1>
    <p class="h1 text-secondary">{{ $article->abstract }}</p>
    <div class="article-content h3 mt-5">
      {{ $article->content }}
    </div>
  </div>
</div>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/darcula.min.css">
<script type="text/javascript" defer
    src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML">
</script>
<script src="{{ mix('js/article.js') }}"></script>

@endsection