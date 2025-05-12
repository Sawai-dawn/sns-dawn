@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<div class="container">
    <div class="row justify-content-center text-center">

        <div class="col-md-3">
                <img src="{{ asset('images/main_logo.png') }}" alt="ロゴ画像" class="LogoImage">
            <div class="card">
                <div class="card-header">{{ __('新規ユーザー登録') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3 text-center">
                            <div class="mx-auto" style="max-width: 300px; text-align: left;">
                                <label for="name" class="col-form-label text-start d-block">{{ __('UserName') }}</label>

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <div class="mx-auto" style="max-width: 300px; text-align: left;">
                                <label for="email" class="col-form-label text-start d-block">{{ __('MailAddress') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value=" {{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <div class="mx-auto" style="max-width: 300px; text-align: left;">
                                <label for="password" class="col-form-label text-start d-block">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <div class="mx-auto" style="max-width: 300px; text-align: left;">
                                <label for="password-confirm" class="col-form-label text-start d-block">{{ __('Password Confirm') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-0">
                            <div class="col-md-auto offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('REGISTER') }}
                                </button>
                            </div>

                            @if (Route::has('login'))
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        {{ __('ログイン画面へ戻る') }}
                                    </a>
                                @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
