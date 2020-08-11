@extends('layouts.app')
@section('title', $exchange->name)
@section('description' , $exchange->description)
@section('content')
    <div class="coin-detail">
        <div class="container">
            <div class="coin-data">
                <ul>
                    <li>
                        <div class="icon-image">
                            @if($exchange->type == 'live')
                                <img src="https://www.cryptocompare.com/{{$exchange->logo_url}}">
                            @else
                                @if(file_exists('uploads/'.$exchange->logo_url) && !empty($exchange->logo_url))
                                    <img src="{{asset('uploads')}}/{{$exchange->logo_url}}" alt="{{$exchange->name}}">
                                @else
                                    <img src="{{asset('assets/img/icon_set')}}/default.png" alt="{{$exchange->name}}">
                                @endif
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="icon-tag">
                            <p>@lang('lang.exchange')</p>
                            <h4>{{$exchange['name']}}</h4>
                        </div>
                    </li>
                    <li class="hidden-xs">
                        <div class="icon-tag">
                            <p>@lang('lang.grade_points')</p>
                            <h4>{{$exchange->grade_points}}</h4>
                        </div>
                    </li>
                    <li class="hidden-xs">
                        <div class="icon-tag">
                            <p>@lang('lang.grade')</p>
                            <h4>{{$exchange->grade}}</h4>
                        </div>
                    </li>
                    <li class="hidden-xs">
                        <div class="icon-tag">
                            <p>@lang('lang.market_quality')</p>
                            <h4>{{$exchange->market_quality}}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="icon-tag">
                            <p>@lang('lang.average_rating')</p>
                            <span class="stars f_0">{{$exchange->avg_rating}}</span>
                        </div>
                    </li>
                    <li class="hidden-xs">
                        <div class="icon-tag">
                            <p></p>
                            <a target="_blank" href="{{$exchange->affiliate_url}}" class="btn btn-primary">@lang('lang.go_to_site')</a>
                            <a href="{{url('compare/exchanges')}}?name={{str_replace(' ', '-', strtolower($exchange->name))}}" class="btn btn-primary">@lang('lang.compare')</a>
                        </div>
                    </li>
                </ul>

                <br>
                <p class="description_text">{{substr($exchange->description, 0, 200) }}...</p>
                <div class="text-center visible-xs">
                    <br>
                    <div class="icon-tag">
                        <p></p>
                        <a target="_blank" href="{{$exchange->affiliate_url}}" class="btn btn-primary">@lang('lang.go_to_site')</a>
                        <a href="{{url('compare/exchanges')}}?name={{str_replace(' ', '-', strtolower($exchange->name))}}" class="btn btn-primary">@lang('lang.compare')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page_reviews" id="reviews">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <h2>{{$exchange->name}} @lang('lang.reviews')</h2>

                    @if($errors->all())
                        <br>
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(Session::has('werror'))
                        <br>
                        <div class="alert alert-danger">
                            {{Session::get('werror')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(Session::has('rsuccess'))
                        <br>
                        <div class="alert alert-success">
                            {{Session::get('rsuccess')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(Auth::check())
                        <br>

                        <form action="{{url('review')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="exchange_id" value="{{$exchange->id}}">
                            <div class="add_review">
                                <h4>@lang('lang.add_review')
                                    <div class="rating pull-right"></div>
                                </h4>

                                <div class="form-group">
                                    <textarea name="review" class="form-control" placeholder="Add Review" required>{{old('review')}}</textarea>
                                </div>

                                @if(setting('captcha_status') == 'on' && setting('site_key') != null)
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{setting('site_key')}}"></div>
                                        <script src='https://www.google.com/recaptcha/api.js'></script>
                                    </div>
                                @endif

                                <div class="form-group text-right">
                                    <input type="submit" class="btn btn-secondary" value="Submit">
                                </div>
                            </div>
                        </form>

                    @else
                        <div class="check_log">
                            Please <a class="btn btn-secondary" href="{{url('login')}}">login</a> to add your review
                        </div>
                    @endif
                    <br>

                    @foreach($reviews as $item)
                        <div class="review_block">
                            <div class="media">
                                <div class="media-left">
                                    <img class="media-object" src="{{asset('assets/img/default-avatar.png')}}" alt="avatar">
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$item->user->name}}</h4>
                                    <p>
                                        <span class="stars f_0">{{$item->rating}}</span>
                                    </p>
                                    {{$item->review}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($reviews->isEmpty())
                        <p class="text-center">No review available. Be the first to add review</p>
                    @endif
                </div>

                <div class="col-sm-5">
                    <div class="ex_extra">
                        <h2>@lang('lang.address')</h2>
                        <p>{{$exchange->full_address}}</p>
                        <h2>@lang('lang.deposit_methods')</h2>
                        <p>{{$exchange->deposit_methods}}</p>
                        <h2>@lang('lang.withdrawal_methods')</h2>
                        <p>{{$exchange->withdrawal_methods}}</p>
                        <h2>@lang('lang.country')</h2>
                        <p>{{$exchange->country}}</p>
                        <h2>@lang('lang.description')</h2>
                        <p>{{$exchange->description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src='{{asset('assets/libs/star-rating/star.rating.min.js')}}'></script>
    <script>
    $('.rating').addRating({
      max : 5,
      icon : 'star',
      fieldName : 'rating',
      fieldId : 'rating'
    });
    </script>
@endsection
