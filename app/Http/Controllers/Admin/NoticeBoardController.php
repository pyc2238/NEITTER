<?php

namespace App\Http\Controllers\Admin;
// namespace App\Traits;
// namespace App\Http\Traits;




use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\Translation;

use Auth;
use App\Models\Users\User;
use App\Models\Admins\Admin_Notice;
use App\Models\Admins\Admin_Notice_hit;
use App\Models\Admins\Admin_Notice_ip;



class NoticeBoardController extends Controller
{
    use Translation;

    private $noticeModel    = null;
    private $hitsModel      = null;
    private $ipsModel       = null;
    
    
    public function __construct(){
        $this->noticeModel = new Admin_Notice();
        $this->hitsModel = new Admin_Notice_hit();
        $this->ipsModel = new Admin_Notice_ip();
        $this->middleware('loginCheck')->only(['edit','destroy']);
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $msgs = $this->noticeModel->getMsgs();
        $count = count(Admin_Notice::all());
        
        if($request->search){
            switch($request->where){
                    
                case "title":
                    $msgs = $this->noticeModel->search('title',$request->search);  
                    $count = $this->noticeModel->searchCount('title',$request->search);
                    break;
                case "writer":
                    $msgs = $this->noticeModel->searchWriter($request->search); 
                    $count = $this->noticeModel->searchWriterCount($request->search);
                    break;
                case "content":
                    $msgs = $this->noticeModel->search('content',$request->search); 
                    $count = $this->noticeModel->searchCount('content',$request->search);
                    break;
                case "titleAndcotent":
                    $msgs = $this->noticeModel->searchTitleAndCotent($request->search); 
                    $count = $this->noticeModel->searchTitleAndCotentCount($request->search);
                    break;    
            }
        }

        return
            view('notice.index')
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

        if(!Auth::check()){
            return back();
        }else{
            if(Auth::user()->admin != 1){
                return back();
            }
        }

        return 
            view('notice.create')
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
      

        $this->noticeModel->insertMsg(Auth::user()->country,$request->title,$request->content,Auth::user()->id,$request->getClientIp());
        
        return 
            redirect()
            ->route('notice.index')
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
         
        $ip = $this->ipsModel->getHitsIp($request->getClientIp(),$id); //사용자의 ip값으로 레코드를 받아온다.
        
        if(!Auth::check()){ //사용자의 로그인 여부 판단
            if(!$ip){    //해당 ip로 저장된 레코드가 존재하지않다면
                $this->ipsModel->insertHitIp($id,$request->getClientIp()); //데이터베이스에 ip와 게시판 번호를 저장
                $this->noticeModel->updateHits($id);//조회수 1 증가    
             }
            }else{
                $userId = $this->hitsModel->getHitsId(Auth::user()->id,$id);  //사용자의 id값으로 레코드를 받아온다.
                if(!$userId ){ //해당 id로 저장된 레코드가 존재하지 않다면
                    $this->hitsModel->insertHitId(Auth::user()->id,$id);//데이터베이스에 id와 게시판 번호를 저장
                    $this->noticeModel->updateHits($id);//조회수 1 증가
                }
            }
       
        
        $notice = $this->noticeModel->getMsg($id);
        
        $translationTitle = $this->translation($notice->title,$this->langCode($notice->title));
        $translationContent = $this->translation($notice->content,$this->langCode($notice->content));
         
        
        return
            view('notice.show')
            ->with('notice',$notice)
            ->with('page',$request->page)
            ->with('search',$request->search)
            ->with('where',$request->where)
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

        $user = $this->noticeModel->getMsg($id);

        if(Auth::user()->id == $user->user_id ){
            return 
                view('notice.edit')
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
        
        $this->noticeModel->updateMsg($id,$request->title,$request->content,$request->getClientIp());
        return redirect(route('notice.index',['search'=>$request->search,'where'=>$request->where,'page'=>$request->page]));
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

        $user = $this->noticeModel->getMsg($id);
        
         if(Auth::user()->id == $user->user_id ){
            $this->noticeModel->deleteMsg('num',$id);
            return redirect(route('notice.index',['search'=>$request->search,'where'=>$request->where,'page'=>$request->page]));
        }else{
            return back()->with('message',$message);
        }      
    }

}
