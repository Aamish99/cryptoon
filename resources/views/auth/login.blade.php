@extends('layouts.app')
@section('title', __('Login'))
@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">{{__('Login')}}</li>
            </ol>
            <h1>{{__('Login')}}</h1>
            <p>@lang('lang.login_page_description')</p>
        </div>
    </div>
    <br>

    <div class="container">
        <div class="row text">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="text-center">{{ __('Login') }}</h2>
                <br>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class=>{{ __('E-mail Address') }}</label>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <p class="invalid-feedback" role="alert">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="">{{ __('Password') }}</label>

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <p class="invalid-feedback" role="alert">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="col-md-6 offset-md-4 text-right">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        @endif
                    </div>

                    @if(setting('captcha_status') == 'on' && setting('site_key') != null)
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="{{setting('site_key')}}"></div>
                            <script src='https://www.google.com/recaptcha/api.js'></script>
                        </div>
                        @error('g-recaptcha-response')
                        <p class="invalid-feedback" role="alert">
                            {{ $message }}
                        </p>
                        @enderror
                    @endif

                    <div class="form-group row mb-0">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary auth_action">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
                <br>
                <p>@lang('lang.dont_have_an_account')? <a href="{{url('register')}}">@lang('lang.register_here')</a></p>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection
