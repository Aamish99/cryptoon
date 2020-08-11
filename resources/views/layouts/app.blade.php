<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="{{setting('keywords')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{setting('site_title')}} </title>
    <link href="{{asset('css/fonts.min.css')}}" rel="stylesheet">
    <link rel="icon" href="{{asset('assets/img/fav.png')}}" type="image/x-icon"/>
    @yield('style')
    <link href="{{asset('css/style.min.css')}}" rel="stylesheet">
    <script>
    var url = '{{url('')}}';
    var token = '{{csrf_token()}}';
    </script>
</head>
<body>
<div id="app">
    <div class="head_bar">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button data-toggle="collapse" data-target="#navbar" class="navbar-toggle collapsed">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{url('/')}}" class="navbar-brand">
                        <img src="{{asset('assets/img')}}/{{setting('logo')}}" alt="logo">
                    </a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="{{(request()->is('coins')) ? 'active' : '' }}">
                            <a href="{{url('coins')}}">@lang('lang.coins')</a>
                        </li>
                        <li class="{{(request()->is('exchanges')) ? 'active' : '' }}">
                            <a href="{{url('exchanges')}}">@lang('lang.exchanges')</a>
                        </li>
                        <li class="{{(request()->is('compare/exchanges')) ? 'active' : '' }}">
                            <a href="{{url('compare/exchanges')}}">@lang('lang.compare')</a>
                        </li>
                        @if($deals->count())
                        <li class="{{(request()->is('deals')) ? 'active' : '' }}">
                            <a href="{{url('deals')}}">@lang('lang.deals')</a>
                        </li>
                        @endif
                        <li class="{{(request()->is('calculator')) ? 'active' : '' }}">
                            <a href="{{url('calculator')}}">@lang('lang.calculator')</a>
                        </li>
                        @if($blog->count())
                        <li class="{{(request()->is('blog')) ? 'active' : '' }}">
                            <a href="{{url('blog')}}">@lang('lang.blog')</a>
                        </li>
                        @endif
                        @foreach($header_pages as $page)
                            <li>
                                <a href="{{url('page/'.$page->slug)}}">{{ $page->title }}</a>
                            </li>
                        @endforeach
                        @if(Auth::guest())
                            <li class="dropdown">
                                <a href="javascrpt:;" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @lang('lang.account')
                                    <i class="fas fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="{{url('login')}}">@lang('lang.login')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('register')}}">@lang('lang.register')</a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="javascrpt:;" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Hi! {{Auth::user()->name}}
                                    <i class="fas fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    @if(Auth::user()->role == '1')
                                        <li>
                                            <a href="{{(url('admin/dashboard'))}}" class="drop-item">@lang('lang.admin_panel')</a>
                                        </li>
                                        <li class="divider"></li>
                                    @endif
                                    <li>
                                        <a href="{{(url('/profile'))}}" class="drop-item">@lang('lang.profile')</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" class="drop-item"
                                           onclick="event.preventDefault();
     document.getElementById('logout-form').submit();">
                                            @lang('lang.logout')</a>
                                    </li>
                                    <form id="logout-form" class="d_none" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                        @endif

                        @if($languages->count() > 1)
                            <li class="dropdown">
                                <a href="javascrpt:;" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if(Session::get('locale') == 'en')
                                        English
                                    @elseif(Session::get('locale') == 'it')
                                        Italian
                                    @else
                                        @lang('lang.language')
                                    @endif
                                    <i class="fas fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach($languages as $lang)
                                        <li>
                                            <a href="{{url('lang')}}/{{$lang->short_name}}">{{$lang->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="main">
            @yield('content')
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <img src="{{asset('assets/img')}}/{{setting('logo')}}" alt="logo" class="img-responsive logo"> <br>
                    <p>{{setting('description')}}</p>
                    <ul class="social">
                        @if(setting('facebook'))
                            <li>
                                <a target="_blank" href="{{setting('facebook')}}">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                        @endif
                        @if(setting('twitter'))
                            <li>
                                <a target="_blank" href="{{setting('twitter')}}">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                        @endif
                        @if(setting('linkedin'))
                            <li>
                                <a target="_blank" href="{{setting('linkedin')}}">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </li>
                        @endif
                        @if(setting('google_plus'))
                            <li>
                                <a target="_blank" href="{{setting('google_plus')}}">
                                    <i class="fab fa-google-plus"></i>
                                </a>
                            </li>
                        @endif
                        @if(setting('instagram'))
                            <li>
                                <a target="_blank" href="{{setting('instagram')}}">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="col-sm-3">
                    <h2>@lang('lang.pages')</h2>
                    <ul class="list-unstyled pages">
                        @foreach($footer_pages as $page)
                            <li><a href="{{url('page/'.$page->slug)}}">{{ $page->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h2>@lang('lang.subscribe')</h2>

                    <div class="subscribe_form">
                        <input type="text" name="email" id="email_input" placeholder="Enter Email" class="form-control">
                        <button id="subscribe_btn">@lang('lang.submit')</button>
                    </div>
                    <small id="sub_msg_success" class="text-center text-success"></small>
                    <small id="sub_msg_error" class="text-center text-danger"></small>
                </div>
            </div>
        </div>

        <div class="copyright_text">
        <div class="container">
            <p class="text-center">{{setting('copyright')}}</p>
        </div>
        </div>
    </footer>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{asset('assets/libs/slider/slider.min.js')}}"></script>
@yield('script')
<script src="{{ asset('js/script.js') }}"></script>

@if(setting('analytics') != null)
    {!! setting('analytics') !!}
@endif
</body>
</html>
