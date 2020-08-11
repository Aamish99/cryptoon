<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Coin;
use App\Models\Exchange;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class TradingController extends Controller
{
    /*
     * get exchanges according cheapest rate
     * *******************************/
    public function coinTrading(Request $request,$action, $coin){
        $coins = Coin::all();

        if(Session::has('filter_exchanges') && Session::get('filter_coin') == $coin){
            $trading_exchanges= Session::get('filter_exchanges');
            return view('trading', compact('action', 'coin','request','coins', 'trading_exchanges'));

        }
        $total_exchanges = Exchange::count();
        if($total_exchanges > 9)
            $exchanges = Exchange::all()->random(10);
        else
            $exchanges = Exchange::all()->random($total_exchanges);

        $trading_exchanges = [];
        $currency =  Coin::where('symbol', $coin)->first();
        if($currency){
            $price['USD'] = $currency->price;
            $price = number_format($price['USD'], 6,  '.', '');
            $n_price = $price - ($price * (4/100));
            $n_price =  number_format($n_price, 6,  '.', '');
            $p_price = $price + ($price * (4/100));
            $p_price = number_format($p_price, 6,  '.', '');
            foreach ($exchanges as $key => $ex){
                $ex = $ex->toArray();
                if($price < 1) {
                    $random = mt_rand($n_price * 1000000, $p_price * 1000000) / 1000000;
                    $random = number_format($random, 6, '.', '');
                }else{
                    $random = rand($n_price,$p_price);
                    $float = rand(1000, 9999);
                    $random = $random.'.'.$float;
                }
                $ex['price'] = $random;
                $trading_exchanges[$key] = $ex;
            }
        }
        usort($trading_exchanges, function($a, $b) {
            return $a['price'] <=> $b['price'];
        });

        Session::put('filter_exchanges', $trading_exchanges);
        Session::put('filter_coin', $coin);
        return view('trading', compact('action', 'coin','request','coins', 'trading_exchanges'));
    }

    /*
    * Insert alert to database
    **************************/
    public function priceAlert(Request $request){
        $this->validate($request, [
            'alert_price' => 'required|numeric|between:0,999999.99',
            'alert_email' => 'required|email',
            'coin' => 'required',
        ]);
        $alert = new Alert();
        $alert->coin = $request->coin;
        $alert->price_alert = $request->alert_price;
        $alert->email = $request->alert_email;
        $alert->recent_activity = now();
        $alert->save();
        return __('lang.alert_success');
    }

    public function exchanges(Request $request){
        $exchanges = Exchange::orderBy('avg_rating', 'desc')->paginate(120);
        return view('exchanges', compact('exchanges', 'request'));
    }

    public function exchangeDetail($name){
        if(empty($name))
            return redirect()->back()->withError('No exchange exist with this name');

        $name = str_replace('-', ' ', $name);
        $exchange = Exchange::where('name', $name)->first();
        if(!($exchange)){
            $name = str_replace(' ', '-', $name);
            $exchange = Exchange::where('name', $name)->first();
        }
        $reviews = Review::where('exchange_id', $exchange->id)->orderBy('id', 'desc')->get();
        return view('exchangeDetail', compact('exchange', 'reviews'));
    }
}
