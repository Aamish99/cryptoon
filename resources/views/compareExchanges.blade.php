@extends('layouts.app')
@section('title', __('lang.compare_exchanges'))
@section('description' , setting('description'))

@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
             <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">@lang('lang.compare')</li>
                <li class="active">@lang('lang.exchanges')</li>
            </ol>
            <h1>@lang('lang.compare_exchanges')</h1>
            <a href="{{url('compare/cryptocurrencies')}}" class="btn btn-primary">@lang('lang.compare_cryptocurrencies') <i class="fas fa-arrow-right"></i></a>
            <br>
            <br>
            <br>
        </div>
    </div>
    <div class="ex_section">
        <div class="container">
            <div class="row">
                @php($count = 1)
                @foreach($cp_exchanges as $item)
                    @if(!empty($item))
                        <div class="col-sm-3">
                            <div class="expc_box compare">
                                <div class="clearfix"></div>
                                <div class="logo_container">
                                    <p>{{$item->name}}</p>
                                    @if($item->type == 'live')
                                        <img class="img_ico_md" src="https://www.cryptocompare.com/{{$item->logo_url}}">
                                    @else
                                        @if(file_exists('uploads/'.$item->logo_url) && !empty($item->logo_url))
                                            <img class="img_ico_md" src="{{asset('uploads')}}/{{$item->logo_url}}" alt="{{$item->name}}">
                                        @else
                                            <img class="img_ico_md" src="{{asset('assets/img/icon_set')}}/default.png" alt="{{$item->name}}">
                                        @endif
                                    @endif
                                </div>
                                <ul class="list-unstyled">
                                    <li>
                                        <p>@lang('lang.market_quality')</p>
                                        {{$item->market_quality}} / 10
                                    </li>
                                    <li>
                                        <p>@lang('lang.grade_point')</p>
                                        {{$item->grade_points}}
                                    </li>
                                    <li>
                                        <p>@lang('lang.grade')</p>
                                        {{$item->grade}}
                                    </li>
                                    <li>
                                        <p>@lang('lang.rating')</p>
                                        {{$item->avg_rating}}
                                    </li>
                                    <li>
                                        <p>@lang('lang.country')</p>
                                        {{$item->country}}
                                    </li>
                                    <li>
                                        <p>@lang('lang.centralized')</p>
                                        @if($item->centralization_type == 'Centralized')
                                            <span class="label label-primary">Yes</span>
                                            @else
                                            <span class="label label-danger">No</span>
                                        @endif
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{$item->affiliate_url}}" class="btn btn-secondary btn-block">@lang('lang.visit') {{$item->name}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @php($count++)
                    @endif
                @endforeach

                @if($count < 5)
                    <div class="col-sm-3">
                        <div class="clearfix"></div>
                        <div class="logo_container">
                            <p>@lang('lang.add_exchanges')</p>

                            <select id="exchanges" name="name" class="form-control">
                                <option value selected disabled>@lang('lang.please_select')</option>
                                @foreach($exchanges as $item)
                                    <option value="{{str_replace(' ', '-', strtolower($item->name))}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
    $(document).ready(function () {
      $('#exchanges').on('change', function() {
        window.location.replace("{{url('compare/exchanges')}}?name={{$name}}"+this.value)
      })
    })
    </script>
@endsection
