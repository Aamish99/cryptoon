@extends('layouts.app')
@section('title' , __('lang.home'))
@section('description' , setting('description'))
@section('style')
    <link rel="stylesheet" href="{{asset('assets/libs/slider/slider.min.css')}}">
@endsection
@section('content')
    <form method="get" id="trading_form">
        <div id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-lg-7">

                        <div id="intro">
                            <h1>@lang('lang.home_heading')</h1>
                            <p>
                                @lang('lang.home_text')</p>
                        </div>
                        <div class="row searchy">
                            <div class="search-item col-xs-12 col-md-6 p-0">
                                <fieldset>
                                    <select name="" class="form-control coins_data">
                                        <option value>@lang('lang.please_select')</option>
                                        @foreach($coins as $key => $item)
                                            <option value="{{$item['symbol']}}" {{($key) == 0 ? 'selected': ''}}>{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>
                            <div class="search-item col-xs-12 col-md-2 p-0">
                                <fieldset>
                                    <select name="type" class="form-control s_data">
                                        <option value="sell">Sell</option>
                                        <option value="buy">Buy</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="search-item col-xs-12 col-md-3">
                                <button type="submit" class="btn btn-search btn-primary btn-lg btn-block"><span><i class="fa fa-search"></i> @lang('lang.search')</span></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <div id="content">
        <br>
        <br>
        <div class="container">
            <div class="camp_slider2">
                <div>
                    <div class="section_heading text-center">
                        <h1>@lang('lang.find_cryptocurrencies_heading')</h1>
                        <p>@lang('lang.find_cryptocurrencies_text')</p>
                    </div>
                    <div class="top_crypto">
                        <div class="row">
                            @php($count = 0)
                            @foreach($gainers as $item)
                                @if($count > 3)
                                    @break
                                @endif
                                <div class="col-sm-3">
                                    <div class="coin_ico">
                                        <img src="https://www.cryptocompare.com/{{$item['icon_url']}}" alt="{{$item['name']}}">
                                        <div class="coin_price">
                                            <h4>{{$item['name']}}</h4>
                                            <p>${{round($item['price'], 4)}}

                                                @if(strpos($item['change_24h'], '-') !== false)
                                                    <span class="red-color">
                                                        <i class="mdi mdi-menu-down"></i>
                                                        {{round($item['change_24h'], 2)}} %
                                                    </span>
                                                @else
                                                    <span class="green-color">
                                                        <i class="mdi mdi-menu-up"></i>
                                                        {{round($item['change_24h'], 2)}}%
                                                    </span>
                                                @endif
                                            </p>
                                            <a href="{{url('coin')}}/{{$item['symbol']}}">@lang('lang.find_out_more')</a>
                                        </div>
                                    </div>
                                </div>
                                @php($count++)
                            @endforeach
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{url('coins')}}" class="btn btn-secondary">@lang('lang.find_more_cryptos') <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>

                <!----crypto exchanges-->
                <div>
                    <div class="section_heading text-center">
                        <h1>@lang('lang.find_exchange_heading')</h1>
                        <p>@lang('lang.find_exchange_text')</p>
                    </div>
                    <div class="top_crypto">
                        <div class="row">
                            @foreach($exchanges as $item)
                                <div class="col-sm-3">
                                    <div class="coin_ico">
                                        <img src="https://www.cryptocompare.com/{{$item->logo_url}}" alt="{{$item->name}}">
                                        <div class="coin_price">
                                            <h4>{{$item->name}}</h4>
                                            <p>@lang('lang.rating'): {{$item->avg_rating}} / 5</p>
                                            <a href="{{url('exchange')}}/{{str_replace(' ', '-', strtolower($item->name))}}">@lang('lang.find_out_more')</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="{{url('exchanges')}}" class="btn btn-secondary">@lang('lang.find_more_exchanges') <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="compare_section">
            <div class="container">
                <div class="section_heading text-center">
                    <h1>@lang('lang.info_section_title')</h1>
                    <p>@lang('lang.info_section_text')</p>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="compare_box text-center">
                                <img src="{{asset('assets/img/money.png')}}" alt="icon" class="img-responsive">
                                <p> 1) @lang('lang.buy_at_best_prices')</p>
                                <p>@lang('lang.step_1_text')</p>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="compare_box text-center">
                                <img src="{{asset('assets/img/chart_image.png')}}" alt="icon" class="img-responsive">
                                <p>2) @lang('lang.compare_top_rated_crypto_exchanges')</p>
                                <p>@lang('lang.step_2_text')</p>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="compare_box text-center">
                                <img src="{{asset('assets/img/bulb.png')}}" alt="icon" class="img-responsive">
                                <p>3) @lang('lang.recommended_by_leaders')</p>
                                <p>@lang('lang.step_3_text')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="section_heading text-center">
                <h1>@lang('lang.alert_title')</h1>
                <p>@lang('lang.alert_text')</p>
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-2">
                        <div class="compare_box alert text-center">
                            <span>
                                <img src="{{asset('assets/img/alert.png')}}" alt="icon">
                            </span>
                            <div class="coin_ico">
                                <img src="{{asset('assets/img/icon_set/BTC.png')}}" alt="alert">
                                <div class="coin_price">
                                    <h4>
                                        <strong>Bitcoin’s</strong> @lang('lang.price_drop')
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 hidden-xs">
                        <div class="go_to_icon">
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="compare_box alert text-center">
                            <span>
                                <img src="{{asset('assets/img/alert.png')}}" alt="icon">
                            </span>
                            <div class="coin_ico mb-0">
                                <img src="{{asset('assets/img/icon_set/BTC.png')}}" alt="alert">
                                <div class="coin_price">
                                    <h4>
                                        @lang('lang.buy_exchange')
                                        <br>
                                        <a href="{{url('trade/buy/BTC')}}" class="btn btn-secondary">@lang('lang.buy_bitcoin') <i class="fas fa-long-arrow-alt-right"></i></a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#alert_modal">@lang('lang.set_a_price_alert') <i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
        </div>
        <br>
        <br>

        <div class="ex_section">
            <div class="container">
                <div class="section_heading text-center">
                    <h1>@lang('lang.compare_section_title')</h1>
                    <p>@lang('lang.compare_section_text')</p>
                </div>
                <div class="camp_slider">
                    <div>
                        @php($count = 1)
                        @foreach($coins as $item)
                            @if($count > 2)
                                @break
                            @endif
                            <div class="expc_box">
                                <div class="clearfix"></div>
                                <div class="logo_container">
                                    <p>{{$item['name']}}</p>
                                    <img class="img_ico_md" src="https://www.cryptocompare.com/{{$item->icon_url}}" alt="{{$item->name}}">
                                </div>
                                <ul class="list-unstyled">
                                    <li>
                                        <p>@lang('lang.market_cap')</p>
                                        @if ($item['market_cap'] < 1000000)
                                            ${{number_format($item['market_cap'])}}
                                        @elseif ($item['market_cap'] < 1000000000)
                                            ${{number_format($item['market_cap'] / 1000000, 2) . ' M'}}
                                        @else
                                            ${{ number_format($item['market_cap'] / 1000000000, 2) . ' B'}}
                                        @endif
                                    </li>
                                    <li>
                                        <p>@lang('lang.price')</p>
                                        ${{round($item['price'], 4)}}
                                    </li>
                                    <li>
                                        <p>@lang('lang.24h_volume')</p>
                                        @if ($item['volumeUsd24Hr'] < 1000000)
                                            ${{number_format($item['volume_24h'])}}
                                        @elseif ($item['volume_24h'] < 1000000000)
                                            ${{number_format($item['volume_24h'] / 1000000, 2) . ' M'}}
                                        @else
                                            ${{ number_format($item['volume_24h'] / 1000000000, 2) . ' B'}}
                                        @endif
                                    </li>
                                    <li>
                                        <p>@lang('lang.24h_change')</p>
                                        @if(strpos($item['change_24h'], '-') !== false)
                                            <span class="red-color">
                                                <i class="mdi mdi-menu-down"></i>
                                                {{round($item['change_24h'], 2)}} %
                                            </span>
                                        @else
                                            <span class="green-color">
                                                <i class="mdi mdi-menu-up"></i>
                                                {{round($item['change_24h'], 2)}}%
                                             </span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            @php($count++)
                        @endforeach

                        <div class="text-center">
                            <br>
                            <a href="{{url('compare/cryptocurrencies')}}" class="btn btn-secondary">@lang('lang.compare_cryptocurrencies')
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        @php($count = 1)
                        @foreach($exchanges as $item)
                            @if($count > 2)
                                @break
                            @endif
                            <div class="expc_box">
                                <div class="clearfix"></div>
                                <div class="logo_container">
                                    <p>{{$item->name}}</p>
                                    <img class="img_ico_md" src="https://www.cryptocompare.com{{$item->logo_url}}">
                                </div>
                                <ul class="list-unstyled">
                                    <li>
                                        <p>@lang('lang.market_quality')</p>
                                        {{$item->market_quality}} / 10
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
                                        <p>@lang('lang.grade')</p>
                                        {{$item->grade}}
                                    </li>
                                </ul>
                            </div>
                            @php($count++)
                        @endforeach
                        <div class="text-center">
                            <br>
                            <a href="{{url('compare/exchanges')}}" class="btn btn-secondary">@lang('lang.compare_exchanges')
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="alert_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"  data-dismiss="modal" aria-label="Close" class="close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">
                        <span>
                            <i class="fa fa-bell"></i>
                            @lang('lang.set_price_alert')
                        </span>
                    </h4>
                </div>
                <form method="post" action="{{url('price-alert')}}" id="price-alert-form" class="form-horizontal">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <p>
                            @lang('lang.price_alert_message')
                        </p>

                        <div class="alert alert-success alert_success d_none"></div>
                        <div class="alert alert-danger alert_error d_none"></div>

                        <div class="form-group">
                            <label for="rate" class="col-sm-4 control-label">@lang('lang.coin'):</label>
                            <div class="col-sm-6">
                                <select name="coin" class="form-control" required>
                                    <option value>@lang('lang.please_select')</option>
                                    @foreach($coins as $item)
                                        <option value="{{$item['symbol']}}">{{$item['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="rate" class="col-sm-4 control-label">@lang('lang.your_target_price_usd'):</label>
                            <div class="col-sm-6">
                                <input type="text" name="alert_price" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rate" class="col-sm-4 control-label">@lang('lang.email'):</label>
                            <div class="col-sm-6">
                                <input type="email" name="alert_email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <span>@lang('lang.notify_me')!</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
