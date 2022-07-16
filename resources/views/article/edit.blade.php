@extends('common.user')

@section('content')
<div class="container mt-5 py-5">
  <div class="row">
    <div class="display-6">記事作成</div>
  </div>
  {{ Form::open(['route' => ['article.update', $article->id], 'method' => 'PUT', 'class' => 'mt-5']) }}
    <div class="w-md-50">
      {{ Form::label('category', 'カテゴリー', ['class' => 'form-label h5']) }}
      @if(Auth::id() === 1)
      <div class="category-form form-control">
        @foreach ($article->categories as $category)
        <div class="added-category-badge badge rounded-pill bg-secondary bg-opacity-25 me-1 text-dark" id="category-badge-{{ $category->name }}">{{ $category->name }}</div>
        @endforeach
        {{ Form::button(null, ['class' => 'category-input border-0']) }}
      </div>
      <ul class="category-list list-group rounded-0">
        @foreach($categories as $category)
        <li class="category-item list-group-item">
          @if ($article->categories->pluck('id')->contains($category->id))
          {{ Form::checkbox('categories[]', $category->id, true, ['class' => 'category-checkbox form-check-input', 'data-name' => $category->name, 'id' => 'category-name-'. $loop->iteration]) }}
          @else
          {{ Form::checkbox('categories[]', $category->id, false, ['class' => 'category-checkbox form-check-input', 'data-name' => $category->name, 'id' => 'category-name-'. $loop->iteration]) }}
          @endif
          {{ Form::label('category-name-'. $loop->iteration, $category->name, ['class' => 'category-name', 'id' => 'category-name-'. $category->name]) }}
        </li>
        @endforeach
      </ul>
      @else
      <div class="category-form form-control text-secondary @if($errors->has('categories') or $errors->has('new-categories')) is-invalid @endif">
        @if(!!old('categories'))
        @foreach (old('categories') as $categoryId)
        <div class="added-category-badge badge rounded-pill bg-secondary bg-opacity-25 me-1 text-dark" id="category-badge-{{ \App\Models\Category::find($categoryId)->name }}">{{ \App\Models\Category::find($categoryId)->name }}</div>
        @endforeach
        @endif
        @if(!!old('new-categories'))
        @foreach (old('new-categories') as $newCategory)
        <div class="added-category-badge badge rounded-pill bg-secondary bg-opacity-25 me-1 text-dark" id="category-badge-{{ $newCategory }}">{{ $newCategory }}</div>
        <input name="new-categories[]" type="hidden" value="{{ $newCategory }}" id="hiddeninput{{ $newCategory }}">
        @endforeach
        @endif
        @if(!old('categories') && !old('new-categories'))
        @foreach ($article->categories as $category)
        <div class="added-category-badge badge rounded-pill bg-secondary bg-opacity-25 me-1 text-dark" id="category-badge-{{ $category->name }}">{{ $category->name }}</div>
        @endforeach
        @endif
        {{ Form::text(null, null, ['class' => 'category-input border-0']) }}
      </div>
      <span class="invalid-feedback">{{ $errors->first('categories') }}</span>
      <span class="invalid-feedback">{{ $errors->first('new-categories') }}</span>
      <ul class="category-list list-group rounded-0">
        @foreach($categories as $category)
        <li class="category-item list-group-item">
          @if ($article->categories->pluck('id')->contains($category->id))
          {{ Form::checkbox('categories[]', $category->id, true, ['class' => 'category-checkbox form-check-input', 'data-name' => $category->name, 'id' => 'category-name-'. $loop->iteration]) }}
          @else
          {{ Form::checkbox('categories[]', $category->id, false, ['class' => 'category-checkbox form-check-input', 'data-name' => $category->name, 'id' => 'category-name-'. $loop->iteration]) }}
          @endif
          {{ Form::label('category-name-'. $loop->iteration, $category->name, ['class' => 'category-name', 'id' => 'category-name-'. $category->name]) }}
        </li>
        @endforeach
      </ul>
      @endif
    </div>
    <div class="w-md-50 mt-4">
      {{ Form::label('title', 'タイトル', ['class' => 'form-label h5']) }}
      {{ Form::text('title',
                    $article->title,
                    $errors->has('title') ? ['class' => 'form-control is-invalid', 'id' => 'title', 'placeholder' => '記事のタイトルを入力']
                                          : ['class' => 'form-control', 'id' => 'title', 'placeholder' => '記事のタイトルを入力'])
      }}
      <span class="invalid-feedback">{{ $errors->first('title') }}</span>
    </div>
    <div class="w-md-50 mt-4">
      {{ Form::label('abstract', '要約', ['class' => 'form-label h5']) }}
      {{ Form::text('abstract',
                    $article->abstract,
                    $errors->has('abstract') ? ['class' => 'form-control is-invalid', 'id' => 'abstract', 'placeholder' => '記事の要約を入力']
                                             : ['class' => 'form-control', 'id' => 'abstract', 'placeholder' => '記事の要約を入力'])
      }}
      <span class="invalid-feedback">{{ $errors->first('abstract') }}</span>
    </div>
    <div class="w-md-75 mt-4">
      {{ Form::label('content', '本文', ['class' => 'form-label h5']) }}
      <button class="btn btn-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">? 書式</button>
      @component('components.format_offcanvas')
      @endcomponent
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
          {{ Form::textarea('content',
                            $article->content,
                            $errors->has('content') ? ['class' => 'article-content form-control border-top-0 rounded-0 is-invalid', 'id' => 'content', 'style' => 'min-height: 300px;']
                                                    : ['class' => 'article-content form-control border-top-0 rounded-0', 'id' => 'content', 'style' => 'min-height: 300px;'])
          }}
          <span class="invalid-feedback">{{ $errors->first('content') }}</span>
        </div>
        <div id="preview" class="preview tab-pane">
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <a href="{{ route('article.show', $article->id) }}" class="btn btn-secondary col-2 col-md-1 offset-7 offset-md-6">戻る</a>
      {{ Form::submit('更新', ['class' => 'submit btn btn-warning ms-3 col-2 col-md-1']) }}
    </div>
  {{ Form::close() }}
</div>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/darcula.min.css">
<script type="text/javascript" defer
    src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML">
</script>
<script src="{{ mix('js/comboBox.js') }}"></script>
<script src="{{ mix('js/editor.js') }}"></script>

@endsection