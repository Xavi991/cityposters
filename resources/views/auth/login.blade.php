@extends('layouts.app')

@section('content')
<div class="container login-container mb-3">
    <div class="login-box">

        <div class="login-icon">
            <img src="{{ asset('img/profile.png') }}">
        </div>

        <form method="POST" action="{{ route('login') }}">
                @csrf

            <div class="form-group">
                <label for="user" style="color:#FFF">{{ __('User Name') }}</label>
                <input id="user" type="user" class="form-control @error('user') is-invalid @enderror" name="user" value="{{ old('user') }}" required autocomplete="user" autofocus>

                    @error('user')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="form-group">
                <label for="password" style="color:#FFF">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <div class="login-btn-container">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Login') }}
                    </button>
                </div>

            </div>

        </form>

    </div>
</div>
@endsection
