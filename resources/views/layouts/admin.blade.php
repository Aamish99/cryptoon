<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin Panel.">
    <!-- Libs CSS -->
    <title>@yield('title') | @lang('lang.dashboard')</title>
    <link rel="stylesheet" href="{{asset('assets/fonts/feather/feather.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/datatable/dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/theme-dark.min.css')}}" id="stylesheetDark">
    <link rel="stylesheet" href="{{asset('assets/libs/toast/jquery.toast.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/theme.min.css')}}" id="stylesheetLight">
    <link rel="icon" href="{{asset('assets/img/fav.png')}}" type="image/x-icon"/>
    @yield('style')
    <script>
    var url = '{{url('')}}';
    var token = '{{csrf_token()}}';
    </script>
<body>


<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light" id="sidebar">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand sidebar-logo" href="{{url('/admin/dashboard')}}">
            Panel Admin
        </a>

        <div class="navbar-user d-md-none">
            <div class="dropdown">
                <a href="#" id="sidebarIcon" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-sm avatar-online">
                        @if (file_exists('uploads/'.Auth::user()->avatar) && !empty(Auth::user()->avatar))
                            <img class="avatar-img rounded-circle" src="{{asset('uploads')}}/{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}">
                        @endif

                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ url('admin/profile') }}">Profile </a>
                    <hr class="m-1">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" class="d_none" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/dashboard')}}">
                        <i class="fe fe-square"></i>@lang('lang.dashboard')
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/coins')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/coins')}}">
                        <i class="fe fe-octagon"></i>@lang('lang.coins')
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/exchanges')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/exchanges')}}">
                        <i class="fe fe-trending-up"></i>@lang('lang.exchanges')
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/alerts')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/alerts')}}">
                        <i class="fe fe-bell"></i> @lang('lang.alerts')
                        <span class="badge badge-primary ml-auto">{{\App\Models\Alert::count()}}</span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/blog')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/blog')}}">
                        <i class="fe fe-clipboard"></i>@lang('lang.blog')
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/reviews')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/reviews')}}">
                        <i class="fe fe-file-text"></i>@lang('lang.reviews')
                        <span class="badge badge-primary ml-auto">{{\App\Models\Review::count()}}</span>
                    </a>
                </li>

                <li class="nav-item {{ (request()->is('admin/deals')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/deals')}}">
                        <i class="fe fe-disc"></i> Deals
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/pages')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/pages')}}">
                        <i class="fe fe-book-open"></i>@lang('lang.pages')
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/subscribers')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/subscribers')}}">
                        <i class="fe fe-rss"></i>@lang('lang.subscribers')
                        <span class="badge badge-primary ml-auto">{{\App\Models\Subscriber::count()}}</span>
                    </a>
                </li>

                <li>
                    <hr class="navbar-divider my-3">
                </li>

                <li class="nav-item {{ (request()->is('admin/users')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/users')}}">
                        <i class="fe fe-user"></i>@lang('lang.users')
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#sidebarSetting" data-toggle="collapse" {{ (request()->is('admin/settings/general')) ? 'aria-expanded="true"' : '' }}  {{ (request()->is('admin/settings/language')) ? 'aria-expanded="true"' : '' }}>
                        <i class="fe fe-file"></i>@lang('lang.settings')
                    </a>
                    <div class="collapse {{ (request()->is('admin/settings/general')) ? 'show' : '' }}" id="sidebarSetting">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->is('admin/settings/general')) ? 'active' : '' }}" href="{{url('admin/settings/general')}}">
                                    @lang('lang.general_settings')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->is('admin/settings/language')) ? 'active' : '' }}" href="{{url('admin/settings/language')}}">
                                  @lang('lang.language_settings')
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ (request()->is('admin/profile')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('admin/profile')}}">
                        <i class="fe fe-user-check"></i>@lang('lang.profile')
                    </a>
                </li>

                <li class="nav-item {{ (request()->is('admin/logout')) ? 'active' : '' }}">
                    <a class="nav-link"  href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                        <i class="fe fe-log-out"></i> @lang('lang.logout')
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<nav class="d_none navbar navbar-vertical navbar-vertical-sm fixed-left navbar-expand-md " id="sidebarSmall"></nav>
<div class="main-content">
    <nav class="navbar navbar-expand-md navbar-light d-none d-md-flex" id="topbar">
        <div class="container-fluid">
            <!-- Form -->
            <form class="form-inline mr-4 d-none d-md-flex"></form>
            <!-- User -->
            <div class="navbar-user">
                <a href="{{url('')}}" target="_blank" class="avatar avatar-sm white-color e_link">
                   <i class="fe fe-external-link"></i>
                </a>
                <div class="dropdown">
                    <a href="#" class="avatar avatar-sm avatar-online dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (file_exists('uploads/'.Auth::user()->avatar) && !empty(Auth::user()->avatar))
                            <img class="avatar-img rounded-circle" src="{{asset('uploads')}}/{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}">
                        @else
                            <img src="{{asset('assets/img')}}/default-avatar.png" alt="{{Auth::user()->name}}">
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ url('admin/profile') }}">Profile </a>
                        <hr class="m-1">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" class="d_none" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </nav>

    @yield('content')
    <br>
    <br>
    <br>

</div>

<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('assets/libs/datatable/dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/toast/jquery.toast.min.js')}}"></script>
<script src="{{asset('assets/js/theme.min.js')}}"></script>
<script src="{{asset('assets/js/custom.min.js')}}"></script>

@yield('script')

<script>

@if (session('status'))

$.toast({
  heading: 'Success',
  text: "{{ session('status') }}",
  showHideTransition: 'slide',
  position: 'top-right',
  icon: 'success'
})
@endif
@if (session('error'))

$.toast({
  heading: 'Error',
  text: "{{ session('error') }}",
  showHideTransition: 'slide',
  position: 'top-right',
  icon: 'error'
})
@endif
</script>


</body>
</html>
