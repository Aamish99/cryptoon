<?php

use Illuminate\Database\Seeder;
use App\Http\Controllers\CurlController;
use App\Models\Coin;

class CoinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $all_coins = json_decode(CurlController::curl('https://min-api.cryptocompare.com/data/all/coinlist'), true);
        foreach ($all_coins['Data'] as  $item){
            $coin_detail = json_decode(CurlController::curl('https://min-api.cryptocompare.com/data/pricemultifull?fsyms='.$item['Symbol'].'&tsyms=USD'), true);
            if(!empty($coin_detail['RAW'])) {
                $coin = new Coin();
                $coin->name = (isset($item['CoinName'])) ? $item['CoinName'] : '';
                $coin->symbol = (isset($item['Symbol'])) ? $item['Symbol'] : '';
                $coin->icon_url = (isset($item['ImageUrl'])) ? $item['ImageUrl'] : '';
                $coin->trending = (isset($item['IsTrading'])) ? $item['IsTrading'] : '';
                $coin->price = (isset($coin_detail['RAW'][$item['Symbol']]['USD']['PRICE'])) ? round($coin_detail['RAW'][$item['Symbol']]['USD']['PRICE'], 4) : ''; ;
                $coin->market_cap = (isset($coin_detail['RAW'][$item['Symbol']]['USD']['MKTCAP'])) ? round($coin_detail['RAW'][$item['Symbol']]['USD']['MKTCAP'], 4) : '';
                $coin->volume_24h =(isset($coin_detail['RAW'][$item['Symbol']]['USD']['TOTALVOLUME24HTO'])) ? round($coin_detail['RAW'][$item['Symbol']]['USD']['TOTALVOLUME24HTO'], 4) : '';
                $coin->change_24h = (isset($coin_detail['RAW'][$item['Symbol']]['USD']['CHANGEPCT24HOUR'])) ? round($coin_detail['RAW'][$item['Symbol']]['USD']['CHANGEPCT24HOUR'], 4) : '';
                $coin->supply = (isset($coin_detail['RAW'][$item['Symbol']]['USD']['SUPPLY'])) ? round($coin_detail['RAW'][$item['Symbol']]['USD']['SUPPLY'], 4) : '';
                $coin->type = 'live';
                $coin->save();
            }

        }
    }
}
