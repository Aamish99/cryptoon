@extends('layouts.app')
@section('title', 'Error')
@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">Error</li>
            </ol>
            <h1>Error</h1>
        </div>
    </div>

    <div class="error-content text-center">
        <div class="container">
            <h1 class="text-uppercase">404</h1>
            <p><strong>Whoops!</strong> Looks like this page doesn't exist</p>
            <br>
            <a href="{{url('/')}}"><i class="mdi mdi-keyboard-return"></i> Back to Home</a>
        </div>
    </div>
    <br>
    <br>
    <br>
@endsection
