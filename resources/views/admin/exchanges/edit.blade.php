@extends('layouts.admin')
@section('title', __('lang.edit_exchange'))
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
                        <h1 class="header-title">@lang('lang.edit_exchange')</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/exchanges', $exchange->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.name')*</label>
                                        <input type="text" class="form-control"  name="name" placeholder="Enter Title" value="{{ old('name') ?? $exchange->name }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.grade_point')</label>
                                        <input type="number" step="0.000001" class="form-control"  name="grade_point"  value="{{ old('grade_points') ?? $exchange->grade_points }}" placeholder="3.4">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.grade_point')*</label>
                                        <input type="text" class="form-control"  name="grade" value="{{ old('grade') ?? $exchange->grade }}" placeholder="A" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.market_quality')</label>
                                        <input type="text" class="form-control" name="market_quality" value="{{ old('market_quality') ?? $exchange->market_quality }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.country')*</label>
                                        <input type="text" class="form-control"  name="country"  value="{{ old('country') ?? $exchange->country }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    @if($exchange->type == 'live')
                                        <img class="img_ico" src="https://www.cryptocompare.com/{{$exchange->logo_url}}">
                                    @else
                                        @if(file_exists('uploads/'.$exchange->logo_url ) && !empty($exchange->logo_url))
                                            <img class="img_ico" src="{{asset('uploads')}}/{{$exchange->logo_url}}" alt="{{$exchange->name}}">
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>@lang('lang.icon')</label>
                                        <input type="file" class="form-control" name="icon" accept="image/x-png,image/gif,image/jpeg">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.affiliate_url')*</label>
                                        <input type="text" class="form-control"  name="affiliate_url" value="{{ old('affiliate_url') ?? $exchange->affiliate_url }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.address')*</label>
                                        <textarea class="form-control"  name="address" required>{{ old('address') ?? $exchange->full_address }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.description')*</label>
                                        <textarea class="form-control"  name="description" required>{{ old('description') ?? $exchange->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.deposit_methods')</label>
                                        <textarea class="form-control"  name="deposit_methods">{{ old('deposit_methods') ?? $exchange->deposit_methods }}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.withdrawal_methods')</label>
                                        <textarea class="form-control"  name="withdrawal_methods">{{ old('withdrawal_methods') ?? $exchange->withdrawal_methods }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">@lang('lang.submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



