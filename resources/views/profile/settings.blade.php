@extends('layouts.app')
@section('title', __('lang.settings'))
@section('description' , setting('description'))
@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">@lang('lang.settings')</li>
            </ol>
            <h1>@lang('lang.settings')</h1>
        </div>
    </div>
    <br>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="profile_links">
                    <ul class="list-unstyled">
                        <li>
                            <a class="{{ (request()->is('profile')) ? 'active' : '' }} " href="{{url('profile')}}"><i class="fas fa-user"></i> @lang('lang.general')</a>
                        </li>
                        <li>
                            <a class="{{ (request()->is('profile/alerts')) ? 'active' : '' }}" href="{{url('profile/alerts')}}"><i class="fas fa-bell"></i> @lang('lang.alerts')</a>
                        </li>
                        <li>
                            <a class="{{ (request()->is('profile/reviews')) ? 'active' : '' }}" href="{{url('profile/reviews')}}" ><i class="fas fa-book"></i> @lang('lang.reviews')</a>
                        </li>
                        <li>
                            <a class="{{ (request()->is('profile/settings')) ? 'active' : '' }}" href="{{url('profile/settings')}}"><i class="fas fa-tools"></i> @lang('lang.settings')</a>
                        </li>
                        <li>
                            <a  onclick="event.preventDefault();
     document.getElementById('logout-form').submit();" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> @lang('lang.logout')</a>
                        </li>
                        <form id="logout-form" class="d_none" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
            <div class="col-sm-8">
                <h3>@lang('lang.settings')</h3>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->all())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br>
                        @endforeach
                    </div>
                    <br>
                @endif
                <div class="profile_page">
                    <form action="{{url('profile/settings')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">@lang('lang.name')*</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $user->name }}" autocomplete="name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">@lang('lang.email_address')*</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') ?? $user->email }}" required>
                                </div>
                            </div>
                        </div>

                        @if (file_exists('uploads/'.$user->avatar) && !empty($user->avatar))
                            <br>
                            <img class="img_ico_xl img-thumbnail" src="{{asset('uploads')}}/{{$user->avatar}}" alt="{{$user->name}}">
                            <br>
                            <br>
                        @endif
                        <div class="form-group">
                            <label>@lang('lang.avatar')</label>
                            <input type="file" class="form-control" name="avatar" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <hr>
                        <h3>@lang('lang.change_password')</h3>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password">@lang('lang.password')</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password-confirm">@lang('lang.confirm_password')</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">@lang('lang.submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


