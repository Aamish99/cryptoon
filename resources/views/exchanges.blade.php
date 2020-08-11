@extends('layouts.app')
@section('title', __('lang.exchanges'))
@section('description' , setting('description'))
@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">@lang('lang.exchanges')</li>
            </ol>
            <h1>@lang('lang.exchanges_head_title')</h1>
            <p>@lang('lang.exchanges_description').</p>
        </div>
    </div>

    <div id="content bg_offwhite">
        <div class="container">
            <br>
            <br>
            <div class="row">
                <div class="col-md-9">
                    <div id="results">
                        <div class="exchanges-results">
                            <div class="row results-info">
                                <div class="pull-right"><span>@lang('lang.sort_by')</span>
                                    <div class="dropdown">
                                        <button type="button" data-toggle="dropdown" class="btn btn-link dropdown-toggle">
                                            {{($request->sort) == 'price' ? 'Price': 'Rating'}}
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{url('exchanges/filter')}}?sort=name">@lang('lang.name')</a>
                                            </li>
                                            <li>
                                                <a href="{{url('exchanges/filter')}}?sort=rating">@lang('lang.rating')</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <h3 class="results-info-text hidden-xs hidden-sm">
                                    {{sizeof($exchanges)}} @lang('lang.marketplaces_found')
                                </h3>
                            </div>

                            <div class="row">
                                @foreach($exchanges as $item)
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="exchanges-box ">
                                            <a href="{{url('exchange')}}/{{str_replace(' ', '-', strtolower($item->name))}}">
                                                <div class="exchanges-img">
                                                    @if($item->type == 'live')
                                                        <img src="https://www.cryptocompare.com/{{$item->logo_url}}">
                                                    @else
                                                        @if(file_exists('uploads/'.$item->logo_url) && !empty($item->logo_url))
                                                            <img src="{{asset('uploads')}}/{{$item->logo_url}}" alt="{{$item->name}}">
                                                        @else
                                                            <img src="{{asset('assets/img/icon_set')}}/default.png" alt="{{$item->name}}">
                                                        @endif
                                                    @endif
                                                </div>
                                                <h4>{{$item->name}}</h4>
                                                <hr>
                                                <span>
                                                    <strong>{{($item->avg_rating) == null ? 0 : $item->avg_rating}}/5</strong>
                                                </span>
                                                <br>
                                                <span class="stars f_0">
                                                   {{($item->avg_rating) == null ? 0 : $item->avg_rating}}
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-center pag_links">
                            {{$exchanges->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <a class="btn btn-default filter_toggle btn-price-alert visible-xs">
                        <i class="fas fa-filter"></i> @lang('lang.show_filter')
                    </a>
                    <form method="get" id="filter_form" action="{{url('exchanges/filter')}}">
                        <div id="filters">
                            <div>
                                <h4>@lang('lang.deposit_methods')</h4>
                                <div class="checkbox checkbox-danger">
                                    <input type="checkbox" name="dbank" id="dbank" {{($request->dbank) == 'on' ? 'checked': ''}}>
                                    <label for="dbank"><i class="fas fa-university"></i> Bank Transfer</label>
                                </div>

                                <div class="checkbox checkbox-danger">
                                    <input type="checkbox" name="dvisa" id="dvisa" {{($request->dvisa) == 'on' ? 'checked': ''}}>
                                    <label for="dvisa"><i class="fab fa-cc-visa"></i> VISA</label>
                                </div>
                                <div class="checkbox checkbox-danger">
                                    <input type="checkbox" name="dmaster" id="dmaster" {{($request->dmaster) == 'on' ? 'checked': ''}}>
                                    <label for="dmaster"><i class="fab fa-cc-mastercard"></i> Mastercard</label>
                                </div>

                                <div class="checkbox checkbox-danger">
                                    <input type="checkbox" name="dpaypal" id="dpaypal" {{($request->dpaypal) == 'on' ? 'checked': ''}}>
                                    <label for="dpaypal"><i class="fab fa-paypal"></i> Paypal</label>
                                </div>

                                <div class="checkbox checkbox-danger">
                                    <input type="checkbox" name="dskrill" id="dskrill" {{($request->dskrill) == 'on' ? 'checked': ''}}>
                                    <label for="dskrill"><i class="fas fa-money-check-alt"></i> Skrill</label>
                                </div>
                            </div>

                            <div>
                                <h4>@lang('lang.withdrawal_methods')</h4>
                                <div class="checkbox checkbox-danger">
                                    <input type="checkbox" name="wbank" id="wbank" {{($request->wbank) == 'on' ? 'checked': ''}}>
                                    <label for="wbank"><i class="fas fa-university"></i> Bank Transfer</label>
                                </div>

                                <div class="checkbox checkbox-danger">
                                    <input type="checkbox" name="wvisa" id="wvisa" {{($request->wvisa) == 'on' ? 'checked': ''}}>
                                    <label for="wvisa"><i class="fab fa-cc-visa"></i> VISA</label>
                                </div>
                                <div class="checkbox checkbox-danger">
                                    <input type="checkbox" name="wmaster" id="wmaster" {{($request->wmaster) == 'on' ? 'checked': ''}}>
                                    <label for="wmaster"><i class="fab fa-cc-mastercard"></i> Mastercard</label>
                                </div>

                                <div class="checkbox checkbox-danger">
                                    <input type="checkbox" name="wpaypal" id="wpaypal" {{($request->wpaypal) == 'on' ? 'checked': ''}}>
                                    <label for="wpaypal"><i class="fab fa-paypal"></i> Paypal</label>
                                </div>

                                <div class="checkbox checkbox-danger">
                                    <input type="checkbox" name="wskrill" id="wskrill" {{($request->wskrill) == 'on' ? 'checked': ''}}>
                                    <label for="wskrill"><i class="fas fa-money-check-alt"></i> Skrill</label>
                                </div>
                            </div>

                            <div>
                                <h4>@lang('lang.marketplaces_type')</h4>
                                <div class="radio radio-danger">
                                    <input type="radio" id="centralized" name="market_type" value="centralized" {{($request->market_type) == 'centralized' ? 'checked': ''}}>
                                    <label for="centralized">@lang('lang.centralized') </label>
                                </div>
                                <div class="radio radio-danger">
                                    <input type="radio" id="decentralized" name="market_type" value="decentralized" {{($request->market_type) == 'decentralized' ? 'checked': ''}}>
                                    <label for="decentralized">@lang('lang.decentralized') </label>
                                </div>
                            </div>
                            <div>
                                <h4>@lang('lang.rating')</h4>
                                <div class="radio radio-danger">
                                    <input type="radio" id="rating_4" name="rating" value="4" {{($request->rating) == '4' ? 'checked': ''}}>
                                    <label for="rating_4" class="rating_star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star gray"></i>
                                        & more
                                    </label>
                                </div>
                                <div class="radio radio-danger">
                                    <input type="radio" id="rating_3" name="rating" value="3" {{($request->rating) == '3' ? 'checked': ''}}>
                                    <label for="rating_3" class="rating_star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star gray"></i>
                                        <i class="fas fa-star gray"></i>
                                        & more
                                    </label>
                                </div>
                                <div class="radio radio-danger">
                                    <input type="radio" id="rating_2" name="rating" value="2" {{($request->rating) == '2' ? 'checked': ''}}>
                                    <label for="rating_2" class="rating_star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star gray"></i>
                                        <i class="fas fa-star gray"></i>
                                        <i class="fas fa-star gray"></i>
                                        & more
                                    </label>
                                </div>
                                <div class="radio radio-danger">
                                    <input type="radio" id="rating_1" name="rating" value="1" {{($request->rating) == '1' ? 'checked': ''}}>
                                    <label for="rating_1" class="rating_star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star gray"></i>
                                        <i class="fas fa-star gray"></i>
                                        <i class="fas fa-star gray"></i>
                                        <i class="fas fa-star gray"></i>
                                        & more
                                    </label>
                                </div>
                                <div class="radio radio-danger">
                                    <input type="radio" name="rating" id="rating_any" value="any" {{($request->rating) == 'any' ? 'checked': ''}}>
                                    <label for="rating_any">@lang('lang.any_rating') </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-default btn-block">@lang('lang.filter_exchanges')</button>
                            <a href="{{url('exchanges')}}" class="btn btn-primary btn-block">@lang('lang.clear_filters')</a>
                            <br>
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
