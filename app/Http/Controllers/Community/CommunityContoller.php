<?php

namespace App\Http\Controllers\Community; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\SubController\TranslationController;



use Auth;

use App\Models\User;
use App\Models\Community;
use App\Models\Communities_commends;
use App\Models\Communities_hit;
use App\Models\Communities_ip;
use App\Models\Communities_Comment;

use Illuminate\Support\Facades\DB;


class CommunityContoller extends Controller
{

    private $communityModel = null;
    private $commendsModel  = null;
    private $hitsModel      = null;
    private $ipsModel       = null;
    private $commentModel   = null;
    private $translation    = null;
    
    public function __construct(){
        $this->communityModel = new Community();
        $this->commendsModel = new Communities_commends();
        $this->hitsModel = new Communities_hit();
        $this->ipsModel = new Communities_ip();
        $this->commentModel = new Communities_Comment();
        $this->translation = new TranslationController();
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
        $count = count(Community::all());

        if($request->search){
            switch($request->where){
                    
                case "title":
                    $msgs = $this->communityModel->search('title',$request->search);  
                    $count = $this->communityModel->searchCount('title',$request->search);
                    break;
                case "writer":
                    $msgs = $this->communityModel->searchWriter($request->search); 
                    $count = $this->communityModel->searchWriterCount($request->search);
                    // $msgs = $this->communityModel->searchWriter("communities",$search); 
                    // $count = $this->communityModel->searchWriterCount("communities",$search);
                    break;
                case "content":
                    $msgs = $this->communityModel->search('content',$request->search);  
                    $count = $this->communityModel->searchCount('content',$request->search);
                    break;
                case "titleAndcotent":
                    $msgs = $this->communityModel->searchTitleAndCotent($request->search); 
                    $count = $this->communityModel->searchTitleAndCotentCount($request->search);
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
        if(session('locale') == 'ja'){
            $message = 'スレッド作成が完了しました。';
        }else{
            $message = '글 작성이 완료되었습니다.';
        }
        
        $this->communityModel->insertMsg(Auth::user()->country,$request->title,$request->content,Auth::user()->id,$request->getClientIp());
        
        return 
            redirect()
            ->route('community.index')
            ->with('message',$message)
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
        $ip = $this->ipsModel->getHitsIp($request->getClientIp(),$id); //사용자의 ip값으로 레코드를 받아온다.
        
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
        
        $translationTitle = $this->translation->translation($community->title,$this->translation->langCode($community->title));
        $translationContent = $this->translation->translation($community->content,$this->translation->langCode($community->title));
         
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
    
            if(session('locale') == 'ja'){
                $message = 'スレッドが修正されました。';
            }else{
                $message = '게시물이 수정되었습니다.';
            }

        
            $this->communityModel->updateMsg($id,$request->title,$request->content,$request->getClientIp());

        return redirect(route('community.index',['search'=>$request->search,'where'=>$request->where,'page'=>$request->page]))->with('message',$message);
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
            return redirect(route('community.index',['search'=>$request->search,'where'=>$request->where,'page'=>$request->page]));
        }else{
            return back()->with('message',$message);
        }      
    }


    public function putIncreaseCommend(Request $request,$id){

       
        if(session('locale') == 'ja'){
            $message = 'すでに推薦したスレッドです';
        }else{
            $message = '이미 추천을 누른 게시물입니다.';
        }

          
        $result = $this->commendsModel->getCommendId(Auth::user()->id,$id);
        
        if($this->commendsModel->getCommendId(Auth::user()->id,$id)){
            return back()->with('message',$message);
        }else{
                $this->commendsModel->insertCommendId(Auth::user()->id,$id);
                $this->communityModel->updateCommend($id);
          
            return redirect(route('community.show',['id'=>$id,'search'=>$request->search,'where'=>$request->where,'page'=>$request->page]));
        }
    }


    public function postInsertComment(Request $request,$id){
            $this->commentModel->insertComment($request->comment,Auth::user()->country,$id,Auth::user()->id,$request->getClientIp());
            // return response()->json($comments, 200, [], JSON_PRETTY_PRINT);
        return redirect(route('community.show',['id'=>$id,'search'=>$request->search,'where'=>$request->where,'page'=>$request->page]));
    }


    public function putUpdateComment(Request $request,$id){
    
            $this->commentModel->updateComments($request->commentId,$request->comment,$request->getClientIp());
        
        return redirect(route('community.show',['id'=>$id,'search'=>$request->search,'where'=>$request->where,'page'=>$request->page]));
    }

    public function getDeleteComment(Request $request,$id){
            $this->commentModel->deleteMsg('id',$request->commentId);
        
        return redirect(route('community.show',['id'=>$id,'search'=>$request->search,'where'=>$request->where,'page'=>$request->page]));
    }


    // public function fetch_data(Request $request){
    //     if($request->ajax()){
    //         $msgs = Coumminty::orderBy('num','desc')->paginate(2);
    //         return view('community.component.indexTable',compact('msgs'))->render();
    //     }
    // }


}
