<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

use Closure;
use Illuminate\Http\Request;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('language')) {
            if (App::getLocale()!= Session::get('language')) {
             App::setLocale(Session::get('language'));
            }
          }else {
             Session::put('language', 'es');
             App::setLocale('es');
         }
          return $next($request);
        return $next($request);
    }
}
