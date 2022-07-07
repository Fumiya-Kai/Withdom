@extends('common.user')

@section('content')
<div class="container mt-5 py-5">
  <div class="row">
    <div class="display-6">チーム作成</div>
  </div>
  {{ Form::open(['route' => 'team.store', 'method' => 'POST', 'class' => 'mt-5']) }}
    <div class="w-50">
      {{ Form::label('name', 'チーム名', ['class' => 'form-label h5']) }}
      {{ Form::text('name',
                    old('name'),
                    $errors->has('name') ? ['class' => 'form-control is-invalid', 'id' => 'name', 'placeholder' => 'チーム名を入力']
                                         : ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'チーム名を入力'])
      }}
      <span class="invalid-feedback">{{ $errors->first('name') }}</span>
    </div>
    <div class="w-50 mt-4">
      {{ Form::label('description', '説明', ['class' => 'form-label h5']) }}
      {{ Form::textarea('description',
                        old('description'),
                        $errors->has('description') ? ['class' => 'form-control is-invalid', 'id' => 'content', 'placeholder' => 'チームの説明']
                                                    : ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'チームの説明'])
      }}
      <span class="invalid-feedback">{{ $errors->first('description') }}</span>
    </div>
    <div class="add-members w-50 mt-4">
      {{ Form::label('email', 'ユーザー招待', ['class' => 'form-label h5']) }}
      @if(Auth::id() === 1)
      <div class="row">
        <span class="text-danger">ゲストモードではご利用になれません</span>
      </div>
      {{ Form::email('emails[]',
                     null,
                     $errors->has('emails') ? ['class' => 'email-form form-control mt-2 is-invalid', 'id' => 'email0', 'placeholder' => '招待するユーザーのメールアドレスを入力', 'disabled' => true]
                                             : ['class' => 'email-form form-control mt-2', 'id' => 'email0', 'placeholder' => '招待するユーザーのメールアドレスを入力', 'disabled' => true])
      }}
      @else
      @if(!!old('emails'))
      @foreach(old('emails') as $email)
      {{ Form::email('emails[]',
                     $email,
                     $errors->has('emails') ? ['class' => 'email-form form-control mt-2 is-invalid', 'id' => 'email'. $loop->index, 'placeholder' => '招待するユーザーのメールアドレスを入力']
                                             : ['class' => 'email-form form-control mt-2', 'id' => 'email'. $loop->index, 'placeholder' => '招待するユーザーのメールアドレスを入力'])
      }}
      @endforeach
      @else
      {{ Form::email('emails[]',
                     null,
                     $errors->has('emails') ? ['class' => 'email-form form-control is-invalid', 'id' => 'email0', 'placeholder' => '招待するユーザーのメールアドレスを入力']
                                             : ['class' => 'email-form form-control', 'id' => 'email0', 'placeholder' => '招待するユーザーのメールアドレスを入力'])
      }}
      @endif
      <span class="invalid-feedback message-email">{{ $errors->first('emails') }}</span>
      @endif
    </div>
    <div class="mt-2">
      {{ Form::button('<img src="https://icongr.am/material/plus.svg?size=30&color=ffffff" alt="招待メンバー追加">',
                      ['class' => 'btn-add-form btn btn-success py-0 px-1'])
      }}
    </div>
    <div class="row mt-3">
      <a href="{{ route('mypage') }}" class="btn btn-secondary col-1 offset-4">戻る</a>
      {{ Form::submit('作成', ['class' => 'submit btn btn-warning col-1 ms-3']) }}
    </div>
  {{ Form::close() }}
</div>
<script src="{{ mix('js/addForm.js') }}"></script>
@endsection