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
      
        //base Object
        $penpals =  $this->penpalModel->getUsers();
        

        //닉네임 검색
        if (!empty($request->name)) {
            $users = $this->userModel->where('name', 'like', '%' . $request->name . '%')->get();
            if (!empty($users)) {

                $penpals->whereIn('user_id', $users);
            }        
        }


        //성별 검색
        if (!empty($request->gender) && $request->gender !== 'all') { 
            $penpals->leftJoin('users', 'penpals.user_id', '=', 'users.id')
            ->select('penpals.*', 'users.gender')
            ->where('users.gender', $request->gender); 
        }


        // 국적 검색 
        if (!empty($request->country) && $request->country !== 'all') { 
        $penpals->leftJoin('users', 'penpals.user_id', '=', 'users.id')
        ->select('penpals.*', 'users.country')
        ->where('users.country', $request->country); 
        }


         // 목적 검색
         if (!empty($request->goal) && $request->goal !== 'all') {
 
            $penpals = $this->penpalModel->where('goal_id',$request->goal)->latest();
         }


        //나이로 검색
        if($request->ageMin != 1 || $request->ageMax != 100 ){

            $ageMin = floor($request->ageMin);
            $ageMax = floor($request->ageMax);

            $penpals = $this->penpalModel->leftJoin('users', 'penpals.user_id', '=', 'users.id')
            ->select('penpals.*', 'users.age')
            ->whereBetween('users.age', [$ageMin, $ageMax])
            ->orderBy('penpals.created_at','desc');

        }

        
        //search result
        $penpalsData = $penpals->orderBy('penpals.created_at','desc')->paginate(12); 
         
        //내용 번역
         foreach($penpalsData as $penpal){

            $translationTimeline = $this->translation($penpal->self_context,$this->langCode($penpal->self_context));
            $penpal->translation = $translationTimeline;
         
        }
        
        $penpalsCount = count($penpalsData);

        return view('penpal.index')->with([
            'penpals'       => $penpalsData,
            'penpalsCount'  => $penpalsCount
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
