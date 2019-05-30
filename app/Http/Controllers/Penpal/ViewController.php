<?php

namespace App\Http\Controllers\Penpal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\Translation;
use Auth;

use App\Models\Users\User;
use App\Models\Penpal\Timeline;
use App\Models\Penpal\Penpal;


class ViewController extends Controller
{
    use Translation;

    private $timelineModel      = null;
    private $penpalModel        = null;
    private $userModel          = null;
  

    public function __construct(){
        
        $this->timelineModel    = new Timeline();
        $this->penpalModel      = new Penpal();
        $this->userModel        = new User();
   
    }

    //펜팔 메인 페이지
    public function index (Request $request){
             
        if($request->list){
            $list = $request->list;
        }else{
            $list = 12;
        };


        //query builder
        $query =  $this->penpalModel->query();

        //user fields
        if(
            $request->name || 
            $request->ageMin ||
            $request->ageMax ||
            ($request->gender && $request->gender !== 'all') ||
            ($request->country && $request->country !== 'all')
        ){
            $query->whereHas('user', function($query) use ($request){           //관계의 존재 여부에 따라 쿼리를 질의한다.
                if($request->name){
                    $query->where('name', 'like', '%' . $request->name . '%');
                }

                if($request->gender && $request->gender !== 'all'){
                    $query->where('gender', $request->gender);
                }

                if($request->country && $request->country !== 'all'){
                    $query->where('country', $request->country);
                }

                if($request->ageMin){
                    $query->where('age', '>', floor($request->ageMin));
                }

                if($request->ageMax){
                    $query->where('age', '<', floor($request->ageMax));
                }
            });
        }

        //goal search
        if ($request->goal && $request->goal !== 'all') {
            $query->where('goal_id', $request->goal);
        }

        //search result
        $penpals = $query
            ->with(['user:id,name,gender,country,age'])
            ->latest()
            ->paginate($list);

        //Content translation
         foreach($penpals as $penpal){
            $translationPenpal = $this->translation($penpal->self_context,$this->langCode($penpal->self_context));
            $penpal->translation = $translationPenpal;
         
        }

        return view('penpal.index')->with([
            'penpals'       => $penpals,
            'penpalsCount'  => $penpals->count(),   //db에 포함된 모든 결과의 수를 가져옴
            'nickname'      => $request->name,
            'list'          => $list, 
            'page'          => $request->page,   
        ]);
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
