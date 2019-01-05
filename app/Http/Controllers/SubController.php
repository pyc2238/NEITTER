<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubController extends Controller
{
    //사이트 소개 URL
    public function getIntroduction(){return view('home.component.introduction');}

   
}


