@extends('layouts.app')
@section('title', $page->title)
@section('description' , $page->meta_description)

@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">@lang('lang.page')</li>
                <li class="active">{{ $page->title }}</li>
            </ol>
            <h1>{{ $page->title }}</h1>
            <p><small>@lang('lang.added_on'): {{ date_format($page->created_at,"d-m-Y") }}</small></p>
        </div>
    </div>

    <div id="content">
        <div class="container">
        	<br>
            <div class="row">
            	<div class="col-lg-12">
                    <div class="post_wrapper">
                        <h3>
                            {{ $page->title }}
                        </h3>
                		@if($page->image)
                			<img src="{{ asset('uploads/'.$page->image) }}" class="img-responsive img-rounded">
                		@endif
                		<p>{!! str_replace('font-family: "Open Sans", Arial, sans-serif;', '', $page->description) !!}</p>
                    </div>
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
