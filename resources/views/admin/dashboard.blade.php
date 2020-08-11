@extends('layouts.admin')
@section('title', __('lang.admin'))
@section('content')
    <br>
    <div class="container-fluid dashboard">
        <h2>@lang('lang.dashboard')</h2>
        <div class="row">
            <div class="col-12 col-lg-6 col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">
                                    @lang('lang.total_users')
                                </h6>
                                <p class="h2 mb-0">
                                    {{$users}}
                                </p>
                            </div>
                            <div class="col-auto">
                                <span class="h2 fe fe-user-check text-muted mb-0"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h6 class="card-title text-uppercase text-muted mb-2">
                                      @lang('lang.total_exchanges')
                                </h6>
                                <p class="h2 mb-0">
                                    {{$exchanges}}
                                </p>
                            </div>
                            <div class="col-auto">
                                <span class="h2 fe fe-trending-up text-muted mb-0"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">
                                    @lang('lang.coins')
                                </h6>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-auto">
                                        <p class="h2 mr-2 mb-0">
                                            {{$coins}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <span class="h2 fe fe-octagon text-muted mb-0"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">
                                     @lang('lang.reviews')
                                </h6>
                                <p class="h2 mb-0">
                                    {{$reviews}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-header-title">
                                      @lang('lang.latest_users')
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.email')</th>
                                    <th>@lang('lang.role')</th>
                                    <th>@lang('lang.avatar')</th>
                                </tr>
                                </thead>
                                <tbody class="list">

                                @foreach($list_users as $item)
                                    <tr id="{{$item->id}}">
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>
                                            @if($item->role == 1)
                                                <div class="badge badge-success">Admin</div>
                                            @else
                                                <div class="badge badge-primary">User</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if (file_exists('uploads/'.$item->avatar) && !empty($item->avatar))
                                                <img height="25" src="{{asset('uploads')}}/{{$item->avatar}}" alt="{{$item->name}}">
                                            @else
                                                <img height="25" src="{{asset('assets/img')}}/default-avatar.png" alt="{{$item->name}}">
                                            @endif
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
    </div>
@endsection
