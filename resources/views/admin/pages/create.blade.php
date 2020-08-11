@extends('layouts.admin')
@section('title', __('lang.add_page'))

@section('style')
    <link rel="stylesheet" href="{{asset('assets/libs/summernote/summernote.css')}}"/>
@endsection

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
                        <h1 class="header-title">@lang('lang.add_page')</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/pages')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name">@lang('lang.title')*</label>
                                <input type="text" class="form-control"  name="title" value="{!!  old('title') !!}" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>@lang('lang.slug')*</label>
                                <input type="text" required class="form-control" name="slug" value="{{ old('slug') }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('lang.featured_image')</label>
                                <input type="file" class="form-control" name="image" accept="image/x-png,image/gif,image/jpeg">
                            </div>

                            <div class="form-group">
                                <label>@lang('lang.page_placement_in')*</label>
                                <select name="placement" class="form-control">
                                    <option value="header">@lang('lang.header')</option>
                                    <option value="footer" selected>@lang('lang.footer')</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>@lang('lang.meta_description')</label>
                                <textarea name="meta_description" class="form-control" id="meta_description">{{old('meta_description')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>@lang('lang.content')*</label>
                                <div id="editor-container"></div>
                                <textarea name="description" class="form-control" id="description">{!!old('description')!!}</textarea>
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


