<?php

namespace App\Http\Controllers\Community; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Helper\Translation;

use Auth;

use App\Models\Communities\Community;
use App\Models\Communities\Communities_hit;
use App\Models\Communities\Communities_ip;
use App\Models\Communities\Communities_Comment;
use App\Models\Users\Point;
use App\Models\Users\User;


class CommunityContoller extends Controller
{
    use Translation;

    private $communityModel = null;
    private $hitsModel      = null;
    private $ipsModel       = null;
    private $commentModel   = null;
    private $pointModel     = null;
    private $userModel      = null;
    
    public function __construct(){
        $this->communityModel   = new Community();
        $this->hitsModel        = new Communities_hit();
        $this->ipsModel         = new Communities_ip();
        $this->commentModel     = new Communities_Comment();
        $this->pointModel       = new Point();
        $this->userModel        = new User();
        $this->middleware('loginCheck')->only(['edit','destroy']);
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index(Request $request)
    {
       
        $msgs =  $this->communityModel->getMsgs();
        $commentCount = $this->communityModel->with(['comments']);
        $count = count(Community::all());

        if($request->search){
            switch($request->where){
                    
                case "title":
                    $msgs   = $this->communityModel->search('title',$request->search);  
                    $count  = $this->communityModel->searchCount('title',$request->search);
                    break;
                case "writer":
                    $msgs   = $this->communityModel->searchWriter($request->search); 
                    $count  = $this->communityModel->searchWriterCount($request->search);
                    break;
                case "content":
                    $msgs   = $this->communityModel->search('content',$request->search);  
                    $count  = $this->communityModel->searchCount('content',$request->search);
                    break;
                case "titleAndcotent":
                    $msgs   = $this->communityModel->searchTitleAndCotent($request->search); 
                    $count  = $this->communityModel->searchTitleAndCotentCount($request->search);
                    break;    
            }
        }
        // $autoSearch = $this->communityModel->select('title')->get(); //테이블 자동 검색창

        return 
            view('community.index')
            ->with('page',$request->page)
            ->with('search',$request->search)
            ->with('where',$request->where)
            ->with('msgs',$msgs)
            ->with('count',$count);
            // ->with('autoSearch',$autoSearch);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(Request $request)
    {
        
        return 
            view('community.create')
            ->with('page',$request->page)
            ->with('search',$request->search)
            ->with('where',$request->where);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    
    public function store(Request $request)
    {
       
        
        $this->communityModel->insertMsg(
                Auth::user()->country,
                $request->title,
                $request->content,
                Auth::user()->id,
                $request->getClientIp()
            );


        $userPoint = $this->pointModel->where('user_id',Auth::id())->first();
        $user = $this->userModel->where('id',Auth::id())->first();

        //당일 최초로그인시 2포인트 지급
        if($userPoint->community_point != 5){
            $userPoint->community_point += 1;
            $userPoint->save();

            $user->point += $userPoint->community_point;
            $user->save();
        }
            
        return 
            redirect()
            ->route('community.index')
            ->with('search',$request->search)
            ->with('where',$request->where);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //해당 아이디의 관련정보를 보여줌
    public function show(Request $request,$id)
    {
     
        $comments = $this->commentModel->getComments($id);
        $ip       = $this->ipsModel->getHitsIp($request->getClientIp(),$id); //사용자의 ip값으로 레코드를 받아온다.
        
        if(!Auth::check()){ //사용자의 로그인 여부 판단
            if(!$ip){    //해당 ip로 저장된 레코드가 존재하지않다면
                $this->ipsModel->insertHitIp($id,$request->getClientIp()); //데이터베이스에 ip와 게시판 번호를 저장
                $this->communityModel->updateHits($id);//조회수 1 증가    
             }
            }else{
                $userId = $this->hitsModel->getHitsId(Auth::user()->id,$id);  //사용자의 id값으로 레코드를 받아온다.
                if(!$userId ){ //해당 id로 저장된 레코드가 존재하지 않다면
                    $this->hitsModel->insertHitId(Auth::user()->id,$id);//데이터베이스에 id와 게시판 번호를 저장
                    $this->communityModel->updateHits($id);//조회수 1 증가
                }
            }
        
        $community = $this->communityModel->getMsg($id);
        
        $translationTitle   = $this->translation($community->title,$this->langCode($community->title));
        $translationContent = $this->translation($community->content,$this->langCode($community->content));


        //댓글 내용 번역
        foreach($comments as $comment){
                $translationComment = $this->translation($comment->content,$this->langCode($comment->content));
                $comment->translation = $translationComment;
            }
          
          
            
         
        return
            view('community.show')
            ->with('community',$community)
            ->with('page',$request->page)
            ->with('search',$request->search)
            ->with('where',$request->where)
            ->with('comments',$comments)
            ->with('commentCount',count($comments))
            ->with('translationTitle',$translationTitle)
            ->with('translationContent',$translationContent);
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    //해당 아이디의 수정 폼
    public function edit(Request $request,$id)
    {   
        if(session('locale') == 'ja'){
            $message = '修正権限がありません。';
        }else{
            $message = '수정권한이 없습니다.';
        }
        
        $user = $this->communityModel->getMsg($id);

        if(Auth::user()->id == $user->user_id ){
            return 
                view('community.edit')
                ->with('page',$request->page)
                ->with('search',$request->search)
                ->with('where',$request->where)
                ->with('id',$id)
                ->with('title',$user->title)
                ->with('content',$user->content);
        }else{
            return back()->with('message',$message);
        }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //해당 아이디 값 수정
    public function update(Request $request, $id)
    {
    
         
            $this->communityModel->updateMsg(
                $id,$request->title,
                $request->content,
                $request->getClientIp()
            );

        return redirect(route('community.index',[
            'search'   =>$request->search,
            'where'    =>$request->where,
            'page'     =>$request->page
            ])
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //해당 아이디 데이터 삭제
    public function destroy(Request $request,$id)
    {
        if(session('locale') == 'ja'){
            $message = '削除権限がありません。';
        }else{
            $message = '삭제권한이 없습니다.';
        }

        $user = $this->communityModel->getMsg($id);

         if(Auth::user()->id == $user->user_id || Auth::user()->admin == 1 ){
                $this->communityModel->deleteMsg('num',$id);
            return redirect(route('community.index',[
                'search'   =>$request->search,
                'where'    =>$request->where,
                'page'     =>$request->page
                ])
            );
        }else{
            return back()->with('message',$message);
        }      
    }


    // public function fetch_data(Request $request){
    //     if($request->ajax()){
    //         $msgs = Coumminty::orderBy('num','desc')->paginate(2);
    //         return view('community.component.indexTable',compact('msgs'))->render();
    //     }
    // }


}
