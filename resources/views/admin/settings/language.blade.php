@extends('layouts.admin')
@section('title', __('lang.languages'))

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
        <h1>@lang('auth.lang')</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h1 class="header-title">@lang('lang.languages')</h1>
                        <div class="ml-auto text-right">
                            <a href="#!" class="btn btn-danger delete_btn d_none language">
                                @lang('lang.delete')
                            </a>
                            <a href="javascript:;" data-toggle="modal" data-target="#add-modal" class="btn btn-primary">
                                @lang('lang.add_new')
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
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.short_name')</th>
                                    <th>@lang('lang.default')</th>
                                    <th>@lang('lang.download_file')</th>
                                </tr>
                                </thead>
                                <tbody class="list">

                                @foreach($languages as $key => $item)
                                    <tr id="{{$item->id}}">
                                        <td class="sl_box"></td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->short_name}}</td>
                                        <td>
                                            <div class="custom-control custom-switch lang">
                                                <input type="checkbox" {{($item->default) == true ? 'checked' : ''}} name="role" class="custom-control-input" id="switch{{$item->id}}" value="{{$item->short_name}}">
                                                <label class="custom-control-label" for="switch{{$item->id}}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" data-toggle="tooltip" title="Download Files" href="{{url('admin/language/download')}}/{{$item->id}}">
                                               <i class="fe fe-download"></i>
                                            </a>
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
                    <button class="btn btn-primary btn-yes-language">@lang('lang.delete')</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="add-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{url('admin/settings/language')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h3 class="modal-title">@lang('lang.add_language')</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('lang.name')</label>
                            <input type="text" name="name" class="form-control" placeholder="ie. English">
                        </div>
                        <div class="form-group">
                            <label>@lang('lang.short_name') <small>(@lang('lang.unique_name'))</small></label>
                            <input type="text" name="short_name" class="form-control" placeholder="ie. en">
                        </div>
                        <div class="form-group">
                            <label>@lang('lang.zip_file') <small>(@lang('lang.only_zip_file'))</small></label>
                            <input type="file" name="zip_file" class="form-control" placeholder="ie. en" accept=".zip,.rar,.7zip">
                            <br>
                            <p class="text-right"><a download href="{{asset('en.zip')}}">@lang('lang.download_sample_zip_file')</a></p>
                        </div>
                        <p><strong>Note:</strong> @lang('lang.zip_folder_name_should_match_with_short_name')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('lang.submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


