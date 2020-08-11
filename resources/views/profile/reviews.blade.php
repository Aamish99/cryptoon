@extends('layouts.app')
@section('title', __('lang.reviews'))
@section('description' , setting('description'))
@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">@lang('lang.reviews')</li>
            </ol>
            <h1>@lang('lang.reviews')</h1>
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
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
            <div class="col-sm-8">
                <h3>@lang('lang.reviews')</h3>
                <div class="profile_page">


                    <div class="alert alert-success delete-alert" role="alert">
                        Review deleted
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-striped pro-table">
                            <thead>
                            <tr>
                                <th>@lang('lang.exchange')</th>
                                <th>@lang('lang.coin')</th>
                                <th>@lang('lang.review')</th>
                                <th>@lang('lang.added_on')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($reviews as $item)
                                <tr id="{{$item->id}}">
                                    <td>
                                        @if(isset($item->exchange->name))
                                            {{$item->exchange->name}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($item->coin->name))
                                            {{$item->coin->name}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ substr($item->review,0, 30)}}...</td>
                                    <td>
                                        @if(!empty($item->created_at))
                                            {{$item->created_at->format('d-M-Y h:i:s')}}
                                        @endif
                                    </td>
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


    <div class="modal fade" id="delete-review-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title">@lang('lang.delete')</h3>

                </div>
                <div class="modal-body">
                    <p>
                        @lang('lang.delete_confirmation')
                    </p>
                </div>

                <div class="modal-footer ">
                    <button class="btn btn-default" data-dismiss="modal"> @lang('lang.cancel')</button>
                    <button class="btn btn-primary btn-delete-review">@lang('lang.delete')</button>
                </div>
            </div>
        </div>
    </div>
@endsection


