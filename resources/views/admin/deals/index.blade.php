@extends('layouts.admin')
@section('title',  __('lang.deals'))
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

    <div class="container-fluid delete-alert d_none">
        <div class="alert alert-danger" role="alert">
            <strong>Success! </strong> @lang('lang.deal_delete_alert')
        </div>
        <br>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h1 class="header-title">@lang('lang.deals')</h1>
                        <div class="ml-auto text-right">
                            <a href="#!" class="btn btn-danger delete_btn deal d_none">
                                @lang('lang.delete')
                            </a>
                            <a href="#!" data-toggle="modal" data-target="#add-coin" class="btn btn-primary ">
                                 @lang('lang.add_deal')
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
                                    <th>@lang('lang.image')</th>
                                    <th>@lang('lang.title')</th>
                                    <th>@lang('lang.link')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach($deals as $item)
                                        <tr id="{{$item->id}}">
                                            <td class="sl_box"></td>
                                           <td>
                                               @if (file_exists('uploads/'.$item->image) && !empty($item->image))
                                                   <img height="25px" src="{{asset('uploads')}}/{{$item->image}}" alt="{{$item->title}}">
                                               @endif
                                           </td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->link}}</td>
                                            <td>
                                                <button value="{{$item->id}}" class="btn btn-primary btn-sm edit_deal" data-toggle="tooltip" title="Edit">
                                                    <i class="fe fe-edit-2"></i>
                                                </button>
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


    <div class="modal fade" tabindex="-1" role="dialog" id="add-coin">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{url('admin/deals')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h3 class="modal-title">@lang('lang.add_deal')</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>@lang('lang.title')*</label>
                                    <input type="text" name="title" class="form-control" required value="{{old('title')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label>@lang('lang.image')*</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>@lang('lang.link')*</label>
                            <input type="text" name="link" class="form-control" required value="{{old('link')}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('lang.description')</label>
                            <textarea name="description" class="form-control">{{old('description')}}</textarea>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal"></div>

    <div class="modal fade" id="deal_delete_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">@lang('lang.delete_deal')</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        @lang('lang.delete_confirmation')
                    </p>
                </div>

                <div class="modal-footer ">
                    <button class="btn btn-secondary" data-dismiss="modal">@lang('lang.cancel')</button>
                    <button class="btn btn-primary btn-yes-deal">@lang('lang.delete')</button>
                </div>
            </div>
        </div>
    </div>
@endsection


