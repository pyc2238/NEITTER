<?php

namespace App\Http\Controllers\Penpal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Models\Users\User;

class ViewController extends Controller
{
    //펜팔 메인 페이지
    public function index (){

        return view('penpal.index');

    }

    //펜팔 소개 페이지
    public function introduction (){

        return view('penpal.introduction');

    }

    //펜팔 등록 페이지
    public function timeline (){

        return view('penpal.timeline');

    }

    //펜팔 등록 페이지
    public function registration (){

        return view('penpal.registration');

    }
}
