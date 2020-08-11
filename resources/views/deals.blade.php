@extends('layouts.app')
@section('title',  __('lang.deals'))
@section('description' , setting('description'))
@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">@lang('lang.deals')</li>
            </ol>
            <h1>@lang('lang.deals')</h1>
        </div>
    </div>

    <div id="content">
        <div class="container">
            <br>
            @if(Session::has('error'))
                <br>
                <div class="alert alert-danger">
                    <stront>Oops! </stront> {{Session::get('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <br>
            <div class="row">
                @foreach($links as $item)
                    <div class="col-sm-4">
                        <div class="card deal_card">
                            <div class="deal_cover" style="background-image: url('{{asset('uploads')}}/{{$item->image}}')"></div>
                            <div class="card-body">
                                <h3 class="card-title">{{$item->title}}</h3>
                                <p class="card-text">{{$item->description}}</p>
                                <a href="{{$item->link}}" target="_blank" class="btn btn-primary">@lang('lang.get_deal') <i class="fas fa-external-link-alt"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <br>
            <br>
            <br>

            <div class="text-center pag_links">
                {{$links->links() }}
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
@endsection
