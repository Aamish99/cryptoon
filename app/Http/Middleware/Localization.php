<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*if(Auth::check()) {
            if (Auth::user()->user_default_lang != NULL) {
                $lang = Auth::user()->user_default_lang;
                App::setLocale($lang);
                Carbon::setLocale($lang);
                return $next($request);
            }
        }*/
        if(Session::get('locale') != null){
            App::setLocale(Session::get('locale'));
            Carbon::setLocale(Session::get('locale'));
            return $next($request);
        }

        $lang = Language::where('default', true)->first();
        if($lang){
            App::setLocale($lang->short_name);
            Carbon::setLocale($lang->short_name);
        }

        return $next($request);
    }
}
