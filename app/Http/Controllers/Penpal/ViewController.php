<?php

namespace App\Http\Controllers\Penpal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\Translation;
use Auth;

use App\Models\Users\User;
use App\Models\Penpal\Timeline;
use App\Models\Penpal\Penpal;
use App\Models\Penpal\Visitor;


class ViewController extends Controller
{
    use Translation;

    private $timelineModel      = null;
    private $penpalModel        = null;
    private $userModel          = null;
    private $visitorModel       = null;
  

    public function __construct(){
        
        $this->timelineModel    = new Timeline();
        $this->penpalModel      = new Penpal();
        $this->userModel        = new User();
        $this->visitorModel     = new Visitor();
   
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

        //is has photo
        if($request->cehck_photo){
            $query->whereNotNull('image');
        }

        //전체 조회 개수
        $penpalsCount = count($query->get());

        //search result
        $penpals = $query
            ->with(['user:id,name,gender,country,age,selfPhoto'])
            ->latest()
            ->paginate($list);


       

        //Content translation
         foreach($penpals as $penpal){
            
            //컨텐츠 글자 길이가 1 이상이면 0~500글자 까지만 출력
            if (strlen($penpal->self_context) > 1)
                $penpal_content_str = substr($penpal->self_context, 0, 500);
                
                $translationPenpal = $this->translation(
                        $penpal_content_str,
                        $this->langCode($penpal->self_context)
                );

            $penpal->translation = $translationPenpal;
         
        }

        return view('penpal.index')->with([
            'penpals'       => $penpals,
            'penpalsCount'  => $penpalsCount,   //db에 포함된 모든 결과의 수를 가져옴
            'nickname'      => $request->name,
            'list'          => $list, 
            'page'          => $request->page,   
        ]);
    }

    public function show($id){


        $friend = $this->penpalModel->getUser()->where('id',$id)->first();
        

        if(Auth::check() && $friend->user->id != Auth::id()){
            $friend->increment('visitors_count');
            $this->visitorModel->create([
                    'user_id'   => Auth::id(),
                    'penpal_id' => $friend->id,
                ]);
        }

        // 해당 펜팔의 방문자 구하기
        $visitors = $this->penpalModel->find($friend->id)->visitor_user()->get();
        
        // 해당 펜팔의 호감을 보인 유저 구하기
        $winks = $this->penpalModel->find($friend->id)->wink_user()->get();
      
        $friendTimeline = $this->timelineModel->
                where('user_id',$friend->user_id)
                ->where('is_system',0)
                ->latest()
                ->paginate(5);
        
        //펜팔 내용 번역
        $translationPenpal = $this->translation(
                $friend->self_context,
                $this->langCode($friend->self_context)
            );

        $friend->translation = $translationPenpal;

        //타임라인 내용 번역
        foreach($friendTimeline as $timeline){
            if($timeline->content != null){
                $translationTimeline = $this->translation(
                    $timeline->content,
                    $this->langCode($timeline->content)
                );
                $timeline->translation = $translationTimeline;
            } 
        }

        return view('penpal.show')->with([
            'friend'        => $friend,
            'timelines'     => $friendTimeline,
            'visitors'      => $visitors,
            'winks'         => $winks,
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
                $translationTimeline = $this->translation(
                    $timeline->content,
                    $this->langCode($timeline->content)
                );
                $timeline->translation = $translationTimeline;
            } 
            
        }
        
        return view('penpal.timeline')->with('timelines',$timelines);

    }

    //펜팔 등록 페이지
    public function registration (){

        return view('penpal.registration');
    
    }

    public function edit(Request $request,$id){

        $penpal_id = $this->penpalModel->where('id',$id)->first();

        return view('penpal.edit')->with('penpal_id',$penpal_id);
    }

}
