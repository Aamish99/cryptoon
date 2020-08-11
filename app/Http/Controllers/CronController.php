<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Coin;
use App\Models\Exchange;
use App\Notifications\PriceAlert;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CronController extends Controller
{
    public function cron(){
        $this->updateCoins();
        $this->alerts();
        return 'ok';
    }

    public function updateCoins(){
        $coins = Coin::all();
        foreach ($coins as $coin){
            if ($coin->coin_id) {
                $coin_cap = json_decode(CurlController::curl('https://api.coincap.io/v2/assets/' . $coin->coin_id), true);
                if (isset($coin_cap['data'])) {
                    $coin_detail = $coin_cap['data'];
                    $coin = Coin::find($coin->id);
                    $coin->price = (isset($coin_detail['priceUsd']) && $coin_detail['priceUsd'] != null) ? round($coin_detail['priceUsd'], 4) :  $coin->price;
                    $coin->market_cap = (isset($coin_detail['marketCapUsd']) && $coin_detail['marketCapUsd'] != null) ? round($coin_detail['marketCapUsd'], 4) : $coin->market_cap;
                    $coin->volume_24h = (isset($coin_detail['volumeUsd24Hr']) && $coin_detail['volumeUsd24Hr'] != null) ? round($coin_detail['volumeUsd24Hr'], 4) : $coin->volume_24h;
                    $coin->change_24h = (isset($coin_detail['changePercent24Hr']) && $coin_detail['changePercent24Hr'] != null) ? round($coin_detail['changePercent24Hr'], 4) : $coin->change_24h;
                    $coin->supply = (isset($coin_detail['supply'])  && $coin_detail['supply'] != null) ? round($coin_detail['supply'], 4) : $coin->supply;
                    $coin->save();
                }
            } else {
                $coin_detail = json_decode(CurlController::curl('https://min-api.cryptocompare.com/data/pricemultifull?fsyms=' . $coin->symbol . '&tsyms=USD'), true);
                if (!empty($coin_detail['RAW'])) {
                    $coin = Coin::find($coin->id);
                    $coin->price = (isset($coin_detail['RAW'][$coin->symbol]['USD']['PRICE'])) ? round($coin_detail['RAW'][$coin->symbol]['USD']['PRICE'], 4) : $coin->price;
                    $coin->market_cap = (isset($coin_detail['RAW'][$coin->symbol]['USD']['MKTCAP'])) ? round($coin_detail['RAW'][$coin->symbol]['USD']['MKTCAP'], 4) :  $coin->market_cap;

                    $v_24 = (isset($coin_detail['RAW'][$coin->symbol]['USD']['TOTALVOLUME24HTO'])) ? round($coin_detail['RAW'][$coin->symbol]['USD']['TOTALVOLUME24HTO'], 4) : '';
                    if ($v_24 !== '') {
                        $coin->volume_24h = $v_24;
                    }

                    $coin->change_24h = (isset($coin_detail['RAW'][$coin->symbol]['USD']['CHANGEPCT24HOUR'])) ? round($coin_detail['RAW'][$coin->symbol]['USD']['CHANGEPCT24HOUR'], 4) : $coin->change_24h;
                    $coin->supply = (isset($coin_detail['RAW'][$coin->symbol]['USD']['SUPPLY'])) ? round($coin_detail['RAW'][$coin->symbol]['USD']['SUPPLY'], 4) :  $coin->supply;
                    $coin->save();
                }
            }
        }

        return 'ok';
    }

    public function alerts(){
        $alerts = Alert::all();
        foreach ($alerts as $alert){
            $alert = Alert::find($alert->id);
            $coin = Coin::where('symbol', $alert->coin)->first();
            if($coin && $coin->price == $alert->price_alert){
                $alert->total_alerts = $alert->total_alerts + 1;
                $alert->recent_activity = Carbon::now();
                $alert->save();
                $alert->notify(new PriceAlert($coin->symbol));
            }
        }

        return 'ok';
    }

}
