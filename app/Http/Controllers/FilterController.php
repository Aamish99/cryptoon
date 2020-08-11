<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Coin;
use App\Models\Exchange;
use App\Http\Controllers\TradingController;

class FilterController extends Controller
{
    /*
    * Filter exchanges
    ***********************/
    public function filterResults(Request $request, $action, $coin){
        if(Session::has('filter_coin') == $coin && Session::has('filter_exchanges')){
            $coins = Coin::all();
            $trading_exchanges = [];
            $all_exchanges = new Exchange();
            if($request->dbank != null) {
                $all_exchanges =  $all_exchanges->where('deposit_methods', 'like', '%Bank%');
            }
            if($request->dmaster != null) {
                $all_exchanges =  $all_exchanges->where('deposit_methods', 'like', '%MasterCard%');
            }

            if($request->dvisa != null) {
                $all_exchanges =  $all_exchanges->where('deposit_methods', 'like', '%Visa%');
            }

            if($request->dpaypal != null) {
                $all_exchanges =  $all_exchanges->where('deposit_methods', 'like', '%Paypal%');
            }

            if($request->dskrill != null) {
                $all_exchanges =  $all_exchanges->where('deposit_methods', 'like', '%skrill%');
            }

            /*withdrawal methods*/

            if($request->wbank != null) {
                $all_exchanges =  $all_exchanges->where('withdrawal_methods', 'like', '%Bank%');
            }
            if($request->wmaster != null) {
                $all_exchanges =  $all_exchanges->where('withdrawal_methods', 'like', '%MasterCard%');
            }

            if($request->wvisa != null) {
                $all_exchanges =  $all_exchanges->where('withdrawal_methods', 'like', '%Visa%');
            }
            if($request->wpaypal != null) {
                $all_exchanges =  $all_exchanges->where('withdrawal_methods', 'like', '%Paypal%');
            }
            if($request->wpaypal != null) {
                $all_exchanges =  $all_exchanges->where('withdrawal_methods', 'like', '%skrill%');
            }

            /*market type*/
            if($request->market_type != null && $request->market_type == 'centralized') {
                $all_exchanges =  $all_exchanges->where('centralization_type', 'Centralized');
            }
            if($request->market_type != null && $request->market_type == 'decentralized') {
                $all_exchanges =  $all_exchanges->where('centralization_type', 'Decentralized');
            }

            /*market type*/
            if($request->rating != null && $request->rating != 'any') {
                $all_exchanges =  $all_exchanges->where('avg_rating', '>=', $request->rating);
            }

            $all_exchanges =   $all_exchanges->get();
            $exchanges = Session::get('filter_exchanges');
            foreach ($exchanges as $key => $item){
                foreach ($all_exchanges as $exchange){
                    if($exchange->exchange_id  == $item['exchange_id']){
                        $trading_exchanges[$key] = $item;
                    }
                }
            }

            if($request->sort != null && $request->sort == 'price'){
                $trading_exchanges = Session::get('filter_exchanges');
            }

            if($request->sort != null && $request->sort == 'rating'){
                $trading_exchanges = Session::get('filter_exchanges');
                usort($trading_exchanges, function($a, $b) {
                    return $a['avg_rating'] <= $b['avg_rating'];
                });

            }
            $amount = $request->amount;
            return view('trading', compact('action','request', 'coin', 'coins', 'trading_exchanges', 'amount'));
        }

        return redirect('trade/'.$action.'/'.$coin);

    }


    /*
    * Filter exchanges list
    ***********************/
    public function filterExchanges(Request $request){
            $trading_exchanges = [];
            $all_exchanges = new Exchange();
            if($request->dbank != null) {
                $all_exchanges =  $all_exchanges->where('deposit_methods', 'like', '%Bank%');
            }
            if($request->dmaster != null) {
                $all_exchanges =  $all_exchanges->where('deposit_methods', 'like', '%MasterCard%');
            }

            if($request->dvisa != null) {
                $all_exchanges =  $all_exchanges->where('deposit_methods', 'like', '%Visa%');
            }

            if($request->dpaypal != null) {
                $all_exchanges =  $all_exchanges->where('deposit_methods', 'like', '%Paypal%');
            }

            /*withdrawal methods*/

            if($request->wbank != null) {
                $all_exchanges =  $all_exchanges->where('withdrawal_methods', 'like', '%Bank%');
            }
            if($request->wmaster != null) {
                $all_exchanges =  $all_exchanges->where('withdrawal_methods', 'like', '%MasterCard%');
            }

            if($request->wvisa != null) {
                $all_exchanges =  $all_exchanges->where('withdrawal_methods', 'like', '%Visa%');
            }
            if($request->wpaypal != null) {
                $all_exchanges =  $all_exchanges->where('withdrawal_methods', 'like', '%Paypal%');
            }

            /*market type*/
            if($request->market_type != null && $request->market_type == 'centralized') {
                $all_exchanges =  $all_exchanges->where('centralization_type', 'Centralized');
            }
            if($request->market_type != null && $request->market_type == 'decentralized') {
                $all_exchanges =  $all_exchanges->where('centralization_type', 'Decentralized');
            }

            /*market type*/
            if($request->rating != null && $request->rating != 'any') {
                $all_exchanges =  $all_exchanges->where('avg_rating', '>=', $request->rating);
            }

            $exchanges =   $all_exchanges->paginate(300);

            if($request->sort != null && $request->sort == 'name'){
                $exchanges = Exchange::orderBy('name', 'asc')->paginate(300);
            }

            if($request->sort != null && $request->sort == 'rating'){
                $exchanges = Exchange::orderBy('avg_rating', 'desc')->paginate(300);

            }
            return view('exchanges', compact('request', 'exchanges'));
    }
}
