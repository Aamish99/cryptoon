@extends('layouts.admin')
@section('title', __('lang.profile'))

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
                        <h1 class="header-title">@lang('lang.profile')</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/profile')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name">@lang('lang.name')*</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $user->name }}" autocomplete="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">@lang('lang.email_address')*</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') ?? $user->email }}" required>
                            </div>
                            @if (file_exists('uploads/'.$user->avatar) && !empty($user->avatar))
                                <br>
                                <img class="img_ico_xl img-thumbnail" src="{{asset('uploads')}}/{{$user->avatar}}" alt="{{$user->name}}">
                                <br>
                                <br>
                            @endif
                            <div class="form-group">
                                <label>@lang('lang.avatar')</label>
                                <input type="file" class="form-control" name="avatar" accept="image/x-png,image/gif,image/jpeg">
                            </div>
                            <hr>
                            <h3>@lang('lang.change_password')</h3>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">@lang('lang.password')</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password-confirm">@lang('lang.confirm_password')</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
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


