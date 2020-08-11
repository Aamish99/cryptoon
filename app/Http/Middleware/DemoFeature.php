<?php

namespace App\Http\Middleware;

use Closure;

class DemoFeature
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
        return redirect()->back()->withErrors('This Feature is disabled in demo version');
    }
}
