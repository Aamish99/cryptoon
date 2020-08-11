<?php

namespace App\Http\Controllers\Admin;

use App\Models\Exchange;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Http\Controllers\CurlController;

class ExchangesController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo', ['only' => ['store', 'update']]);
    }
    /*
    * Display all the exchanges list
    * **********/
    public function index(){
        $exchanges = Exchange::orderBy('avg_rating', 'desc')->withTrashed()->get();
        return view('admin.exchanges.index', compact('exchanges'));
    }

    /*
    * Store new exchange into database
    * **********/
    public function store(Request $request)
    {
        $this->validate($request, [
            'exchanges' => 'required',
        ]);
        $client = new Client();
        $exchange_detail = json_decode(CurlController::curl('https://min-api.cryptocompare.com/data/exchanges/general'));
        $exchanges = $exchange_detail->Data;

        foreach ($request->exchanges as $item) {
            if($item != null) {
                $market = Exchange::onlyTrashed()->where('exchange_id', $item)->first();
                if($market){
                    if(isset($exchanges->$item)){
                        $exchange = $exchanges->$item;
                        if(is_object($exchange)){
                            $exchange = get_object_vars($exchange);
                        }
                        $market->exchange_id = $item;
                        $market->name = (isset($exchange['Name']))? $exchange['Name'] : '';
                        $market->logo_url = (isset($exchange['LogoUrl']))? $exchange['LogoUrl'] : '';
                        $market->centralization_type = (isset($exchange['CentralizationType']))? $exchange['CentralizationType'] : '';
                        $market->grade_points = (isset($exchange['GradePoints']))? $exchange['GradePoints'] : '';
                        $market->grade = (isset($exchange['Grade']))? $exchange['Grade'] : '';
                        $market->market_quality = (isset($exchange['MarketQuality']))? $exchange['MarketQuality'] : '';

                        $market->avg_rating = (isset($exchange['Rating']->Avg))? $exchange['Rating']->Avg : '';
                        $market->country = (isset($exchange['Country']))? $exchange['Country'] : '';
                        $market->description = (isset($exchange['Description']))? $exchange['Description'] : '';
                        $market->full_address = (isset($exchange['FullAddress']))? $exchange['FullAddress'] : '';
                        $market->fees = (isset($exchange['Fees']))? $exchange['Fees'] : '';
                        $market->deposit_methods = (isset($exchange['DepositMethods']))? $exchange['DepositMethods'] : '';
                        $market->withdrawal_methods = (isset($exchange['WithdrawalMethods']))? $exchange['WithdrawalMethods'] : '';
                        $market->affiliate_url = (isset($exchange['AffiliateURL']))? $exchange['AffiliateURL'] : '';
                        $market->type = 'live';
                        $market->sponsored = (isset($exchange['Sponsored']))? $exchange['Sponsored'] : '';
                    }
                    $market->save();
                    $market->restore();

                } else{
                    $market = new Exchange();
                    $market->name = $item;
                    $market->exchange_id = 123;
                    $market->type = 'local';
                    $market->save();
                }
            }
        }
        return redirect()->back()->withStatus(__('lang.exchanges_successfully_added'));
    }


    /*
    * Get exchange information to edit
    * **********/
    public function edit($id){
        $exchange = Exchange::find($id);
        if(isset($exchange)) {
            return view('admin.exchanges.edit', compact('exchange'));
        }
        return redirect()->back()->withErrors(__('lang.exchange_not_found'));
    }
    public function update(Request $request, $id){
        $market = Exchange::find($id);
        if(isset($market)) {
            $this->validate($request, [
                'name' => 'required|max:190',
                'grade' => 'required|max:190',
                'country' => 'required|max:190',
                'affiliate_url' => 'required|max:190',
                'address' => 'required',
                'description' => 'required',
            ]);
            $market->name = $request->name;
            $market->grade_points = $request->grade_points;
            $market->grade = $request->grade;
            $market->market_quality = $request->market_quality;
            $market->country = $request->country;
            $market->description = $request->description;
            $market->full_address = $request->address;
            $market->deposit_methods = $request->deposit_methods;
            $market->withdrawal_methods = $request->withdrawal_methods;
            $market->affiliate_url = $request->affiliate_url;
            if ($request->hasFile('icon')){
                $file      = $request->icon;
                $extention = $file->getClientOriginalExtension();
                $filename  = time().'-exchange.'.$extention;
                $file->move('uploads', $filename);
                $market->logo_url = $filename;
            }
            $market->save();
            return redirect()->back()->withStatus(__('lang.exchange_updated_successfully'));
        }
        return redirect()->back()->withErrors(__('lang.exchange_not_found'));
    }

    /*
    * Delete exchanges from database
    * **********/
    public function remove(Request $request){
        /*foreach ($request->id as $item){
            $exchange =  Exchange::find($item);
            if($exchange)
                $exchange->delete();
        }
        return __('lang.exchange_delete_success');*/

        return 'demo';

    }
}
