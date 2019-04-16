<?php

namespace App\Http\Controllers\InquiryBoard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Helper\Translation;


use Auth;
use App\Models\Users\User;
use App\Models\Inquiries\inquiryBoard;
use App\Models\Inquiries\inquiryBoard_commends;
use App\Models\Inquiries\inquiryBoard_hit;
use App\Models\Inquiries\inquiryBoard_ip;
use App\Models\Inquiries\inquiryBoard_Comment;

class inquiryBoardController extends Controller
{
    use Translation;

    private $inquiryModel   = null;
    private $commendsModel  = null;
    private $hitsModel      = null;
    private $ipsModel       = null;
    private $commentModel   = null;

    public function __construct(){
        $this->inquiryModel = new inquiryBoard();
        $this->commendsModel = new inquiryBoard_commends();
        $this->hitsModel = new inquiryBoard_hit();
        $this->ipsModel = new inquiryBoard_ip();
        $this->commentModel = new inquiryBoard_Comment();
        $this->middleware('loginCheck')->only(['edit','destroy']);
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $msgs =  $this->inquiryModel->getMsgs();
        $count = count(inquiryBoard::all());

        if($request->search){
            
            switch($request->where){

                case "title":
                    $msgs = $this->inquiryModel->search('title',$request->search);  
                    $count = $this->inquiryModel->searchCount('title',$request->search);
                    break;
                case "writer":
                    $msgs = $this->inquiryModel->searchWriter($request->search);             
                    $count = $this->inquiryModel->searchWriterCount($request->search);
                    break;
                case "content":
                    $msgs = $this->inquiryModel->search('content',$request->search); 
                    $count = $this->inquiryModel->searchCount('content',$request->search);
                    break;
                case "titleAndcotent":
                    $msgs = $this->inquiryModel->searchTitleAndCotent($request->search); 
                    $count = $this->inquiryModel->searchTitleAndCotentCount($request->search);
                    break;    
            }
        }
        
        return
            view('inquiry.index')
            ->with('page',$request->page)
            ->with('search',$request->search)
            ->with('where',$request->where)
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
        return 
            view('inquiry.create')
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
    
        $this->inquiryModel->insertMsg(Auth::user()->country,$request->title,$request->content,Auth::user()->id,$request->getClientIp());
        
        return 
            redirect()
            ->route('inquiry.index')
            ->with('search',$request->search)
            ->with('where',$request->where);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request,$id)
    {
        if(session('locale') == 'ja'){
            $message = '該当権限がありません';
        }else{
            $message = '글을 열람할 권한이 없습니다.';
        }


        $user = $this->inquiryModel->getMsg($id);
       
        //로그인 여부를 판단
        if(!Auth::check()){
            return back()->with('message',$message);
                
        }else{
            //해당 문의 글을 작성한 작성자 또는 운영자
            if(Auth::user()->id != $user->user_id && Auth::user()->admin != 1 ){
                return back()->with('message',$message);
            }
        }

        
        $comments = $this->commentModel->getComments($id);
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
        
        $translationTitle = $this->translation($inquiry->title,$this->langCode($inquiry->title));
        $translationContent = $this->translation($inquiry->content,$this->langCode($inquiry->content));
         
        
        return
            view('inquiry.show')
            ->with('inquiry',$inquiry)
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

    public function edit(Request $request,$id)
    {
        
        if(session('locale') == 'ja'){
            $message = '修正権限がありません。';
        }else{
            $message = '수정권한이 없습니다.';
        }

        $user = $this->inquiryModel->getMsg($id);

        if(Auth::user()->id == $user->user_id ){
            return 
                view('inquiry.edit')
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

    public function update(Request $request, $id)
    {
        
        $this->inquiryModel->updateMsg($id,$request->title,$request->content,$request->getClientIp());
        return redirect(route('inquiry.index',['search'=>$request->search,'where'=>$request->where,'page'=>$request->page]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request,$id)
    {
    
        if(session('locale') == 'ja'){
            $message = '削除権限がありません。';
        }else{
            $message = '삭제권한이 없습니다.';
        }

        $user = $this->inquiryModel->getMsg($id);

        
         if(Auth::user()->id == $user->user_id || Auth::user()->admin == 1 ){
            $this->inquiryModel->deleteMsg('num',$id);
            return redirect(route('inquiry.index',['search'=>$request->search,'where'=>$request->where,'page'=>$request->page]));
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
        
        if($result){
            return back()->with('message',$message);
        }else{
            $this->commendsModel->insertCommendId(Auth::user()->id,$id);
            $this->inquiryModel->updateCommend($id);
          
            return redirect(route('inquiry.show',['id'=>$id,'search'=>$request->search,'where'=>$request->where,'page'=>$request->page]));
        }
    }


    public function postInsertComment(Request $request,$id){
       
            $this->commentModel->insertComment($request->comment,Auth::user()->country,$id,Auth::user()->id,$request->getClientIp());
            // return response()->json($comments, 200, [], JSON_PRETTY_PRINT);
        
        return redirect(route('inquiry.show',['id'=>$id,'search'=>$request->search,'where'=>$request->where,'page'=>$request->page]));
    }


    public function putUpdateComment(Request $request,$id){
        
            $this->commentModel->updateComments($request->commentId,$request->comment,$request->getClientIp());
        
        return redirect(route('inquiry.show',['id'=>$id,'search'=>$request->search,'where'=>$request->where,'page'=>$request->page]));
    }

    public function getDeleteComment(Request $request,$id){
            
            $this->commentModel->deleteMsg('id',$request->commentId);

        return redirect(route('inquiry.show',['id'=>$id,'search'=>$request->search,'where'=>$request->where,'page'=>$request->page]));
    }
    
}
