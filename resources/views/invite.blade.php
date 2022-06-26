@extends('common.user')

@section('content')
<div class="container mt-5 pt-5">
  <div class="row">
    <div class="display-6">メンバー招待</div>
  </div>
  {{ Form::open(['route' => 'invite.mail', 'method' => 'POST', 'class' => 'tm-5']) }}
    {{ Form::token() }}
    <div class="add-members w-50 mt-4">
      {{ Form::label('email', 'ユーザー招待', ['class' => 'form-label h5']) }}
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
    </div>
    <div class="mt-2">
      {{ Form::button('<img src="https://icongr.am/material/plus.svg?size=30&color=ffffff" alt="招待メンバー追加">',
                      ['class' => 'btn-add-form btn btn-success py-0 px-1'])
      }}
    </div>
    <div class="row mt-3">
      <a href="{{ route('team.show', $teamId) }}" class="btn btn-secondary col-1 offset-5">戻る</a>
      {{ Form::submit('招待', ['class' => 'submit btn btn-warning col-1 ms-3']) }}
    </div>
  {{ Form::close() }}
</div>
<script src="{{ mix('js/addForm.js') }}"></script>
@endsection