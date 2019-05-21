<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    
    //유저 비밀번호 확인
    public function getUserInfo(Request $request){
        return view('auth.profile');
   }

    //비밀번호 변경 폼
    public function getChanegePasswordFrom(){
        return view('auth.change_Password_Form');
    }

    //내정보 보기
    public function getUser(){
    return view('auth.profile_check');
    }

    /*소셜라이트 회원 가입양식*/ 
    public function getRegister(){
        return view('auth.socialiteRegister');
    }


}
