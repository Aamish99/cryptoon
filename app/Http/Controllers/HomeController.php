<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Deal;
use App\Models\Exchange;
use App\Models\Language;
use App\Models\Review;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    /*
    * home page
    ***********************/
    public function index()
    {
        $coins = Coin::orderBy('market_cap', 'desc')->get();
        $gainers = $coins->toArray();
        $exchanges = Exchange::orderBy('avg_rating', 'desc')->take(4)->get();
        $page_number = 1;
        usort($gainers, function($a, $b) {
            return $a['change_24h'] <= $b['change_24h'];
        });

        return view('welcome', compact('coins', 'gainers', 'page_number', 'exchanges'));
    }

    /*
    * Coins page
    ***********************/
    public function coins(){
        $coins = Coin::orderBy('market_cap', 'desc')->paginate(100);
        return view('coins', compact('coins'));
    }

    /*
    * Coin detail page
    ***********************/
    public function coinDetail($name){

        $currency = Coin::where('symbol', $name)->first();
        if($currency) {
            if(Session::has('filter_exchanges') && Session::get('filter_coin') == $name){
                $trading_exchanges = Session::get('filter_exchanges');
            }else{
                $total_exchanges = Exchange::count();
                if($total_exchanges > 9)
                    $exchanges = Exchange::all()->random(10);
                else
                    $exchanges = Exchange::all()->random($total_exchanges);

                $exchanges = Exchange::all()->random(3);
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
                usort($trading_exchanges, function ($a, $b) {
                    return $a['price'] <=> $b['price'];
                });

                Session::put('filter_exchanges', $trading_exchanges);
                Session::put('filter_coin', $name);
            }
            $reviews = Review::where('coin_id', $currency->id)->orderBy('id', 'desc')->get();
            return view('coinDetail', compact('currency', 'trading_exchanges', 'reviews'));
        }
        return redirect('coins');
    }


    /*
    * Add review on exchange
    ***********************/
    public function review(Request $request){
        if($request->review == null)
            return redirect()->back()->withWerror(__('lang.review_error'));

        if(setting('captcha_status') == 'on' && setting('site_key') != null){
            $customMessages = [
                'g-recaptcha-response.required' => 'Please check the captcha box.',
            ];
            $this->validate($request, [
                'g-recaptcha-response'=>'required',
            ],$customMessages);
        }
        if($request->has('exchange_id')){
            $review = new Review();
            $review->user_id = Auth::id();
            $review->exchange_id = $request->exchange_id;
            $review->review = $request->review;
            $review->rating = $request->rating;
            $review->save();
            return redirect()->back()->withRsuccess(__('lang.review_success'));
        }
        if($request->has('coin')){
            $coin = Coin::where('symbol', $request->coin)->first();
            if($coin){
                $review = new Review();
                $review->user_id = Auth::id();
                $review->coin_id = $coin->id;
                $review->review = $request->review;
                $review->rating = $request->rating;
                $review->save();
                return redirect()->back()->withRsuccess(__('lang.review_success'));
            }
        }
        return redirect()->back()->withWerror(__('lang.review_error'));
    }

    /*
    * Blog Page
    ***********************/
    public function blog(){
        $blog = Blog::orderBy('id', 'desc')->get();
        return view('blog', compact('blog'));
    }

    /*
    * Blog Detail Page
    ***********************/
    public function show_blog($slug){
        $blog1 = Blog::where('slug', $slug)->firstOrFail();
        return view('blog_post_single', compact('blog1'));
    }

    /*
    * Calculator page
    ***********************/
    public function calculator(){
        $first = Coin::orderBy('market_cap', 'desc')->first();
        $coins = Coin::orderBy('market_cap', 'desc')->get();
        return view('calculator', compact('coins', 'first'));
    }

    /*
    * Calculate results
    ***********************/
    public function calculate($coin, $currency, $amount){
        $client = new Client();
        $value = $client->request('GET', 'https://min-api.cryptocompare.com/data/price?fsym='.$coin.'&tsyms='.$currency);
        $value = json_decode($value->getBody() , true);
        $amount = $amount * $value[$currency];
        return  $amount;
    }

    /*
     * Subscribe for newsletters
     ***************/
    public function subscribe(Request $request){
        $request->validate([
            'email' => 'required|email|unique:subscribers'
        ]);
        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();
        return "Thanks for Subscribing!";

    }

    /*
    * Page detail
    ***********************/
    public function show_page($slug){
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('page', compact('page'));
    }

    /*
    * Deals page
    ***********************/
    public function deals(){
        $links = Deal::orderBy('id', 'desc')->paginate(60);
        return view('deals', compact('links'));
    }

    /*
   * Language change
   ***********************/
    public function locale($locale){
        $lang = Language::where('short_name', $locale)->first();
        if($lang){
            Session::put('locale', $locale);
        }
        return redirect()->back();
    }
}
