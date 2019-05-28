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
      
        //default value
        $penpals =  $this->penpalModel->getUsers()->latest()->paginate(12);
        

        //닉네임 검색시 
        if($request->name){
    
            $user = $this->userModel->where('name',$request->name)->first();

            //검색 결과가 없을 시 
            if(!$user){
                return back()->with('message','해당 닉네임의 검색결과가 없습니다.');
            }

            foreach($penpals as $penpal){
                $penpals = $penpal->where('user_id',$user->id)->latest()->paginate(12);
            }          
           
         }


            //성별 검색 
            if($request->gender != null){
                if($request->gender != 'all'){
                    $penpals = $this->penpalModel->leftJoin('users', 'penpals.user_id', '=', 'users.id')
                    ->select('penpals.*', 'users.gender')
                    ->where('users.gender', $request->gender)
                    ->orderBy('penpals.created_at','desc')->paginate(12);
                }
            }
            

            // 국적 검색 
            if($request->country != null){
                if($request->country != 'all'){
                    $penpals = $this->penpalModel->leftJoin('users', 'penpals.user_id', '=', 'users.id')
                    ->select('penpals.*', 'users.country')
                    ->where('users.country', $request->country)
                    ->orderBy('penpals.created_at','desc')->paginate(12);
                }
             }

            // 목적 검색
             if($request->goal != null){
                if($request->goal != 'all'){
                    $penpals = $this->penpalModel->where('goal_id',$request->goal)->latest()->paginate(12);

                    if(!$penpals){
                        return back()->with('message','해당 닉네임의 검색결과가 없습니다.');
                    }
                }
            }

            //나이로 검색
            if($request->ageMin != 1 || $request->ageMax != 100 ){
    
                $ageMin = floor($request->ageMin);
                $ageMax = floor($request->ageMax);

                $penpals = $this->penpalModel->leftJoin('users', 'penpals.user_id', '=', 'users.id')
                ->select('penpals.*', 'users.age')
                ->whereBetween('users.age', [$ageMin, $ageMax])
                ->orderBy('penpals.created_at','desc')->paginate(12);

                if(!$penpals){
                    return back()->with('message','해당 연령대의 검색결과가 없습니다.');
                }

            } 

            
         //내용 번역
         foreach($penpals as $penpal){

            $translationTimeline = $this->translation($penpal->self_context,$this->langCode($penpal->self_context));
            $penpal->translation = $translationTimeline;
         
        }
        
      
        $penpalsCount = count($penpals);        //검색 조회 펜팔 결과 수

        return view('penpal.index')->with([
            'penpals'       => $penpals,
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
