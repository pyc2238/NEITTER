<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class User
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
        $upw = $request->password;
        $pw = Auth::user()->password;
        
        
        //password_verify() : hash암호를 해석
        if($upw){
            if(password_verify($upw,$pw)){
                return $next($request);        
            }else{
                return back()->with('message','회원 정보와 비밀번호가 일치하지 않습니다.');
            }
        }else{
            if(Auth::user()->socialite == 0){
                return back()->with('message','이용할 수 없는 서비스입니다.');    
            }
            return redirect(route('socialite.userInfo',Auth::user()->id));
        }
    }
}
