<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
class loginCheck
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
        
        if(Session::get('locale') == 'ja'){
            $message = 'ログイン後利用できます';
        }else{
            $message = '로그인 후 사용가능합니다.';
        }

        if(!Auth::check()){
            return back()->with('message',$message);
        }else{
            return $next($request);
        }
    }
}
