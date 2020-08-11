<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Exchange;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    /*
    * Compare exchanges
    ***********************/
    public function exchanges(Request $request){
        $name = ($request->name) != null ? $request->name.',' : $request->name;
        $exchanges = Exchange::all();
        $av_exchanges = str_replace('-', ' ', $request->name);
        $array = explode(',', $av_exchanges);
        $cp_exchanges = Exchange::whereIn('name', $array)->get();
        return view('compareExchanges', compact('exchanges', 'name', 'cp_exchanges'));
    }

    /*
    * Compare crypt currencies
    ***********************/
    public function currencies(Request $request){
        $name = ($request->name) != null ? $request->name.',' : $request->name;
        $coins = Coin::all();
        $cp_coins = [];
        if($request->name != null){
            $req_coins = explode(',', $request->name);
            $cp_coins =  Coin::whereIn('symbol', $req_coins)->get();
        }
        return view('compareCoins', compact('name', 'coins', 'cp_coins'));
    }
}

