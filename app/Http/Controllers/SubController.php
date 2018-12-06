<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;
use Event;
use App\Events\SendMail;
use Session; 

class SubController extends Controller
{
    //사이트 소개 URL
    public function getIntroduction(){return view('component.introduction');}

    //내정보 보기
    public function getUser(){return view('auth.profile_check');}


    public function getRegister(){
        return view('auth.socialiteRegister');
    }

    public function getUserInfo(){
        return view('auth.socialiteProfile');
    }

    
    /*구글 로그인 */
    public function redirect(Request $request)
    {
        Session::put('name',$request->name);
        Session::put('age',$request->age);
        Session::put('gender',$request->gender);
        Session::put('address',$request->address);
        Session::put('country',$request->country);
        
        
        return Socialite::driver('google')->redirect();
    }


    public function callback(Request $request)
    {

        try {
            $socialiteLogin = true;            
            
            $googleUser = Socialite::driver('google')->user();  
            $existUser = User::where('email',$googleUser->email)->first();
             
            if($existUser) {    
                Auth::loginUsingId($existUser->id);
                return redirect()->to('/home');
            }
            else {
                if(!Session::get('age')){
                    
                    return redirect(route('socialite.register'));
                }  

                $user = new User;
                $user->name = Session::get('name');
                $user->email = $googleUser->email;
                $user->gender = Session::get('gender');
                $user->age = Session::get('age');
                $user->address = Session::get('address');
                $user->country = Session::get('country');
                $user->socialite = 1;
                $user->save();
                Session::put('newUser',$googleUser->name);
                Event::fire(new SendMail($googleUser->email,$googleUser->name));
                Auth::loginUsingId($user->id);
                // $request->session()->flush();
                return redirect()->to('/home')->with('socialiteLogin',$socialiteLogin);
            }
            
        } 
        catch (Exception $e) {
            return 'error';
        }
    }
}


