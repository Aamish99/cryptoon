@extends('layouts.app')
@section('title', 'Blog')
@section('description' , setting('description'))
@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">@lang('lang.blog')</li>
            </ol>
            <h1>@lang('lang.blog')</h1>
            <p>@lang('lang.our_blog_section')</p>
        </div>
    </div>

    <div id="content">
        <div class="container">
        	<div class="row">
                <br>
                <br>
                <div class="col-sm-8 col-sm-offset-2">
        		@foreach($blog as $blog)

						<article class="article">
                            <h3>
                                <a href="{{ url('blog/'.$blog->slug) }}">{{ $blog->title }}</a>
                            </h3>
							@if($blog->image)
                                <div class="blog_imag" style="background:url('{{ asset('uploads/'.$blog->image) }}')"></div>
							@endif
                            <p class="detail">
                                <span class="text-muted">@lang('lang.posted_on') {{$blog->created_at->format('d-M-Y')}}</span>
                            </p>
                            <figcaption class="figure-caption text-left">
                                <p>
                                    {{$blog->meta_description}}<br /><br />
                                </p>
                                <p class="text-right">
                                    <a href="{{ url('blog/'.$blog->slug) }}" class="btn btn-default" role="button">@lang('lang.read_more')</a>
                                </p>
                            </figcaption>
						</article>

			    @endforeach
                </div>
		    </div>
            <br>
            <br>
            <br>
        </div>
    </div>
    <br>
    <br>
    <br>
@endsection
