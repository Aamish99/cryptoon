<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form method="POST" action="{{url('admin/users/'.$user->id)}}">
            @csrf
            @method('PATCH')
            <div class="modal-header">
                <h3 class="modal-title">@lang('lang.edit_user')</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                <div class="form-group">
                    <label for="name">@lang('lang.name')*</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $user->name }}" autocomplete="name" required>
                </div>
                <div class="form-group">
                    <label for="email">@lang('lang.email_address')*</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') ?? $user->email }}" autocomplete="email" required>
                </div>

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

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        @if ($user->role == "1")
                            <input type="checkbox" name="role" class="custom-control-input" id="customSwitch12" checked="checked">
                            <label class="custom-control-label" for="customSwitch12">@lang('lang.turn_on_to_make_this_admin')</label>
                        @else
                            <input type="checkbox" name="role" class="custom-control-input" id="customSwitch12">
                            <label class="custom-control-label" for="customSwitch12">@lang('lang.turn_on_to_make_this_admin')</label>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">@lang('lang.cancel')</button>
                <button type="submit" class="btn btn-lg btn-primary">@lang('lang.submit')</button>
            </div>
        </form>
    </div>
</div>
