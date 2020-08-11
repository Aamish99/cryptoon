<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CurlController;
use App\Models\Coin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class CoinsController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo', ['only' => ['store', 'update']]);
    }

    /*
    * Get list of all coins
    ***********************/
    public function index(){
        $coins = Coin::orderBy('market_cap', 'desc')->withTrashed()->get();
        foreach ($coins as $coin){
            if($coin->trashed()) {
                $coin = Coin::where('id', $coin->id)->withTrashed()->first();
                if($coin->name == 'Bitcoin Cash')
                $coin->restore();
            }
        }
        return view('admin.coins.index', compact('coins'));
    }

    /*
    * Add new coin
    ***********************/
    public function store(Request $request){
        $this->validate($request, [
             'coins' => 'required',
        ]);
        foreach ($request->coins as $id){
            $coin = Coin::onlyTrashed()->where('id', $id)->first();
            if(isset($coin)) {
                $coin_detail = json_decode(CurlController::curl('https://min-api.cryptocompare.com/data/pricemultifull?fsyms=' . $coin->symbol . '&tsyms=USD'), true);
                if (!empty($coin_detail['RAW'])) {
                    $coin->price = round($coin_detail['RAW'][$coin->symbol]['USD']['PRICE'], 4);
                    $coin->market_cap = round($coin_detail['RAW'][$coin->symbol]['USD']['MKTCAP'], 4);
                    $coin->volume_24h = round($coin_detail['RAW'][$coin->symbol]['USD']['VOLUME24HOURTO'], 4);
                    $coin->change_24h = round($coin_detail['RAW'][$coin->symbol]['USD']['CHANGEPCT24HOUR'], 4);
                    $coin->supply = round($coin_detail['RAW'][$coin->symbol]['USD']['SUPPLY'], 4);
                }
                $coin->save();
                $coin->restore();
            }else{
                $coin = new Coin();
                $coin->name = $id;
                $coin->symbol = $id;
                $coin->type = 'local';
                $coin->save();
            }
        }
       return redirect()->back()->withStatus(__('lang.coins_successfully_added'));
    }

    /*
    * Edit coin
    ***********************/
    public function edit($id){
        $coin = Coin::find($id);
        if($coin){
            return view('admin.coins.edit', compact('coin'));
        }
        return redirect('admin/coins');
    }

    /*
    * Update coin
    ***********************/
    public function update(Request $request, $id){
        $coin = Coin::find($id);
        if($coin){
            $this->validate($request, [
                'name' => ['required', 'max:155'],
                'symbol' => 'required|alpha_dash|max:155|unique:coins,symbol,'.$id,
                'price' => ['required','numeric','min:0'],
                'market_cap' => ['nullable','numeric','min:0'],
                'volume_24h' => ['nullable','numeric','min:0'],
                'supply' => ['nullable','numeric','min:0'],
            ]);
            $coin->name = $request->name;
            $coin->symbol = $request->symbol;
            $coin->price = $request->price;
            $coin->market_cap = $request->market_cap;
            $coin->volume_24h = $request->volume_24h;
            $coin->supply = $request->supply;
            $coin->description = $request->description;
            $coin->trending = (isset($request->trending) ? '1' : '0');
            if ($request->hasFile('icon')){
                $file      = $request->icon;
                $extention = $file->getClientOriginalExtension();
                $filename  = time().'-coin.'.$extention;
                $file->move('uploads', $filename);
                $coin->icon_url = $filename;
            }
            $coin->save();
            return redirect('admin/coins')->withStatus(__('lang.coins_successfully_updated'));
        }

        return redirect('admin/coins');
    }

   /*
   * Delete coin
   ***********************/
    public function remove(Request $request){
        /*foreach ($request->id as $item){
            $coin =  Coin::find($item);
            if($coin)
                $coin->delete();
        }
        return __('lang.coin_delete_success');*/
        return 'demo';
    }
}
