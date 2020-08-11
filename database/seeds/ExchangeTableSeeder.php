<?php

use Illuminate\Database\Seeder;
use App\Http\Controllers\CurlController;
use App\Models\Exchange;

class ExchangeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exchanges = json_decode(CurlController::curl('https://min-api.cryptocompare.com/data/exchanges/general'), true)['Data'];
        foreach ($exchanges as $exchange) {
            $market = new Exchange();
            $market->exchange_id = (isset($exchange['Id']))? $exchange['Id'] : '';
            $market->name = (isset($exchange['Name']))? $exchange['Name'] : '';
            $market->logo_url = (isset($exchange['LogoUrl']))? $exchange['LogoUrl'] : '';
            $market->centralization_type = (isset($exchange['CentralizationType']))? $exchange['CentralizationType'] : '';
            $market->grade_points = (isset($exchange['GradePoints']))? $exchange['GradePoints'] : '';
            $market->grade = (isset($exchange['Grade']))? $exchange['Grade'] : '';
            $market->market_quality = (isset($exchange['MarketQuality']))? $exchange['MarketQuality'] : '';
            $market->avg_rating = (isset($exchange['Rating']['Avg']))? $exchange['Rating']['Avg'] : '';
            $market->country = (isset($exchange['Country']))? $exchange['Country'] : '';
            $market->description = (isset($exchange['Description']))? $exchange['Description'] : '';
            $market->full_address = (isset($exchange['FullAddress']))? $exchange['FullAddress'] : '';
            $market->fees = (isset($exchange['Fees']))? $exchange['Fees'] : '';
            $market->deposit_methods = (isset($exchange['DepositMethods']))? $exchange['DepositMethods'] : '';
            $market->withdrawal_methods = (isset($exchange['WithdrawalMethods']))? $exchange['WithdrawalMethods'] : '';
            $market->affiliate_url = (isset($exchange['AffiliateURL']))? $exchange['AffiliateURL'] : '';
            $market->sponsored = (isset($exchange['Sponsored']))? $exchange['Sponsored'] : '';
            $market->type = 'live';
            $market->save();
        }
    }
}
