@extends('layouts.app')
@section('title', $blog1->title)
@section('description' , $blog1->meta_description)
@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">>@lang('lang.blog')</li>
                <li class="active">{{ $blog1->title }}</li>
            </ol>
            <h1>{{ $blog1->title }}</h1>
            <p><small>@lang('lang.posted_on'): {{ date_format($blog1->created_at,"d-M-Y") }}</small></p>
        </div>
    </div>

    <div id="content">
        <div class="container">
            <br>
            <div class="row">
                <div class="col-sm-offset-2 col-sm-8">
                    <div class="post_wrapper">
                        <h3>{{ $blog1->title }}</h3>
                        @if($blog1->image)
                            <img src="{{ asset('uploads/'.$blog1->image) }}" class="img-responsive img-rounded">
                        @endif
                        <p>
                            {!! str_replace('font-family: "Open Sans", Arial, sans-serif;', '', $blog1->description) !!}
                        </p>
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
