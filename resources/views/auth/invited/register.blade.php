@extends('common.user')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">新規登録</div>

                <div class="card-body">
                    {{ Form::open(['route' => 'register', 'method' => 'POST']) }}
                        <div class="row mb-3">
                            {{ Form::label('name', '名前', ['class' => 'col-md-4 col-form-label text-md-end']) }}

                            <div class="col-md-6">
                                {{ Form::text('name',
                                                old('name'),
                                                $errors->has('name') ? ['class' => 'form-control is-invalid', 'id' => 'name', 'autocomplete' => 'name', 'required' => true, 'autofocus' => true]
                                                                     : ['class' => 'form-control', 'id' => 'name', 'autocomplete' => 'name', 'required' => true, 'autofocus' => true])
                                }}

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{ Form::label('email', 'メールアドレス', ['class' => 'col-md-4 col-form-label text-md-end']) }}

                            <div class="col-md-6">
                                {{ Form::email('email',
                                                old('email'),
                                                $errors->has('email') ? ['class' => 'form-control is-invalid', 'id' => 'email', 'autocomplete' => 'email', 'required' => true]
                                                                      : ['class' => 'form-control', 'id' => 'email', 'autocomplete' => 'email', 'required' => true])
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
                                                  $errors->has('password') ? ['class' => 'form-control is-invalid', 'id' => 'password', 'autocomplete' => 'new-password', 'required' => true]
                                                                           : ['class' => 'form-control', 'id' => 'password', 'autocomplete' => 'new-password', 'required' => true])
                                }}

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{ Form::label('password-confirm', 'パスワード確認', ['class' => 'col-md-4 col-form-label text-md-end']) }}

                            <div class="col-md-6">
                                {{ Form::password('password_confirmation',
                                                  $errors->has('password_confirmation') ? ['class' => 'form-control is-invalid', 'id' => 'password-confirm', 'autocomplete' => 'new-password', 'required' => true]
                                                                                        : ['class' => 'form-control', 'id' => 'password-confirm', 'autocomplete' => 'new-password', 'required' => true])
                                }}
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {{ Form::submit('新規登録', ['class' => 'submit btn btn-primary']) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
