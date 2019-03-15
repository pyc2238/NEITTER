<?php

namespace App\Http\Controllers\InquiryBoard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\SubController\TranslationController;

use Session; 
use Auth;
use App\Models\User;
use App\Models\inquiryBoard;
use App\Models\inquiryBoard_commends;
use App\Models\inquiryBoard_hit;
use App\Models\inquiryBoard_ip;
use App\Models\inquiryBoard_Comment;

class inquiryBoardController extends Controller
{

    private $inquiryModel   = null;
    private $commendsModel  = null;
    private $hitsModel      = null;
    private $ipsModel       = null;
    private $commentModel   = null;
    private $translation    = null;

    public function __construct(){
        $this->inquiryModel = new inquiryBoard();
        $this->commendsModel = new inquiryBoard_commends();
        $this->hitsModel = new inquiryBoard_hit();
        $this->ipsModel = new inquiryBoard_ip();
        $this->commentModel = new inquiryBoard_Comment();
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

        $msgs =  $this->inquiryModel->getMsgs();
        $count = count(inquiryBoard::all());

        if($search){
            
            switch($where){

                case "title":
                    $msgs = $this->inquiryModel->searchTitle($search);  
                    $count = $this->inquiryModel->searchTitleCount($search);
                    break;
                case "writer":
                    $msgs = $this->inquiryModel->searchWriter($search);             
                    $count = $this->inquiryModel->searchWriterCount($search);
                    break;
                case "content":
                    $msgs = $this->inquiryModel->searchContent($search); 
                    $count = $this->inquiryModel->searchContentCount($search);
                    break;
                case "titleAndcotent":
                    $msgs = $this->inquiryModel->searchTitleAndCotent($search); 
                    $count = $this->inquiryModel->searchTitleAndCotentCount($search);
                    break;    
            }
        }
        
        return
            view('inquiry.index')
            ->with('page',$page)
            ->with('search',$search)
            ->with('where',$where)
            ->with('msgs',$msgs)
            ->with('count',$count);
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
            view('inquiry.create')
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
       
        $this->inquiryModel->insertMsg(Auth::user()->country,$request->title,$request->content,Auth::user()->id,$request->getClientIp());
        
        
        if(Session::get('locale') == 'ja'){
            $message = 'お問い合わせ作成が完了しました。';
        }else{
            $message = '문의 작성이 완료되었습니다.';
        }

        return 
            redirect()
            ->route('inquiry.index')
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

    public function show(Request $request,$id)
    {
        $user = $this->inquiryModel->getMsg($id);
       
        if(Session::get('locale') == 'ja'){
            $message = '該当権限がありません';
        }else{
            $message = '글을 열람할 권한이 없습니다.';
        }

        //로그인 여부를 판단
        if(!Auth::check()){
            return back()->with('message',$message);
                
        }else{
            //해당 문의 글을 작성한 작성자 또는 운영자
            if(Auth::user()->id != $user->user_id && Auth::user()->admin != 1 ){
                return back()->with('message',$message);
            }
        }

        
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
        $comments = $this->commentModel->getComments($id);
        $commentCount = count($comments);
        $ip = $this->ipsModel->getHitsIp($request->getClientIp(),$id); //사용자의 ip값으로 레코드를 받아온다.
        
        if(!Auth::check()){ //사용자의 로그인 여부 판단
            if(!$ip){    //해당 ip로 저장된 레코드가 존재하지않다면
                $this->ipsModel->insertHitIp($id,$request->getClientIp()); //데이터베이스에 ip와 게시판 번호를 저장
                $this->inquiryModel->updateHits($id);//조회수 1 증가    
             }
            }else{
                $userId = $this->hitsModel->getHitsId(Auth::user()->id,$id);  //사용자의 id값으로 레코드를 받아온다.
                if(!$userId ){ //해당 id로 저장된 레코드가 존재하지 않다면
                    $this->hitsModel->insertHitId(Auth::user()->id,$id);//데이터베이스에 id와 게시판 번호를 저장
                    $this->inquiryModel->updateHits($id);//조회수 1 증가
                }
            }
        
        $inquiry = $this->inquiryModel->getMsg($id);
        
        $translationTitle = $this->translation->translation($inquiry->title,$this->translation->langCode($inquiry->title));
        $translationContent = $this->translation->translation($inquiry->content,$this->translation->langCode($inquiry->title));
         
        
        return
            view('inquiry.show')
            ->with('inquiry',$inquiry)
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

    public function edit(Request $request,$id)
    {
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
        $user = $this->inquiryModel->getMsg($id);

        if(Session::get('locale') == 'ja'){
            $message = '修正権限がありません。';
        }else{
            $message = '수정권한이 없습니다.';
        }


        if(Auth::user()->id == $user->user_id ){
            return 
                view('inquiry.edit')
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

    public function update(Request $request, $id)
    {
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;

        if(Session::get('locale') == 'ja'){
            $message = 'お問い合わせが修正されました。';
        }else{
            $message = '문의글이 수정되었습니다.';
        }

        
        $this->inquiryModel->updateMsg($id,$request->title,$request->content,$request->getClientIp());
        return redirect(route('inquiry.index',['search'=>$search,'where'=>$where,'page'=>$page]))->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request,$id)
    {
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
        $user = $this->inquiryModel->getMsg($id);

        if(Session::get('locale') == 'ja'){
            $message = '削除権限がありません。';
        }else{
            $message = '삭제권한이 없습니다.';
        }

        
         if(Auth::user()->id == $user->user_id || Auth::user()->admin == 1 ){
            $this->inquiryModel->deleteMsg($id);
            return redirect(route('inquiry.index',['search'=>$search,'where'=>$where,'page'=>$page]));
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
            $this->inquiryModel->updateCommend($id);
          
            return redirect(route('inquiry.show',['id'=>$id,'search'=>$search,'where'=>$where,'page'=>$page]));
        }
    }


    public function postInsertComment(Request $request,$id){
        $page = $request->page;
        $search = $request->search;
        $where = $request->where; 

        $this->commentModel->insertComment($request->comment,Auth::user()->country,$id,Auth::user()->id,$request->getClientIp());
    
      
        // return response()->json($comments, 200, [], JSON_PRETTY_PRINT);
        
        return redirect(route('inquiry.show',['id'=>$id,'search'=>$search,'where'=>$where,'page'=>$page]));
    }


    public function putUpdateComment(Request $request,$id){
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
        
        $this->commentModel->updateComments($request->commentId,$request->comment,$request->getClientIp());
        
        return redirect(route('inquiry.show',['id'=>$id,'search'=>$search,'where'=>$where,'page'=>$page]));
    }

    public function getDeleteComment(Request $request,$id){
        
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
        $this->commentModel->deleteComments($request->commentId);
        return redirect(route('inquiry.show',['id'=>$id,'search'=>$search,'where'=>$where,'page'=>$page]));
    }
    
}
