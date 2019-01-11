<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
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

            if(Session::get('locale') == 'ja'){
                $message = '会員情報とパスワードが一致しません';
            }else{
                $message = '회원 정보와 비밀번호가 일치하지 않습니다.';
            }

            if(password_verify($upw,$pw)){
                return $next($request);        
            }else{
                return back()->with('message',$message);
            }
        }else{
            if(Auth::user()->socialite == 0){
                
                if(Session::get('locale') == 'ja'){
                    $message = '利用できないサービスです。';
                }else{
                    $message = '이용할 수 없는 서비스입니다.';
                }

                return back()->with('message',$message);    
            }
            return redirect(route('socialite.userInfo',Auth::user()->id));
        }
    }
}
