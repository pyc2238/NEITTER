<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SubController extends Controller
{
    //사이트 소개 URL
    public function introduction(){
        return view('component.introduction');
    }

    public function userCheck(){
        return view('auth.profile_check');
    }

}
