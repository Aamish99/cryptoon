@extends('layouts.app')
@section('title', __('lang.alerts'))
@section('description' , setting('description'))
@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">@lang('lang.alerts')</li>
            </ol>
            <h1>@lang('lang.alerts')</h1>
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
                <h3>@lang('lang.alerts')</h3>
                <div class="profile_page">
                    <div class="alert alert-success delete-alert d_none" role="alert">
                       Alert deleted
                    </div>

                    <div class="table-responsive">
                        <table class="table card-table pro-table">
                            <thead>
                            <tr>
                                <th>@lang('lang.coin')</th>
                                <th>@lang('lang.price')</th>
                                <th>@lang('lang.total_alert_sent')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($alerts as $item)
                                <tr id="{{$item->id}}">
                                    <td>
                                        @if (file_exists('assets/img/icon_set/' . $item->coin .'.png'))
                                            <img src="{{asset('assets/img/icon_set')}}/{{$item->coin}}.png" alt="{{$item->coin}}">
                                        @else
                                            <img src="{{asset('assets/img/icon_set')}}/default.png" alt="{{$item->coin}}">
                                        @endif
                                        {{$item->coin}}
                                    </td>
                                    <td>${{$item->price_alert}}</td>
                                    <td>{{$item->total_alerts}}</td>
                                    <td>
                                        <button data-toggle="tooltip" title="delete" class="btn btn-danger btn-sm delete_review_p" value="{{$item->id}}"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="delete-alert-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title">@lang('lang.delete_alert')</h3>

                </div>
                <div class="modal-body">
                    <p>
                        @lang('lang.delete_confirmation')
                    </p>
                </div>

                <div class="modal-footer ">
                    <button class="btn btn-default" data-dismiss="modal"> @lang('lang.cancel')</button>
                    <button class="btn btn-primary btn-delete-alert">@lang('lang.delete')</button>
                </div>
            </div>
        </div>
    </div>
@endsection


