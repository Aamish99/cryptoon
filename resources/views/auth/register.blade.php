@extends('layouts.app')
@section('title',  __('Register'))
@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">{{ __('Register')}}</li>
            </ol>
            <h1>{{ __('Register')}}</h1>
            <p>@lang('lang.register_page_description')</p>
        </div>
    </div>
    <br>
<div class="container">
    <div class="row text">
        <div class="col-md-6 col-md-offset-3">
            <h2 class="text-center">{{ __('Register') }}</h2>
            <br>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                @if(setting('captcha_status') == 'on' && setting('site_key') != null)
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{{setting('site_key')}}"></div>
                        <script src='https://www.google.com/recaptcha/api.js'></script>
                    </div>
                    @error('g-recaptcha-response')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                @endif

                <div class="form-group row mb-0">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary auth_action">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <p>@lang('lang.already_have_an_account')? <a href="{{url('login')}}">@lang('lang.login_here')</a></p>
            <br>
        </div>
    </div>
</div>
@endsection
