@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<div class="container">
    <div class="row justify-content-center text-center">
    <div class="md-8 text-center">
        <img src="{{ asset('images/main_logo.png') }}" alt="ロゴ画像" class="LoginLogoImage">
        <label for="LoginText" class="col-form-label d-block" style="color: #FFFFFF; font-size: 45px; margin-bottom: 60px;">{{ __('Social Network Service') }}</label>
    </div>

    <div class="col-md-4">
        <div class="card">
                <div class="card-header">{{ __('DAWNのSNSへようこそ') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

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

                        <div class="mb-0 text-center">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('LOGIN') }}
                                </button>
                            </div>

                                @if (Route::has('register'))
                                    <a class="btn btn-link" href="{{ route('register') }}">
                                        {{ __('新規ユーザーの方はこちら') }}
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
