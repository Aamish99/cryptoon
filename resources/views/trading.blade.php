@extends('layouts.app')
@section('title' , __('lang.trade'))
@section('description' , setting('description'))
@section('content')
    <form method="post" action="#" id="trading_form">
        <div id="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="row searchy">
                            <div class="search-item col-xs-12 col-md-7 p-0">
                                <fieldset>
                                    <select name="" class="form-control coins_data">
                                        <option value>@lang('lang.please_select')</option>
                                        @foreach($coins as $item)
                                            <option value="{{$item['symbol']}}" {{($coin) == $item['symbol'] ? 'selected': ''}}>{{$item['name']}}</option>
                                        @endforeach
                                    </select>

                                </fieldset>
                            </div>
                            <div class="search-item col-xs-12 col-md-2 p-0">
                                <fieldset>
                                    <select name="type" class="form-control s_data">
                                        <option value="sell" {{($action) == 'sell' ? 'checked': ''}}>Sell</option>
                                        <option value="buy" {{($action) == 'buy' ? 'checked': ''}}>Buy</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="search-item col-xs-12 col-md-3">
                                <button type="submit" class="btn btn-search btn-primary btn-lg btn-block"><span><i class="fa fa-search"></i>@lang('lang.search')</span></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <div id="content" class="">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div id="results">
                        <div>
                            <div class="row results-info">
                                <div class="pull-right"><span>Sort by</span>
                                    <div class="dropdown">
                                        <button type="button" data-toggle="dropdown" class="btn btn-link dropdown-toggle">
                                            {{($request->sort) == 'rating' ? 'Rating': 'Price'}}
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{url('filter', $action)}}/{{$coin}}?sort=price">@lang('lang.price')</a>
                                            </li>
                                            <li>
                                                <a href="{{url('filter', $action)}}/{{$coin}}?sort=rating">@lang('lang.rating')</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="dropdown">
                                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-link dropdown-toggle">
                                            <i class="fa fa-share"></i>  @lang('lang.share')<span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <input type="text" readonly="readonly" value="{{url('filter', $action)}}/{{$coin}}" class="form-control input-sm">
                                            </li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="https://twitter.com/share?url={{url('filter', $action)}}/{{$coin}}" target="_blank"><i class="fab fa-twitter"></i> &nbsp; Twitter</a></li>
                                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{url('filter', $action)}}/{{$coin}}" target="_blank"><i class="fab fa-facebook"></i> &nbsp; Facebook</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <h3 class="results-info-text hidden-xs hidden-sm">
                                    {{sizeof($trading_exchanges)}} @lang('lang.marketplaces_found')
                                </h3>
                            </div>

                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{Session::get('success')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if($errors->all())
                                <div class="alert alert-danger" role="alert">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }} <br>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @foreach($trading_exchanges as $item)
                                <div class="row search-result">

                                    <div class="col-xs-12 col-sm-3 price-quote-col text-center">
                                        <div class="price-quote">
                                            <div data-role="trigger">
                                                @if($request->amount != null)
                                                    <p class="m0">${{$request->amount}} gets you</p>
                                                    <span class="price">{{round($request->amount / $item['price'], 4) }} {{$coin}}</span>
                                                    <p>1 {{$coin}} = ${{round($item['price'], 4)}}</p>
                                                @else
                                                    <span class="price">${{round($item['price'], 4)}}</span>
                                                    <p>
                                                        @lang('lang.price_for_1') {{$coin}}
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-6 col-sm-12">
                                                    <a href="{{$item['affiliate_url']}}" target="_blank" class="btn btn-default btn-buy btn-block">@lang('lang.trade')</a></div>
                                                <div class="col-xs-6 col-sm-12">
                                                    <a href="{{url('exchange')}}/{{str_replace(' ', '-', strtolower($item['name']))}}" class="btn btn-default-outline btn-buy btn-block"> @lang('lang.details')</a>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-9 info-col">
                                        <h4>
                                            <a href="https://cryptoradar.co/exchange/exmo">
                                                <img src="https://www.cryptocompare.com/{{$item['logo_url']}}" alt="{{$item['name']}}">
                                            </a>
                                            <span class="stars f_0">{{$item['avg_rating']}}</span>
                                            <strong>{{$item['avg_rating']}}</strong>
                                        </h4>
                                    </div>

                                    <div class="col-xs-12 col-sm-9 details-col hidden-xs">
                                        <div class="row quick-info">
                                            <div class="quick-info-section col-sm-3 col-xs-6">
                                                <div class="quick-info-title">@lang('lang.grade_points')</div>
                                                <div class="quick-info-data">{{$item['grade_points']}}</div>
                                            </div>
                                            <div class="quick-info-section col-sm-3 col-xs-6">
                                                <div class="quick-info-title">@lang('lang.grade')</div>
                                                <div class="quick-info-data">{{$item['grade']}}</div>
                                            </div>
                                            <div class="quick-info-section col-sm-3 col-xs-6">
                                                <div class="quick-info-title">@lang('lang.market_quality')</div>
                                                <div class="quick-info-data">{{$item['market_quality']}}/10</div>
                                            </div>
                                            <div class="quick-info-section col-sm-3 col-xs-6">
                                                <div class="quick-info-title">@lang('lang.avg_rating')</div>
                                                <div class="quick-info-data">{{$item['avg_rating']}}</div>
                                            </div>
                                        </div>
                                        <hr class="mt-8 mb-7">
                                        <div class="row result-footer">
                                            <div class="col-sm-4 result-footer-section">
                                                <span class="result-footer-title hidden-md hidden-sm ">Country: <span class="color_black">{{$item['country']}}</span>
                                                </span>
                                            </div>

                                            <div class="col-sm-4 col-xs-12 result-footer-section">
                                                <span class="result-footer-title hidden-md hidden-sm ">@lang('lang.type'):  <span class="color_black">{{$item['centralization_type']}}</span>
                                                </span>
                                            </div>

                                            <div class="col-sm-4 col-xs-12 result-footer-section">
                                                <span class="result-footer-title hidden-md hidden-sm ">@lang('lang.sponsored'):  <span class="color_black">{{$item['sponsored']}}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <a class="btn btn-default btn-price-alert" data-toggle="modal" data-target="#alert_modal">
                        <i class="fa fa-bell"></i> @lang('lang.set_price_alert')
                    </a>

                    <a class="btn btn-default filter_toggle btn-price-alert visible-xs">
                        <i class="fas fa-filter"></i> @lang('lang.show_filter')
                    </a>

                    <form method="get" id="filter_form" action="{{url('filter', $action)}}/{{$coin}}">
                        <div id="filters">
                            <div>
                                <h4>@lang('lang.investment_amount') ($)</h4>
                                <input type="text" name="amount" class="form-control" placeholder="Enter Amount" value="{{($request->amount) != null ? $request->amount: ''}}">

                                <h4>@lang('lang.deposit_methods')</h4>
                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" name="dbank" id="dbank" {{($request->dbank) == 'on' ? 'checked': ''}}>
                                    <label for="dbank"><i class="fas fa-university"></i> @lang('lang.bank_transfer')</label>
                                </div>

                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" name="dvisa" id="dvisa" {{($request->dvisa) == 'on' ? 'checked': ''}}>
                                    <label for="dvisa"><i class="fab fa-cc-visa"></i> @lang('lang.visa')</label>
                                </div>
                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" name="dmaster" id="dmaster" {{($request->dmaster) == 'on' ? 'checked': ''}}>
                                    <label for="dmaster"><i class="fab fa-cc-mastercard"></i> @lang('lang.mastercard')</label>
                                </div>

                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" name="dpaypal" id="dpaypal" {{($request->dpaypal) == 'on' ? 'checked': ''}}>
                                    <label for="dpaypal"><i class="fab fa-paypal"></i> @lang('lang.paypal')</label>
                                </div>

                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" name="dskrill" id="dskrill" {{($request->dskrill) == 'on' ? 'checked': ''}}>
                                    <label for="dskrill"><i class="fas fa-money-check-alt"></i> @lang('lang.skrill')</label>
                                </div>
                            </div>

                            <div>
                                <h4>@lang('lang.withdrawal_methods')</h4>
                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" name="wbank" id="wbank" {{($request->wbank) == 'on' ? 'checked': ''}}>
                                    <label for="wbank"><i class="fas fa-university"></i> @lang('lang.bank_transfer')</label>
                                </div>

                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" name="wvisa" id="wvisa" {{($request->wvisa) == 'on' ? 'checked': ''}}>
                                    <label for="wvisa"><i class="fab fa-cc-visa"></i> @lang('lang.visa')</label>
                                </div>
                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" name="wmaster" id="wmaster" {{($request->wmaster) == 'on' ? 'checked': ''}}>
                                    <label for="wmaster"><i class="fab fa-cc-mastercard"></i> @lang('lang.mastercard')</label>
                                </div>

                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" name="wpaypal" id="wpaypal" {{($request->wpaypal) == 'on' ? 'checked': ''}}>
                                    <label for="wpaypal"><i class="fab fa-paypal"></i> @lang('lang.paypal')</label>
                                </div>

                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" name="wskrill" id="wskrill" {{($request->wskrill) == 'on' ? 'checked': ''}}>
                                    <label for="wskrill"><i class="fas fa-money-check-alt"></i> @lang('lang.skrill')</label>
                                </div>
                            </div>

                            <div>
                                <h4>@lang('lang.marketplaces_type')</h4>
                                <div class="radio radio-primary">
                                    <input type="radio" id="centralized" name="market_type" value="centralized" {{($request->market_type) == 'centralized' ? 'checked': ''}}>
                                    <label for="centralized"> @lang('lang.centralized')</label>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio" id="decentralized" name="market_type" value="decentralized" {{($request->market_type) == 'decentralized' ? 'checked': ''}}>
                                    <label for="decentralized">@lang('lang.decentralized') </label>
                                </div>
                            </div>
                            <div>
                                <h4>@lang('lang.rating')</h4>
                                <div class="radio radio-primary">
                                    <input type="radio" id="rating_4" name="rating" value="4" {{($request->rating) == '4' ? 'checked': ''}}>
                                    <label for="rating_4" class="rating_star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star gray"></i>
                                        & @lang('lang.more')
                                    </label>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio" id="rating_3" name="rating" value="3" {{($request->rating) == '3' ? 'checked': ''}}>
                                    <label for="rating_3" class="rating_star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star gray"></i>
                                        <i class="fas fa-star gray"></i>
                                        & @lang('lang.more')
                                    </label>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio" id="rating_2" name="rating" value="2" {{($request->rating) == '2' ? 'checked': ''}}>
                                    <label for="rating_2" class="rating_star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star gray"></i>
                                        <i class="fas fa-star gray"></i>
                                        <i class="fas fa-star gray"></i>
                                        & @lang('lang.more')
                                    </label>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio" id="rating_1" name="rating" value="1" {{($request->rating) == '1' ? 'checked': ''}}>
                                    <label for="rating_1" class="rating_star">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star gray"></i>
                                        <i class="fas fa-star gray"></i>
                                        <i class="fas fa-star gray"></i>
                                        <i class="fas fa-star gray"></i>
                                        & @lang('lang.more')
                                    </label>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio" name="rating" id="rating_any" value="any" {{($request->rating) == 'any' ? 'checked': ''}}>
                                    <label for="rating_any"> @lang('lang.any_rating')</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-default btn-block">@lang('lang.filter_exchanges')</button>
                            <a href="{{url('trade')}}/{{$action}}/{{$coin}}" class="btn btn-primary btn-block">@lang('lang.clear_filters')</a>
                            <br>
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="alert_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"  data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><span><i class="fa fa-bell"></i> @lang('lang.set_price_alert')</span></h4></div>
                <form method="post" action="{{url('price-alert')}}" id="price-alert-form" class="form-horizontal">
                    <div class="modal-body">
                        <input type="hidden" name="coin" value="{{$coin}}">
                        {{csrf_field()}}
                        <p>
                            Please enter your email and price to get notified when <strong>{{$coin}}</strong> hit that price.
                        </p>
                        <div class="alert alert-success alert_success d_none"></div>
                        <div class="alert alert-danger alert_error d_none"></div>

                        <div class="form-group">
                            <label for="rate" class="col-sm-4 control-label">@lang('lang.your_target_price_usd'):</label>
                            <div class="col-sm-6">
                                <input type="text" name="alert_price" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rate" class="col-sm-4 control-label">@lang('lang.your_email'):</label>
                            <div class="col-sm-6">
                                <input type="email" name="alert_email" class="form-control" required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="submit" class="btn btn-primary"><span>@lang('lang.notify_me')!</span></button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection

