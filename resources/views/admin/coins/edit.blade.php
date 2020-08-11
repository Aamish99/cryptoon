@extends('layouts.admin')
@section('title', __('lang.edit_coin'))
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
                        <h1 class="header-title">@lang('lang.edit_coin')</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/coins', $coin->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.name')*</label>
                                        <input type="text" class="form-control" name="name" value="{{ $coin->name }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>@lang('lang.symbol')*</label>
                                        <input type="text" required class="form-control" name="symbol" value="{{$coin->symbol }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    @if($coin['type'] == 'live')
                                        <img class="img_ico" src="https://www.cryptocompare.com/{{$coin['icon_url']}}">
                                    @else
                                        @if(file_exists('uploads/'.$coin['icon_url']) && !empty($coin['icon_url']))
                                            <img class="img_ico" src="{{asset('uploads')}}/{{$coin['icon_url']}}" alt="{{$coin['name']}}">
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
                                        <label>@lang('lang.price')sdf($)*</label>
                                        <input type="number" step="0.000001" class="form-control" name="price" required value="{{ old('price') ?? $coin->price }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>@lang('lang.market_cap')</label>
                                    <div class="form-group">
                                    <input type="number" step="0.000001" class="form-control" name="market_cap" value="{{ old('market_cap') ?? $coin->market_cap }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>@lang('lang.24h_volume') ($)</label>
                                    <div class="form-group">
                                    <input type="number" step="0.000001" class="form-control" name="volume_24h" value="{{ old('volume_24h') ?? $coin->volume_24h }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>@lang('lang.supply')</label>
                                    <div class="form-group">
                                    <input type="number" step="0.000001" class="form-control" name="supply" value="{{ old('supply') ?? $coin->supply }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label></label>
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            @if ($coin->trending == "true")
                                                <input type="checkbox" name="trending" class="custom-control-input" id="switchOnOffVisibility1" checked="checked">
                                                <label class="custom-control-label" for="switchOnOffVisibility1">@lang('lang.trending')</label>
                                            @else
                                                <input type="checkbox" name="trending" class="custom-control-input" id="switchOnOffVisibility1">
                                                <label class="custom-control-label" for="switchOnOffVisibility1">@lang('lang.trending')</label>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label>@lang('lang.description')</label>
                            <div class="form-group">
                                <textarea name="description" class="form-control">{{ old('description') ?? $coin->description }}</textarea>
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
@section('script')
    <script src="{{asset('assets/libs/summernote/summernote.min.js')}}"></script>
    <script>
    $(document).ready(function() {
      $('#description').summernote({
        placeholder: 'add content',
        tabsize: 2,
        height: 100,
        popover: {
          image: [],
          link: [],
          air: []
        },
        toolbar: [
          ["style", ["style"]],
          ["font", ["bold", "underline", "clear"]],
          ["fontname", false],
          ["color", ["color"]],
          ["para", ["ul", "ol", "paragraph"]],
          //["table", ["table"]],
          //["insert", ["link", "picture", "video"]],
          ["view", ["fullscreen", "codeview", "help"]]
        ],
      });
    });
    </script>
@endsection


