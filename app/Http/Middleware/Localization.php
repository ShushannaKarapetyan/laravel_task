<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*You know default Language in locale is English*/
        /*So for this middleware will change language by Session*/

        /*if(session()->has('locale')){
            \App::setLocale(session()->get('locale'));
        }*/

        $locale = $request->cookie('locale', config()->get('app.locale'));
        app()->setLocale($locale);

        return $next($request);
    }
}
