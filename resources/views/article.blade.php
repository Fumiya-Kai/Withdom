@extends('common.user')

@section('content')
<div class="article container mt-5 pt-5">
  {{ $article->content }}
</div>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/darcula.min.css">
<script type="text/javascript" async
    src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML">
</script>
<script src="{{ mix('js/article.js') }}"></script>

@endsection