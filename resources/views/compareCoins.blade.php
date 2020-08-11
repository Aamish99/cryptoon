@extends('layouts.app')
@section('title', __('lang.compare_coins'))
@section('description' , setting('description'))
@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">@lang('lang.compare')</li>
                <li class="active">@lang('lang.cryptocurriencies')</li>
            </ol>
            <h1>@lang('lang.compare_cryptocurriencies')</h1>
            <a href="{{url('compare/exchanges')}}" class="btn btn-primary">
                @lang('lang.compare_exchanges') <i class="fas fa-arrow-right"></i>
            </a>
            <br>
            <br>
        </div>
    </div>

    <div class="ex_section">
        <div class="container">
            <div class="row">
                @php($count = 1)
                 @foreach($cp_coins as $item)
                    @if(!empty($item))
                        <div class="col-sm-3">
                            <div class="expc_box compare">
                                <div class="clearfix"></div>
                                <div class="logo_container">
                                    <p>{{$item->symbol}}</p>
                                    @if($item->type == 'live')
                                        <img class="img_ico" src="https://www.cryptocompare.com/{{$item->icon_url}}" alt="{{$item->name}}">
                                    @else
                                        @if(file_exists('uploads/'.$item->icon_url) && !empty($item->icon_url))
                                            <img class="img_ico" src="{{asset('uploads')}}/{{$item->icon_url}}" alt="{{$item->name}}">
                                        @else
                                            <img class="img_ico" src="{{asset('assets/img/icon_set')}}/default.png" alt="{{$item->name}}">
                                        @endif
                                    @endif
                                </div>
                                <ul class="list-unstyled">
                                    <li>
                                        <p>@lang('lang.symbol')</p>
                                        {{$item->symbol }}
                                    </li>
                                    <li>
                                        <p>@lang('lang.market_cap')</p>
                                        @if ($item->market_cap < 1000000)
                                            ${{number_format($item->market_cap)}}
                                        @elseif ($item->market_cap < 1000000000)
                                            ${{number_format($item->market_cap / 1000000, 2) . ' M'}}
                                        @else
                                            ${{ number_format($item->market_cap / 1000000000, 2) . ' B'}}
                                        @endif
                                    </li>
                                    <li>
                                        <p>@lang('lang.supply')</p>
                                        @if ($item->supply < 1000000)
                                            ${{number_format($item->supply)}}
                                        @elseif ($item['SUPPLY'] < 1000000000)
                                            ${{number_format($item->supply / 1000000, 2) . ' M'}}
                                        @else
                                            ${{ number_format($item->supply / 1000000000, 2) . ' B'}}
                                        @endif
                                    </li>
                                    <li>
                                        <p>@lang('lang.price')</p>
                                        ${{round($item->price, 4)}}
                                    </li>
                                    <li>
                                        <p>@lang('lang.24h_volume')</p>
                                        @if ($item->volume_24h < 1000000)
                                            ${{number_format($item->volume_24h)}}
                                        @elseif ($item->volume_24h < 1000000000)
                                            ${{number_format($item->volume_24h / 1000000, 2) . ' M'}}
                                        @else
                                            ${{ number_format($item->volume_24h / 1000000000, 2) . ' B'}}
                                        @endif
                                    </li>
                                    <li>
                                        <p>@lang('lang.24h_change')</p>
                                        @if(strpos($item->change_24h, '-') !== false)
                                            <span class="red-color">
                                         <i class="mdi mdi-menu-down"></i>
                                    {{round($item->change_24h, 2)}} %
                                     </span>
                                        @else
                                            <span class="green-color">
                                         <i class="mdi mdi-menu-up"></i>
                                     {{round($item->change_24h, 2)}}%
                                 </span>
                                        @endif
                                    </li>
                                    <li>
                                        <a target="_blank" href="{{url('trade')}}/buy/{{$item->symbol}}" class="btn btn-secondary btn-block">@lang('lang.buy-sell') {{$item->symbol}}</a>
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
                            <p>@lang('lang.add_coin')</p>
                            <select id="exchanges" name="name" class="form-control">
                                <option value selected disabled>@lang('lang.please_select')</option>
                                @foreach($coins as $item)
                                    <option value="{{$item->symbol}}">{{$item->name}}</option>
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
        window.location.replace("{{url('compare/cryptocurrencies')}}?name={{$name}}"+this.value)
      })
    })
    </script>
@endsection
