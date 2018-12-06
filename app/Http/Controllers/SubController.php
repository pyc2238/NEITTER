<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubController extends Controller
{
    //사이트 소개 URL
    public function getIntroduction(){return view('component.introduction');}

    //내정보 보기
    public function getUser(){return view('auth.profile_check');}

    /*소셜라이트 회원 가입양식*/ 
    public function getRegister(){
        return view('auth.socialiteRegister');
    }
    /*소셜라이트 회원 내정보*/
    public function getUserInfo(){
        return view('auth.socialiteProfile');
    }
}


