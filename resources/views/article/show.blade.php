@extends('common.user')

@section('content')
<div class="container mt-5 py-5">
  <div class="row">
    <div class="col-2 offset-10">
      <a href="{{ route('article.edit', $article->id) }}" class="btn btn-warning w-75">編集</a>
      <a href="{{ route('team.show', $article->team_id) }}" class="btn btn-secondary w-75">チームページへ</a>
    </div>
  </div>
  <div class="card mt-3 p-5">
    <h1 class="display-3">{{ $article->title }}</h1>
    <p class="h1 text-secondary">{{ $article->abstract }}</p>
    <div class="article-content h3 mt-5">{{ $article->content }}</div>
  </div>
  <div class="card p-5 mt-4">
    <h3 class="fs-3 fw-bold border-bottom">コメント</h3>
    <div class="w-auto mt-3">
      <img src="https://icongr.am/fontawesome/user.svg?size=30&color=70e6a9" class="w-auto" alt="ユーザーアイコン">
      <span class="h5">username</span>
      <div class="fs-4 mt-2 pb-3 border-bottom">{{ $article->abstract }}</div>
    </div>
    <div class="w-auto mt-3">
      <img src="https://icongr.am/fontawesome/user.svg?size=30&color=70e6a9" class="w-auto" alt="ユーザーアイコン">
      <span class="h5">username</span>
      <div class="fs-4 mt-2 pb-3 border-bottom">{{ $article->abstract }}</div>
    </div>
    {{ Form::open(['class' => 'comment-form mt-5']) }}
      {!! Form::label('comment', 'コメントする', ['class' => 'form-label fs-5']) !!}
      {{ Form::textarea('content',
                        null,
                        $errors->has('comment') ? ['class' => 'form-control is-invalid', 'id' => 'comment', 'placeholder' => 'コメントを入力してください']
                                                : ['class' => 'form-control', 'id' => 'comment', 'placeholder' => 'コメントを入力してください'])
      }}
      <div class="row mt-3">
        {{ Form::button('投稿', ['class' => 'comment-btn submit btn btn-warning offset-10 col-1', 'data-article-id' => $article->id]) }}
      </div>
    {{ Form::close() }}
  </div>
</div>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/darcula.min.css">
<script type="text/javascript" defer
    src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML">
</script>
<script src="{{ mix('js/article.js') }}"></script>

@endsection