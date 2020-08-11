@extends('layouts.app')
@section('title', __('lang.coins'))
@section('description' , setting('description'))
@section('style')
    <link rel="stylesheet" href="{{asset('assets/libs/datatable/dataTables.min.css')}}">
@endsection
@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">@lang('lang.coins')</li>
            </ol>
            <h1>@lang('lang.all_coins')</h1>
            <p>@lang('lang.coin_description')</p>
        </div>
    </div>
    <div id="content">
        <div class="container">
            <div class="coin-search">
            </div>
            <div class="table-responsive">
                <table id="coin-table" class="table coin-table">
                    <thead>
                    <tr>
                        <th class="hidden"></th>
                        <th>
                            @lang('lang.name')
                        </th>
                        <th>
                            @lang('lang.price')
                        </th>
                        <th>
                            @lang('lang.market_cap')
                        </th>
                        <th>
                            @lang('lang.24h_volume')
                        </th>
                        <th>
                            @lang('lang.24h_change')
                        </th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="hidden"></th>
                        <th>
                            @lang('lang.name')
                        </th>
                        <th>
                            @lang('lang.price')
                        </th>
                        <th>
                            @lang('lang.market_cap')
                        </th>
                        <th>
                            @lang('lang.24h_volume')
                        </th>
                        <th>
                            @lang('lang.24h_change')
                        </th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($coins as $key => $currency)
                        <tr id="{{$currency->id}}">
                            <td class="hidden"></td>
                            <td>
                                <a href="{{url('coin')}}/{{$currency['symbol']}}">
                                    @if($currency['type'] == 'live')
                                        <img class="img_ico" src="https://www.cryptocompare.com/{{$currency['icon_url']}}" alt="{{$currency['name']}}">
                                    @else
                                        @if(file_exists('uploads/'.$currency['icon_url']) && !empty($currency['icon_url']))
                                            <img  class="img_ico" src="{{asset('uploads')}}/{{$currency['icon_url']}}" alt="{{$currency['name']}}">
                                        @else
                                            <img  class="img_ico" src="{{asset('assets/img/icon_set')}}/default.png" alt="{{$currency['name']}}">
                                        @endif
                                    @endif
                                    {{$currency['name']}} ({{$currency['symbol']}})
                                </a>
                            </td>
                            <td class="price">${{round($currency['price'], 4)}}</td>
                            <td>
                                @if ($currency['market_cap'] < 1000000)
                                    ${{number_format($currency['market_cap'])}}
                                @elseif ($currency['market_cap'] < 1000000000)
                                    ${{number_format($currency['market_cap'] / 1000000, 2) . ' M'}}
                                @else
                                    ${{ number_format($currency['market_cap'] / 1000000000, 2) . ' B'}}
                                @endif
                            </td>
                            <td>
                                @if ($currency['volume_24h'] < 1000000)
                                    ${{number_format($currency['volume_24h'])}}
                                @elseif ($currency['volume_24h'] < 1000000000)
                                    ${{number_format($currency['volume_24h'] / 1000000, 2) . ' M'}}
                                @else
                                    ${{ number_format($currency['volume_24h'] / 1000000000, 2) . ' B'}}
                                @endif
                            </td>
                            <td>
                                @if(strpos($currency['change_24h'], '-') !== false)
                                    <span class="red-color">
                                        <i class="mdi mdi-menu-down"></i>
                                   {{round($currency['change_24h'], 2)}} %
                                    </span>
                                @else
                                    <span class="green-color">
                                        <i class="mdi mdi-menu-up"></i>
                                    {{round($currency['change_24h'], 2)}}%
                                </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="text-center pag_links">
               {{$coins->links()}}
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>

@endsection


@section('script')
    <script src="{{asset('assets/libs/datatable/dataTables.min.js')}}"></script>

    <script>
    $('#coin-table').dataTable({
      'paging' : false,
      order: [
        [0, 'asc'],
      ],
    });
    </script>
@endsection
