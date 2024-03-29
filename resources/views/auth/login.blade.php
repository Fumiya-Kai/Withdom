@extends('common.user')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ログイン</div>

                <div class="card-body">
                    {{ Form::open(['route' => 'login', 'method' => 'POST']) }}

                        <div class="row mb-3">
                            {{ Form::label('email', 'メールアドレス', ['class' => 'col-md-4 col-form-label text-md-end']) }}

                            <div class="col-md-6">
                                {{ Form::email('email',
                                                old('email'),
                                                $errors->has('email') ? ['class' => 'form-control is-invalid', 'id' => 'email', 'autocomplete' => 'email', 'required' => true, 'autofocus' => true]
                                                                      : ['class' => 'form-control', 'id' => 'email', 'autocomplete' => 'email', 'required' => true, 'autofocus' => true])
                                }}

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{ Form::label('password', 'パスワード', ['class' => 'col-md-4 col-form-label text-md-end']) }}

                            <div class="col-md-6">
                                {{ Form::password('password',
                                                  $errors->has('password') ? ['class' => 'form-control is-invalid', 'id' => 'password', 'autocomplete' => 'current-password', 'required' => true]
                                                                           : ['class' => 'form-control', 'id' => 'password', 'autocomplete' => 'current-password', 'required' => true])
                                }}

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    {{ Form::checkbox('remember', null, !!old('remember'), ['class' => 'form-check-input', 'id' => 'remember'])}}
                                    {{ Form::label('remember', '入力内容を保存する', ['class' => 'form-check-label']) }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {{ Form::submit('ログイン', ['class' => 'submit btn btn-primary']) }}

                                <a href="{{ route('login.guest') }}" class="btn btn-outline-dark ms-4">ゲストログイン</a>
                            </div>
                            <div class="col-md-8 offset-md-4">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link py-2 px-0" href="{{ route('password.request') }}">
                                    パスワードを忘れた
                                </a>
                                @endif
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
