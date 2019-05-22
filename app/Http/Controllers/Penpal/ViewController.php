<?php

namespace App\Http\Controllers\Penpal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    //펜팔 메인 사이트
    public function index (){

        return view('penpal.index');

    }
}
