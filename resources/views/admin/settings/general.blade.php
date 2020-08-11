@extends('layouts.admin')
@section('title', __('lang.settings'))

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
        <form action="{{url('admin/settings/general')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h1 class="header-title">@lang('lang.settings')</h1>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.site_title')*</label>
                                        <input type="text" class="form-control "  name="title" placeholder="Enter Title" value="{{ setting('site_title') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.site_url')*</label>
                                        <input type="text" class="form-control"  name="site_url" placeholder="Enter URL" value="{{ setting('site_url')}}" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.site_logo')</label>
                                        <input type="file" class="form-control"  name="site_logo" value="{{ setting('site_logo')}}">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="name">@lang('lang.copyright')*</label>
                                <input type="text" class="form-control"  name="copyright" value="{{ setting('copyright')}}" required>
                            </div>

                            <div class="form-group">
                                <label for="name">@lang('lang.keywords')</label>
                                <input type="text" class="form-control"  name="keywords" value="{{ setting('keywords')}}">
                            </div>


                            <div class="form-group">
                                <label for="name">@lang('lang.description')</label>
                                <textarea name="description" class="form-control">{{setting('description')}}</textarea>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label>@lang('lang.google_analytics')</label>
                                <textarea name="analytics" class="form-control">{{setting('analytics')}}</textarea>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input {{(setting('captcha_status')) == 'on' ? 'checked' : ''}} type="checkbox" name="captcha_status" class="custom-control-input" id="captcha">
                                    <label class="custom-control-label captcha_status" for="captcha"> @lang('lang.enable_recaptcha')</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group site_key" {{(setting('captcha_status')) == 'on' ? '' : 'style=display:none'}}>
                                    <label for="name">@lang('lang.captcha_site_key')</label>
                                    <input type="text" class="form-control"  name="site_key" value="{{ setting('site_key')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h1 class="header-title">Logo</h1>
                        </div>
                        <div class="card-body">
                            @if(!empty(setting('logo')))
                                <img src="{{asset('assets/img')}}/{{setting('logo')}}" class="img-fluid"/>
                            @endif
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h1 class="header-title">@lang('lang.social_links')</h1>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>@lang('lang.facebook')</label>
                                <input type="text" name="facebook" class="form-control" value="{{setting('facebook')}}">
                            </div>
                            <div class="form-group">
                                <label>@lang('lang.twitter')</label>
                                <input type="text" name="twitter" class="form-control" value="{{setting('twitter')}}">
                            </div>
                            <div class="form-group">
                                <label>@lang('lang.instagram')</label>
                                <input type="text" name="instagram" class="form-control" value="{{setting('instagram')}}">
                            </div>
                            <div class="form-group">
                                <label>@lang('lang.linkedin')</label>
                                <input type="text" name="linkedin" class="form-control" value="{{setting('linkedin')}}">
                            </div>
                            <div class="form-group">
                                <label>@lang('lang.google_plus')</label>
                                <input type="text" name="google_plus"  class="form-control" value="{{setting('google_plus')}}">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">@lang('lang.update_settings')</button>
            </div>
        </form>
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


