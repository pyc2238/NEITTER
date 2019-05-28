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

    private $timelineModel  = null;
    private $penpalModel    = null;
    private $userModel      = null;

    public function __construct(){
        $this->timelineModel    = new Timeline();
        $this->penpalModel      = new Penpal();
        $this->userModel        = new User();
    }

    

    //펜팔 메인 페이지
    public function index (Request $request){

        $penpals =  $this->penpalModel->getUsers()->latest()->paginate(12);
        $penpalsCount = count($penpals);
         
        //닉네임 검색시 
        if($request->name){
            $user = $this->userModel->where('name',$request->name)->first();

        if(!$user){
                return back()->with('message','해당 닉네임의 검색결과가 없습니다.');
            }

            foreach($penpals as $penpal){

                $penpals = $penpal->where('user_id',$user->id)->latest()->paginate(12);
                $penpalsCount = count($penpals);
            }          
         }


            // //  성별 검색 
            // if($request->gender != 'all'){
            // $users = $this->userModel->where('gender',$request->gender)->with('penpal_user')->get();
            
            
            // $penpals =  $users->pluck('penpal_user')->filter(function ($value, $key) {
            //         return !$value->isEmpty();
            //     });

                // return json_encode($penpals,JSON_UNESCAPED_UNICODE);
                // $i = 0;
                // foreach($penpals as $penpal){
                //   $i++; 
                // }
                // return $i;
                // $penpalsCount = count($penpals);  
            
            // }
    


        //  if($request->ageMin && $request->ageMax){
        //     $ageMin = floor($request->ageMin);
        //     $ageMax = floor($request->ageMax);
    
        //     $users = $this->userModel->whereBetween('age', [$ageMin, $ageMax])->get();
           
        //     foreach($users as $user){
                
        //         foreach($penpals as $penpal){
                    
        //             $penpals = $penpal->where('user_id',$user->id)->latest()->paginate(12);
        //             $penpalsCount = count($penpals);
        //         } 
        //     }

            // return $penpals;
                
    
        //    }

        
         //내용 번역
         foreach($penpals as $penpal){

            $translationTimeline = $this->translation($penpal->self_context,$this->langCode($penpal->self_context));
            $penpal->translation = $translationTimeline;
         
    }
        
 
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
