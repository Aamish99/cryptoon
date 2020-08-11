<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    if(Auth::user()->role == 1){
        return redirect('admin/dashboard');
    }
    return redirect('/');
});

Auth::routes();
Route::get('lang/{locale}', 'HomeController@locale');

Route::get('/home', function (){
    if(Auth::user()->role == 1){
        return redirect('admin/dashboard');
    }
    return redirect('/');
});

Route::get('/', 'HomeController@index');
Route::post('review', 'HomeController@review');
Route::get('blog', 'HomeController@blog');
Route::get('blog/{slug}', 'HomeController@show_blog');
Route::get('calculator', 'HomeController@calculator');
Route::get('calculator/{coin}/{currency}/{amount}', 'HomeController@calculate');
Route::post('subscribe', 'HomeController@subscribe');
Route::get('page/{slug}', 'HomeController@show_page');

/*buy sell crypto*/
Route::get('/trade/{action}/{coin}', 'TradingController@coinTrading');
Route::get('/filter/{action}/{coin}', 'FilterController@filterResults');
Route::get('exchanges/filter', 'FilterController@filterExchanges');
Route::post('price-alert', 'TradingController@priceAlert');


/*Exchange page*/
Route::get('exchanges', 'TradingController@exchanges');
Route::get('exchange/{name}', 'TradingController@exchangeDetail');

/*Coins page*/
Route::get('coins', 'HomeController@coins');
Route::get('coins/page/{id}', 'HomeController@pageNumber');
Route::get('coin/{id}', 'HomeController@coinDetail');

/*Deals page*/
Route::get('deals', 'HomeController@deals');

/*Exchange page*/
Route::get('compare/exchanges', 'CompareController@exchanges');
Route::get('compare/cryptocurrencies', 'CompareController@currencies');

/*User Profile*/
Route::get('profile', 'ProfileController@profile');
Route::get('profile/alerts', 'ProfileController@alerts');
Route::get('profile/delete/alert/{id}', 'ProfileController@deleteAlerts');

Route::get('profile/reviews', 'ProfileController@reviews');
Route::get('profile/delete/review/{id}', 'ProfileController@deleteReview');

Route::get('profile/settings', 'ProfileController@settings');
Route::post('profile/settings', 'ProfileController@updateSettings');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function (){

    Route::get('/dashboard', 'Admin\UsersController@dashboard');

    Route::resource('coins', 'Admin\CoinsController');
    Route::post('coin/delete', 'Admin\CoinsController@remove');

    Route::get('exchanges/get', 'Admin\ExchangesController@getExchanges');
    Route::resource('exchanges', 'Admin\ExchangesController');
    Route::post('exchange/delete', 'Admin\ExchangesController@remove');

    Route::resource('/users', 'Admin\UsersController');
    Route::post('user/delete', 'Admin\UsersController@destroy');
    Route::get('/profile', 'Admin\UsersController@profile');
    Route::post('/profile', 'Admin\UsersController@updateProfile');

    Route::resource('/blog', 'Admin\BlogController');
    Route::post('blog/delete', 'Admin\BlogController@destroy');

    Route::resource('alerts', 'Admin\AlertsController');
    Route::post('alert/delete', 'Admin\AlertsController@destroy');

    Route::resource('pages', 'Admin\PagesController');
    Route::post('page/delete', 'Admin\PagesController@destroy');

    Route::resource('reviews', 'Admin\ReviewController');
    Route::get('/review/view/{id}', 'Admin\ReviewController@view');
    Route::post('review/delete', 'Admin\ReviewController@destroy');

    Route::get('/subscribers/export_csv', 'Admin\SubscribersController@export_csv');
    Route::post('subscriber/delete', 'Admin\SubscribersController@destroy');
    Route::resource('/subscribers', 'Admin\SubscribersController');

    Route::resource('deals', 'Admin\DealsController');
    Route::post('deal/delete', 'Admin\DealsController@remove');

    Route::get('settings/general', 'Admin\SettingsController@generalSetting');
    Route::post('settings/general', 'Admin\SettingsController@updateSetting');

    Route::get('settings/language', 'Admin\SettingsController@language');
    Route::post('settings/language', 'Admin\SettingsController@addLanguage');
    Route::post('settings/language/delete', 'Admin\SettingsController@destroyLanguage');
    Route::post('settings/language/switch', 'Admin\SettingsController@switchLanguage');
    Route::get('language/download/{id}', 'Admin\SettingsController@downloadLanguage');

});

Route::get('cron', 'CronController@cron');


Route::any('{catchall}', function() {
    return view('errors.403');
})->where('catchall', '.*');
