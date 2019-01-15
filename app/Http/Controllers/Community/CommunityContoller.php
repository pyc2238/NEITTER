<?php

namespace App\Http\Controllers\Community; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\SubController\TranslationController;

use Session; 
use Auth;

use App\User;
use App\Community;
use App\Communities_commends;
use App\Communities_hit;
use App\Communities_ip;
use App\Communities_Comment;

use Illuminate\Support\Facades\DB;


class CommunityContoller extends Controller
{
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
        
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
        
        $msgs = $this->communityModel->getMsgs();
        $count = count(Community::all());
       
        if($search){
            switch($where){
                    
                case "title":
                    $msgs = $this->communityModel->searchTitle($search);  
                    $count = $this->communityModel->searchTitleCount($search);
                    break;
                case "writer":
                    $msgs = $this->communityModel->searchWriter($search); 
                    $count = $this->communityModel->searchWriterCount($search);
                    break;
                case "content":
                    $msgs = $this->communityModel->searchContent($search); 
                    $count = $this->communityModel->searchContentCount($search);
                    break;
                case "titleAndcotent":
                    $msgs = $this->communityModel->searchTitleAndCotent($search); 
                    $count = $this->communityModel->searchTitleAndCotentCount($search);
                    break;    
            }
        }

        // $autoSearch = $this->communityModel->select('title')->get(); //테이블 자동 검색창
      
        return 
            view('community.index')
            ->with('page',$page)
            ->with('search',$search)
            ->with('where',$where)
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
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;

        return 
            view('community.create')
            ->with('page',$page)
            ->with('search',$search)
            ->with('where',$where);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    
    public function store(Request $request)
    {
        $search = $request->search;
        $where = $request->where;
        
        $this->communityModel->insertMsg(Auth::user()->country,$request->title,$request->content,Auth::user()->id,$request->getClientIp());
        
        
        if(Session::get('locale') == 'ja'){
            $message = 'スレッド作成が完了しました。';
        }else{
            $message = '글 작성이 완료되었습니다.';
        }


        return 
            redirect()
            ->route('community.index')
            ->with('message',$message)
            ->with('search',$search)
            ->with('where',$where);
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
     
       
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
        $comments = $this->commentModel->getComments($id);
        $commentCount = count($comments);
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
            ->with('page',$page)
            ->with('search',$search)
            ->with('where',$where)
            ->with('comments',$comments)
            ->with('commentCount',$commentCount)
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
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
        $user = $this->communityModel->getMsg($id);

        if(Session::get('locale') == 'ja'){
            $message = '修正権限がありません。';
        }else{
            $message = '수정권한이 없습니다.';
        }


        if(Auth::user()->id == $user->user_id ){
            return 
                view('community.edit')
                ->with('page',$page)
                ->with('search',$search)
                ->with('where',$where)
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
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;

        if(Session::get('locale') == 'ja'){
            $message = 'スレッドが修正されました。';
        }else{
            $message = '게시물이 수정되었습니다.';
        }

        
        $this->communityModel->updateMsg($id,$request->title,$request->content,$request->getClientIp());
        return redirect(route('community.index',['search'=>$search,'where'=>$where,'page'=>$page]))->with('message',$message);
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
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
        $user = $this->communityModel->getMsg($id);

        if(Session::get('locale') == 'ja'){
            $message = '削除権限がありません。';
        }else{
            $message = '삭제권한이 없습니다.';
        }

        
         if(Auth::user()->id == $user->user_id ){
            $this->communityModel->deleteMsg($id);
            return redirect(route('community.index',['search'=>$search,'where'=>$where,'page'=>$page]));
        }else{
            return back()->with('message',$message);
        }      
    }


    public function putIncreaseCommend(Request $request,$id){
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
       
        if(Session::get('locale') == 'ja'){
            $message = 'すでに推薦したスレッドです';
        }else{
            $message = '이미 추천을 누른 게시물입니다.';
        }


        $userNum = Auth::user()->id;  
        $result = $this->commendsModel->getCommendId($userNum,$id);
        
        if($result){
            return back()->with('message',$message);
        }else{
            $this->commendsModel->insertCommendId($userNum,$id);
            $this->communityModel->updateCommend($id);
          
            return redirect(route('community.show',['id'=>$id,'search'=>$search,'where'=>$where,'page'=>$page]));
        }
    }


    public function postInsertComment(Request $request,$id){
        $page = $request->page;
        $search = $request->search;
        $where = $request->where; 

        
        $this->commentModel->insertComment($request->comment,Auth::user()->country,$id,Auth::user()->id,$request->getClientIp());
    
      
        // return response()->json($comments, 200, [], JSON_PRETTY_PRINT);
        
        return redirect(route('community.show',['id'=>$id,'search'=>$search,'where'=>$where,'page'=>$page]));
    }


    public function putUpdateComment(Request $request,$id){
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
        
        $this->commentModel->updateComments($request->commentId,$request->comment,$request->getClientIp());
        
        return redirect(route('community.show',['id'=>$id,'search'=>$search,'where'=>$where,'page'=>$page]));
    }

    public function getDeleteComment(Request $request,$id){
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
        $this->commentModel->deleteComments($request->commentId);
        return redirect(route('community.show',['id'=>$id,'search'=>$search,'where'=>$where,'page'=>$page]));
    }


    // public function fetch_data(Request $request){
    //     if($request->ajax()){
    //         $msgs = Coumminty::orderBy('num','desc')->paginate(2);
    //         return view('community.component.indexTable',compact('msgs'))->render();
    //     }
    // }


}
