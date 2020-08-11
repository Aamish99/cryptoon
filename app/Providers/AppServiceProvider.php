<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Deal;
use App\Models\Language;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        URL::forceScheme('https');
        Schema::defaultStringLength(191);

        view()->composer(['*'], function($view)
        {
            $footer_pages = page::where('placement', 'footer')->get();
            $header_pages = page::where('placement', 'header')->get();

            $languages = Language::all();
            $deals = Deal::all();
            $blog = Blog::all();

            $view->with(['blog' => $blog, 'deals' => $deals, 'footer_pages' => $footer_pages, 'header_pages' => $header_pages, 'languages' => $languages]);
        });

    }
}
