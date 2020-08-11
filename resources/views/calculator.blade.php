@extends('layouts.app')
@section('title', __('lang.calculator'))
@section('description' , setting('description'))
@section('style')
<link href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div id="header" class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">@lang('lang.home')</a></li>
                <li class="active">@lang('lang.calculator')</li>
            </ol>
            <h1>@lang('lang.cryptocurrency_converter_calculator')</h1>
            <p>@lang('lang.calculate_your_cryptocurrency_in_other_currencies')</p>
        </div>
    </div>

    <div id="content">
        <div class="container">
        	<br>
            <br>
            <br>
            <div class="row">
            	<div class="col-lg-12">
                    <div class="calculator_wrapper">
                        <h1 class="text-center">
                            <span id="show_amount">1</span>
                            <span id="show_coin">{{$first->symbol}}</span> =
                            <span id="show_result">{{round($first->price, 4)}}</span>
                            <span id="show_currency">USD</span>
                        </h1>
                        <div class="mt-40">
                            <form class="m0_auto">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <select id="coin" class="form-control select2">
                                            @foreach($coins as $coin)
                                                <option value="{{$coin->symbol}}">
                                                    {{$coin->name}} ({{$coin->symbol}})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <select id="currency" class="form-control select2">
                                            <option value="USD" selected="selected">United States Dollars (USD)</option>
                                            <option value="EUR">Euro (EUR)</option>
                                            <option value="GBP">United Kingdom Pounds (GBP)</option>
                                            <option value="DZD">Algeria Dinars (DZD)</option>
                                            <option value="ARP">Argentina Pesos (ARP)</option>
                                            <option value="AUD">Australia Dollars (AUD)</option>
                                            <option value="ATS">Austria Schillings (ATS)</option>
                                            <option value="BSD">Bahamas Dollars (BSD)</option>
                                            <option value="BBD">Barbados Dollars (BBD)</option>
                                            <option value="BEF">Belgium Francs (BEF)</option>
                                            <option value="BMD">Bermuda Dollars (BMD)</option>
                                            <option value="BRR">Brazil Real (BRR)</option>
                                            <option value="BGL">Bulgaria Lev (BGL)</option>
                                            <option value="CAD">Canada Dollars (CAD)</option>
                                            <option value="CLP">Chile Pesos (CLP)</option>
                                            <option value="CNY">China Yuan Renmimbi (CNY)</option>
                                            <option value="CYP">Cyprus Pounds (CYP)</option>
                                            <option value="CSK">Czech Republic Koruna (CSK)</option>
                                            <option value="DKK">Denmark Kroner (DKK)</option>
                                            <option value="NLG">Dutch Guilders (NLG)</option>
                                            <option value="XCD">Eastern Caribbean Dollars (XCD)</option>
                                            <option value="EGP">Egypt Pounds (EGP)</option>
                                            <option value="FJD">Fiji Dollars (FJD)</option>
                                            <option value="FIM">Finland Markka (FIM)</option>
                                            <option value="FRF">France Francs (FRF)</option>
                                            <option value="DEM">Germany Deutsche Marks (DEM)</option>
                                            <option value="XAU">Gold Ounces (XAU)</option>
                                            <option value="GRD">Greece Drachmas (GRD)</option>
                                            <option value="HKD">Hong Kong Dollars (HKD)</option>
                                            <option value="HUF">Hungary Forint (HUF)</option>
                                            <option value="ISK">Iceland Krona (ISK)</option>
                                            <option value="INR">India Rupees (INR)</option>
                                            <option value="IDR">Indonesia Rupiah (IDR)</option>
                                            <option value="IEP">Ireland Punt (IEP)</option>
                                            <option value="ILS">Israel New Shekels (ILS)</option>
                                            <option value="ITL">Italy Lira (ITL)</option>
                                            <option value="JMD">Jamaica Dollars (JMD)</option>
                                            <option value="JPY">Japan Yen (JPY)</option>
                                            <option value="JOD">Jordan Dinar (JOD)</option>
                                            <option value="KRW">Korea (South) Won (KRW)</option>
                                            <option value="LBP">Lebanon Pounds (LBP)</option>
                                            <option value="LUF">Luxembourg Francs (LUF)</option>
                                            <option value="MYR">Malaysia Ringgit (MYR)</option>
                                            <option value="MXP">Mexico Pesos (MXP)</option>
                                            <option value="NLG">Netherlands Guilders (NLG)</option>
                                            <option value="NZD">New Zealand Dollars (NZD)</option>
                                            <option value="NOK">Norway Kroner (NOK)</option>
                                            <option value="PKR">Pakistan Rupees (PKR)</option>
                                            <option value="XPD">Palladium Ounces (XPD)</option>
                                            <option value="PHP">Philippines Pesos (PHP)</option>
                                            <option value="XPT">Platinum Ounces (XPT)</option>
                                            <option value="PLZ">Poland Zloty (PLZ)</option>
                                            <option value="PTE">Portugal Escudo (PTE)</option>
                                            <option value="ROL">Romania Leu (ROL)</option>
                                            <option value="RUR">Russia Rubles (RUR)</option>
                                            <option value="SAR">Saudi Arabia Riyal (SAR)</option>
                                            <option value="XAG">Silver Ounces (XAG)</option>
                                            <option value="SGD">Singapore Dollars (SGD)</option>
                                            <option value="SKK">Slovakia Koruna (SKK)</option>
                                            <option value="ZAR">South Africa Rand (ZAR)</option>
                                            <option value="KRW">South Korea Won (KRW)</option>
                                            <option value="ESP">Spain Pesetas (ESP)</option>
                                            <option value="XDR">Special Drawing Right (XDR) </option>
                                            <option value="SDD">Sudan Dinar (SDD)</option>
                                            <option value="SEK">Sweden Krona (SEK)</option>
                                            <option value="CHF">Switzerland Francs (CHF)</option>
                                            <option value="TWD">Taiwan Dollars (TWD)</option>
                                            <option value="THB">Thailand Baht (THB)</option>
                                            <option value="TTD">Trinidad and Tobago Dollars (TTD)</option>
                                            <option value="TRL">Turkey Lira (TRL)</option>
                                            <option value="VEB">Venezuela Bolivar (VEB)</option>
                                            <option value="ZMK">Zambia Kwacha (ZMK)</option>
                                            <option value="EUR">Euro (EUR)</option>
                                            <option value="XCD">Eastern Caribbean Dollars (XCD)</option>
                                            <option value="XDR">Special Drawing Right (XDR)</option>
                                            <option value="XAG">Silver Ounces (XAG)</option>
                                            <option value="XAU">Gold Ounces (XAU)</option>
                                            <option value="XPD">Palladium Ounces (XPD)</option>
                                            <option value="XPT">Platinum Ounces (XPT)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="1" value="1" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-default btn-lg btn-block" id="calculate_btn">@lang('lang.calculate')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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


