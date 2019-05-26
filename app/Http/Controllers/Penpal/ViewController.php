<?php

namespace App\Http\Controllers\Penpal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\Translation;
use Auth;

use App\Models\Users\User;
use App\Models\Penpal\Timeline;

class ViewController extends Controller
{
    use Translation;

    private $timelineModel = null;

    public function __construct(){
        $this->timelineModel = new Timeline();
    }



    //펜팔 메인 페이지
    public function index (){

        return view('penpal.index');

    }

    //펜팔 소개 페이지
    public function introduction (){

        return view('penpal.introduction');

    }

    //타임라인 등록 페이지
    public function timeline (){

        $timelines = $this->timelineModel->getUser()->latest()->paginate(10);

        //내용 번역
        foreach($timelines as $timeline){
            if($timeline->content != null){
                $translationTimeline = $this->translation($timeline->content,$this->langCode($timeline->content));
                $timeline->translation = $translationTimeline;
            } 
            
        }
        
        return view('penpal.timeline')->with('timelines',$timelines);

    }

    //펜팔 등록 페이지
    public function registration (){

        return view('penpal.registration');

    }
}
