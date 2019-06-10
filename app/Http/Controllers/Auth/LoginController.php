<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Events\SendMail;
use Socialite;
use Event;


use Auth;
use App\Models\Users\User;
use App\Models\Users\Point;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers { logout as performLogout; }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $pointModel = null;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->pointModel   = new Point();
    }

    //로그인 한 시간 저장
    protected function authenticated(Request $request,User $user)
    {
        $user = auth()->user();
        $user->login_date = now();
        $user->save();

        $userPoint = $this->pointModel->where('user_id',Auth::id())->first();

         //당일 게시판 글등록 최대 5포인트 지급
         if($userPoint->login_point != 2){
            $userPoint->login_point += 2;
            $userPoint->save();
            $user->point += $userPoint->login_point;
            $user->save();
        }

        
    }



    public function logout(Request $request) {
         $this->performLogout($request); 
         return redirect()->route('home.index');
         } 


     public function redirect(Request $request,$social)
     {
       
          
        session(['name'     => $request->name]);
        session(['age'      => $request->age]);
        session(['gender'   => $request->gender]);
        session(['address'  => $request->address]);
        session(['country'  => $request->country]);
         
       
         return Socialite::driver($social)->redirect();
     }
 
 
     public function callback(Request $request,$social)
     {
        
    
         try {
             $socialiteLogin = true;            
            
             if($social == 'twitter'){
                $socialUser = Socialite::driver($social)->user();
             }else{
                $socialUser = Socialite::driver($social)->stateless()->user();
             }
                   
            

             $existUser = User::where('email',$socialUser->email)->first();
              
             if($existUser) {    
                 Auth::loginUsingId($existUser->id);
                 return redirect()->to('/home');
             }
             else {
                 if(!session('age')){
                    session(['social' => $social]);
                
                     return redirect()->route('socialite.register');
                 }  
 
                 $user = new User;
                 $user->name      = session('name');
                 $user->email     = $socialUser->email;
                 $user->gender    = session('gender');
                 $user->age       = session('age');
                 $user->address   = session('address');
                 $user->country   = session('country');
                 $user->socialite = 1;
                 $user->save();
                 session(['newUser' => $socialUser->name]);
                 if($socialUser->email && $socialUser->name){
                 Event::fire(new SendMail($socialUser->email,$socialUser->name));
                }
                 Auth::loginUsingId($user->id);
               
                 return redirect()->to('/home')->with('socialiteLogin',$socialiteLogin);
             }
             
         } 
         catch (Exception $e) {
             return 'error';
         }
     }
 
 
}
