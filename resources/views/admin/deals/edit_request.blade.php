<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form method="POST" action="{{url('admin/deals/'.$deal->id)}}">
            @csrf
            @method('PATCH')
            <div class="modal-header">
                <h3 class="modal-title">@lang('lang.edit_deal')</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id" value="{{ $deal->id }}">
                <div class="row">
                    <div class="col-sm-12 text-right">
                        @if (file_exists('uploads/'.$deal->image) && !empty($deal->image))
                            <img class="img_ico img-rounded img-thumbnail" src="{{asset('uploads')}}/{{$deal->image}}" alt="{{$deal->title}}">
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>@lang('lang.title')*</label>
                            <input type="text" name="title" class="form-control" required value="{{ old('title') ?? $deal->title }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>@lang('lang.image')</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>@lang('lang.link')*</label>
                    <input type="text" name="link" class="form-control" required value="{{ old('link') ?? $deal->link }}">
                </div>

                <div class="form-group">
                    <label>@lang('lang.description')</label>
                    <textarea name="description" class="form-control">{{ old('description') ?? $deal->description }}</textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">@lang('lang.cancel')</button>
                <button type="submit" class="btn btn-lg btn-primary">@lang('lang.submit')</button>
            </div>
        </form>
    </div>
</div>
