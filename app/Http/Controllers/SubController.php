<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;

class SubController extends Controller
{
    //사이트 소개 URL
    public function getIntroduction(){return view('component.introduction');}

    //내정보 보기
    public function getUser(){return view('auth.profile_check');}



    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback()
    {
        try {
            
     
            $googleUser = Socialite::driver('google')->user();  
            $existUser = User::where('email',$googleUser->email)->first();
             

            if($existUser) {
                Auth::loginUsingId($existUser->id);
            }
            else {
                $user = new User;
                $user->name = $googleUser->name;
                $user->email = $googleUser->email;
                $user->password = md5(rand(1,10000));
                $user->save();
                Auth::loginUsingId($user->id);
            }
            return redirect()->to('/home');
        } 
        catch (Exception $e) {
            return 'error';
        }
    }
}


