@extends('layouts.app')
@section('title', $currency->name)
@section('description' , $currency->description)
@section('style')
    <link rel="stylesheet" href="{{asset('assets/libs/amcharts/css/amcharts.min.css')}}">
@endsection
@section('content')
    <div class="coin-detail">
        <div class="container">
            <div class="coin-data">
                <ul>
                    <li>
                        <div class="icon-image">
                            @if($currency['type'] == 'live')
                                <img class="img_ico" src="https://www.cryptocompare.com/{{$currency['icon_url']}}" alt="{{$currency['name']}}">
                            @else
                                @if(file_exists('uploads/'.$currency['icon_url']) && !empty($currency['icon_url']))
                                    <img class="img_ico" src="{{asset('uploads')}}/{{$currency['icon_url']}}" alt="{{$currency['name']}}">
                                @else
                                    <img class="img_ico" src="{{asset('assets/img/icon_set')}}/default.png" alt="{{$currency->name}}">
                                @endif
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="icon-tag">
                            <p>@lang('lang.name')</p>
                            <h4>{{$currency['name']}}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="icon-tag">
                            <p>Price</p>
                            <h4>
                                ${{round($currency->price, 2)}}
                                @if(strpos($currency->change_24h, '-') !== false)
                                    <span class="red-color">
                                        <i class="mdi mdi-menu-down"></i>
                                        {{round($currency->change_24h, 2)}}%
                                    </span>
                                @else
                                    <span class="green-color">
                                        <i class="mdi mdi-menu-up"></i>
                                        {{round($currency->change_24h, 2)}}%
                                    </span>
                                @endif
                            </h4>
                        </div>
                    </li>

                    <li class="d-none d-md-inline">
                        <div class="icon-tag">
                            <p>@lang('lang.market_cap')</p>
                            <h4>
                                @if ($currency->market_cap < 1000000)
                                    $ {{number_format($currency->market_cap)}}
                                @elseif ($currency->market_cap < 1000000000)
                                    ${{number_format($currency->market_cap / 1000000, 2) . ' Million'}}
                                @else
                                    ${{ number_format($currency->market_cap / 1000000000, 2) . '  Billion'}}
                                @endif
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="buy_coin">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <h2>@lang('lang.buy') {{$currency->name}}</h2>
                    <p>@lang('lang.based_on_cheapest_price')</p>
                    <div class="row">
                        @php($count = 0)
                        @foreach($trading_exchanges as $item)
                            @if($count > 2)
                                @break
                            @endif
                            <div class="col-sm-4">
                                <div class="buy_box">
                                    <img src="https://www.cryptocompare.com/{{$item['logo_url']}}" alt="{{$currency->name}}">
                                    <p>@lang('lang.rating'): {{$item['avg_rating']}} / 5</p>
                                    <strong>${{round($item['price'],2)}}</strong> <br><br>
                                    <a target="_blank" href="{{$item['affiliate_url']}}" class="btn btn-secondary">@lang('lang.buy') {{$currency->name}} <i class="fas fa-long-arrow-alt-right"></i></a>
                                </div>
                            </div>
                            @php($count++)
                        @endforeach
                    </div>
                </div>

                <div class="col-sm-5 cd_button">
                    <br>
                    <br>
                    <a href="{{url('compare/cryptocurrencies')}}?name={{$currency->symbol}}" class="btn btn-secondary"><i class="fas fa-compress-arrows-alt"></i> @lang('lang.compare')</a>
                    <a href="#reviews" class="btn btn-secondary"><i class="fas fa-star"></i> @lang('lang.rate')</a>
                    <a href="#" data-toggle="modal" data-target="#alert_modal" class="btn btn-secondary"><i class="fas fa-bell"></i> @lang('lang.set_price_alert')</a>
                </div>
            </div>
        </div>
    </div>

    <div class="graph-container">
        <div class="container">
            <div id="coin-graph"></div>
        </div>
    </div>

    <div class="coin-extra">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="ranking-box">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="data-item">
                                    <h2>@lang('lang.trending')  <span class="label label-info">{{$currency->trending}}</span></h2>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="data-item">
                                    <h2>@lang('lang.market_cap')</h2>
                                    <p>
                                        @if ($currency->market_cap < 1000000)
                                            $ {{number_format($currency->market_cap)}}
                                        @elseif ($currency->market_cap < 1000000000)
                                            ${{number_format($currency->market_cap / 1000000, 2) . ' million'}}
                                        @else
                                            ${{ number_format($currency->market_cap / 1000000000, 2) . '  billion'}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="data-item">
                                    <h2>@lang('lang.24h_trade_volume')</h2>
                                    <p>
                                        @if ($currency->volume_24h < 1000000)
                                            $ {{number_format($currency->volume_24h)}}
                                        @elseif ($currency->volume_24h < 1000000000)
                                            ${{number_format($currency->volume_24h / 1000000, 2) . ' million'}}
                                        @else
                                            ${{ number_format($currency->volume_24h / 1000000000, 2) . '  billion'}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="data-item">
                                    <h2>@lang('lang.circulating_supply')</h2>
                                    <p>
                                        @if ($currency->supply < 1000000)
                                            $ {{number_format($currency->supply)}}
                                        @elseif ($currency->supply < 1000000000)
                                            ${{number_format($currency->supply / 1000000, 2) . ' million'}}
                                        @else
                                            ${{ number_format($currency->supply / 1000000000, 2) . '  billion'}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="data-item">
                                    <h2>@lang('lang.change_24h_volume')</h2>
                                    <p>
                                        @if(strpos($currency->change_24h, '-') !== false)
                                            <span>
                                                {{round($currency->change_24h, 2)}}%
                                                <i class="mdi mdi-menu-down"></i>
                                            </span>
                                        @else
                                            <span>
                                                {{round($currency->change_24h, 2)}}%
                                                <i class="mdi mdi-menu-up"></i>
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="data-item">
                                    <h2>@lang('lang.status')</h2>
                                    <p>
                                        @lang('lang.active')
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($currency->description)
                    <div class="col-12 col-md-6">
                        <div class="ranking-box description">
                            <div>
                                <p>
                                    {{$currency->description}}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

           <ul class="list-unstyled share_icons">
               <li>
                   <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url('/coin')}}/{{$currency->symbol}}">
                       <img src="{{asset('assets/img/facebook.svg')}}" alt="facebook">
                   </a>
               </li>

               <li>
                   <a target="_blank" href="https://twitter.com/share?url={{url('/coin')}}/{{$currency->symbol}}">
                       <img src="{{asset('assets/img/twitter.svg')}}" alt="facebook">
                   </a>
               </li>

               <li>
                   <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{url('/coin')}}/{{$currency->symbol}}">
                       <img src="{{asset('assets/img/linkedin.svg')}}" alt="facebook">
                   </a>
               </li>
           </ul>
        </div>
    </div>

    <div class="page_reviews" id="reviews">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h2>{{$currency->name}} @lang('lang.reviews')</h2>
                    @if($errors->all())
                        <br>
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(Session::has('werror'))
                        <br>
                        <div class="alert alert-danger">
                            {{Session::get('werror')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(Session::has('rsuccess'))
                        <br>
                        <div class="alert alert-success">
                            {{Session::get('rsuccess')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(Auth::check())
                        <br>
                        <form action="{{url('review')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="coin" value="{{$currency->symbol}}">
                            <div class="add_review">
                                <h4> @lang('lang.add_review')
                                    <div class="rating pull-right"></div>
                                </h4>
                                <div class="form-group">
                                    <textarea name="review" class="form-control" placeholder="Add Review" required>{{old('review')}}</textarea>
                                </div>
                                @if(setting('captcha_status') == 'on' && setting('site_key') != null)
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{setting('site_key')}}"></div>
                                        <script src='https://www.google.com/recaptcha/api.js'></script>
                                    </div>
                                @endif
                                <div class="form-group text-right">
                                    <input type="submit" class="btn btn-secondary" value="Submit">
                                </div>
                            </div>
                        </form>

                    @else
                        <div class="check_log">
                            Please <a class="btn btn-secondary" href="{{url('login')}}">login</a> to add your review
                        </div>
                    @endif
                    <br>

                    @foreach($reviews as $item)
                        <div class="review_block">
                            <div class="media">
                                <div class="media-left">
                                    <img class="media-object" src="{{asset('assets/img/default-avatar.png')}}" alt="avatar">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$item->user->name}}</h4>
                                    <p>
                                        <span class="stars">{{$item->rating}}</span>
                                    </p>
                                    {{$item->review}}
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if($reviews->isEmpty())
                        <p class="text-center">@lang('lang.no_review_available')</p>
                    @endif
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" role="dialog" id="alert_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"  data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><span><i class="fa fa-bell"></i>  @lang('lang.set_price_alert')</span></h4></div>

                <form method="post" action="{{url('price-alert')}}" id="price-alert-form" class="form-horizontal">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <p>
                            @lang('lang.price_alert_message').
                        </p>
                        <div class="alert alert-success alert_success d_none"></div>
                        <div class="alert alert-danger alert_error d_none"></div>

                        <input type="hidden" name="coin" value="{{$currency->symbol}}">
                        <div class="form-group">
                            <label for="rate" class="col-sm-4 control-label"> @lang('lang.your_target_price_usd'):</label>
                            <div class="col-sm-6">
                                <input type="number" step="0.00001" name="alert_price" class="form-control" required>
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

@section('script')
    <script src='{{asset('assets/libs/amcharts/js/stock-chart.js')}}'></script>
    <script src='{{asset('assets/libs/star-rating/star.rating.min.js')}}'></script>

    <script>

    $('.rating').addRating({
      max : 5,
      icon : 'star',
      fieldName : 'rating',
      fieldId : 'rating'
    });

    (function($) {
      'use strict';
      var priceData = [];
      $.ajax({
        url: 'https://api.coincap.io/v2/assets/'+'{{($currency->coin_id) ? $currency->coin_id : strtolower(str_replace(' ', '-', $currency->name))}}'+'/history?interval=d1',
        method: 'GET',
        success: function(history) {
          if(history===null){
            $("#coin-graph").hide();
          }else{
            $.each(history.data, function(i, value) {
              priceData.push( {
                "date":new Date(value.date),
                "value":value.priceUsd
                //"volume":history.volume[i][1]
              } );
            });
          }
          setTimeout(function() {
            generateChartData(priceData);
          }, 500);
        }
      });

      var generateChartData = function(coinData) {
        var chart = AmCharts.makeChart('coin-graph', {
          "type": "stock",
          "theme": "light",
          "hideCredits":true,
          "categoryAxesSettings": {
            "minPeriod": "mm"
          },
          "dataSets": [ {
            "title":"USD",
            "color":'#10D078',
            "fieldMappings": [ {
              "fromField": "value",
              "toField": "value"
            }
            ],
            "dataProvider":coinData,
            "categoryField": "date"
          } ],
          "panels": [ {
            "showCategoryAxis": false,
            "title": "Price",
            "percentHeight": 70,
            "stockGraphs": [ {
              "fillAlphas": 0,
              "fillColors": "red",
              "id": "g1",
              "valueField": "value",
              "type": "smoothedLine",
              "lineThickness": 4,
              "bullet": "round",
              "comparable": true,
              "compareField": "value",
              "balloonText": "[[title]]:<b>[[value]]</b>",
              "compareGraphBalloonText": "[[title]]:<b>[[value]]</b>"
            } ],
            "categoryAxis": {
              "gridThickness": 0
            },

            "stockLegend": {
              "periodValueTextComparing": "[[percents.value.close]]%",
              "periodValueTextRegular": "[[value.close]]"
            },
            "allLabels": [ {
              "x": 200,
              "y": 115,
              "text": "",
              "align": "center",
              "size": 16,

            } ],
            "drawingIconsEnabled": false
          }, {
            "title": "Volume",
            "percentHeight": 10,

          } ],
          "chartScrollbarSettings": {
            "enabled": false,
          },

          "chartCursorSettings": {
            "categoryBalloonAlpha": 1,
            "valueBalloonsEnabled": false,
            "fullWidth": false,
            "cursorAlpha": 3,
            "cursorColor": '#1B334D',
            "cursorPosition": 'mouse',
            "valueLineBalloonEnabled": false,
            "valueLineEnabled": false,
            "valueLineAlpha": 0.5
          },
          "periodSelector": {
            "position": "top",
            "periods": [
              {
                "period": "DD",
                "count": 1,
                "label": "1D"
              },
              {
                "period": "DD",
                "selected": true,
                "count":7,
                "label": "7D"
              },
              {
                "period": "MM",
                "count": 1,
                "label": "1M"
              },
              {
                "period": "MM",
                "count": 3,
                "label": "3M"
              },
              {
                "period": "MM",
                "count":6,
                "label": "6M"
              },
              {
                "period": "YY",
                "count": 1,
                "label": "1Y"
              }, {
                "period": "MAX",
                "label": "All"
              } ]
          },
          "export": {
            "enabled": true,
            "position": "top-right"
          }
        } );
      }
    })($);
    </script>

@endsection
