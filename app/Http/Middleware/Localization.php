<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;
 
class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     /**
      * 언어 지역화 미들웨어 (web 미들에워 그릅 등록)
      */
    public function handle($request, Closure $next)
    {

        if(Session::has('locale')){
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}
