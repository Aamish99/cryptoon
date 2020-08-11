@extends('layouts.app')
@section('title', __('lang.profile'))
@section('description' , setting('description'))
@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">@lang('lang.profile')</li>
            </ol>
            <h1>@lang('lang.profile')</h1>
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

                <div class="profile_page">
                    <div class="media">
                        <div class="media-left">
                            @if (file_exists('uploads/'.Auth::user()->avatar) && !empty(Auth::user()->avatar))
                                <img class="avatar-img" src="{{asset('uploads')}}/{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}">
                            @else
                                <img class="avatar-img mr-3" src="{{asset('assets/img')}}/default-avatar.png" alt="{{Auth::user()->name}}">
                            @endif
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{Auth::user()->name}}</h4>
                            {{Auth::user()->email}}
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection


