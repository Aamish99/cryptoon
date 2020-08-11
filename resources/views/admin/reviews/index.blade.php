@extends('layouts.admin')
@section('title', __('lang.reviews'))
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
                        <h1 class="header-title">@lang('lang.reviews')</h1>
                        <div class="ml-auto text-right">
                            <a href="#!" class="btn btn-danger delete_btn review">
                                @lang('lang.delete')
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
                                    <th>@lang('lang.user')</th>
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
                                        <td class="sl_box"></td>
                                        <td>
                                            {{$item->user->name}}
                                        </td>
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
                                            <button value="{{$item->id}}" class="btn btn-primary btn-sm btn-view" data-toggle="tooltip" title="View"><i class="fe fe-eye"></i></button>
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

    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">@lang('lang.delete')</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        @lang('lang.delete_confirmation')?
                    </p>
                </div>
                <div class="modal-footer ">
                    <button class="btn btn-secondary" data-dismiss="modal">@lang('lang.cancel')</button>
                    <button class="btn btn-primary btn-yes-review">@lang('lang.delete')</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="view-modal"></div>
@endsection


