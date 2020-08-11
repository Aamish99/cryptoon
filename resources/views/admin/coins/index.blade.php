@extends('layouts.admin')
@section('title',  __('lang.coins'))
@section('content')
    <br>
    @if($errors->all())
        <div class="container-fluid">
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }} <br>
                @endforeach
            </div>
        </div>
        <br>
    @endif


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h1 class="header-title">@lang('lang.coins')</h1>
                        <div class="ml-auto text-right">
                            <a href="#!" class="btn btn-danger delete_btn icon d_none">
                               Delete
                            </a>
                            <a href="#!" data-toggle="modal" data-target="#add-coin" class="btn btn-primary">
                                @lang('lang.add_coin')
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table card-table">
                                <thead>
                                <tr>
                                    <th class="sl_box">
                                        <button id="select_all">
                                            <i class="fe fe-square"></i>
                                        </button>
                                    </th>
                                    <th>@lang('lang.icon')</th>
                                    <th>@lang('lang.symbol')</th>
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.price')</th>
                                    <th>@lang('lang.market_cap')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                                </thead>
                                <tbody class="list">

                                @foreach($coins as $item)
                                    @if(!($item->trashed()))

                                    <tr id="{{$item->id}}">
                                        <td class="sl_box"></td>
                                        <td>
                                            @if($item->type == 'live')
                                                <img class="img_ico" src="https://www.cryptocompare.com/{{$item->icon_url}}">
                                            @else
                                                @if(file_exists('uploads/'.$item->icon_url) && !empty($item->icon_url))
                                                    <img class="img_ico" src="{{asset('uploads')}}/{{$item->icon_url}}" alt="{{$item->name}}">
                                                @else
                                                    <img class="img_ico" src="{{asset('assets/img/icon_set')}}/default.png" alt="{{$item->name}}">
                                                @endif
                                            @endif
                                        </td>
                                            <td>{{$item->symbol}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>${{round($item->price, 4)}}</td>
                                            <td>
                                                @if ($item->market_cap < 1000000)
                                                    ${{number_format($item->market_cap)}}
                                                @elseif ($item->market_cap < 1000000000)
                                                    ${{number_format($item->market_cap / 1000000, 2) . ' M'}}
                                                @else
                                                    ${{ number_format($item->market_cap / 1000000000, 2) . ' B'}}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{url('admin/coins')}}/{{$item->id}}/edit" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit">
                                                    <i class="fe fe-edit-2"></i>
                                                </a>
                                                <a target="_blank" href="{{url('coin')}}/{{$item->symbol}}" class="btn btn-success btn-sm" data-toggle="tooltip" title="View">
                                                    <i class="fe fe-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="add-coin">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{url('admin/coins')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h3 class="modal-title">@lang('lang.add_coin')</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('lang.select_coins')</label>
                            <select name="coins[]" multiple class="form-control select2 required" required>
                                @foreach($coins as $item)
                                    @if($item->trashed())
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('lang.submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="icon_delete_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">@lang('lang.delete_coin')</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success alert-dismissible fade delete-alert mt-0" role="alert">
                        <strong>@lang('lang.success')! </strong> @lang('lang.coin_successfully_deleted').
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <p>
                        @lang('lang.delete_confirmation')
                    </p>
                </div>

                <div class="modal-footer ">
                    <button class="btn btn-secondary" data-dismiss="modal">@lang('lang.cancel')</button>
                    <button class="btn btn-primary btn-yes">@lang('lang.delete')</button>
                </div>
            </div>
        </div>
    </div>
@endsection





