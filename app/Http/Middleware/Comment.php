<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Comment
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
        if(!Auth::check()){
            return back()->with('message','로그인 후 이용가능합니다.');
        }  
        
        return $next($request);
    }
}
