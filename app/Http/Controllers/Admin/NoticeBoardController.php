<?php

namespace App\Http\Controllers\Admin;
// namespace App\Traits;
// namespace App\Http\Traits;




use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SubController\TranslationController;

use Session; 
use Auth;
use App\User;
use App\Admin_Notice;
use App\Admin_Notice_hit;
use App\Admin_Notice_ip;



class NoticeBoardController extends Controller
{
    

    public function __construct(){
        $this->noticeModel = new Admin_Notice();
        $this->hitsModel = new Admin_Notice_hit();
        $this->ipsModel = new Admin_Notice_ip();
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

        $msgs =  $this->noticeModel->getMsgs();
        $count = count(Admin_Notice::all());

        if($search){
            switch($where){
                    
                case "title":
                    $msgs = $this->noticeModel->searchTitle($search);  
                    $count = $this->noticeModel->searchTitleCount($search);
                    break;
                case "writer":
                    $msgs = $this->noticeModel->searchWriter($search); 
                    $count = $this->noticeModel->searchWriterCount($search);
                    break;
                case "content":
                    $msgs = $this->noticeModel->searchContent($search); 
                    $count = $this->noticeModel->searchContentCount($search);
                    break;
                case "titleAndcotent":
                    $msgs = $this->noticeModel->searchTitleAndCotent($search); 
                    $count = $this->noticeModel->searchTitleAndCotentCount($search);
                    break;    
            }
        }

        return
            view('notice.index')
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
            view('notice.create')
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
        
        $this->noticeModel->insertMsg(Auth::user()->country,$request->title,$request->content,Auth::user()->id);
        
        
        if(Session::get('locale') == 'ja'){
            $message = 'お知らせ作成が完了しました。';
        }else{
            $message = '공지사항 작성이 완료되었습니다.';
        }

        return 
            redirect()
            ->route('notice.index')
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
         
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
       
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
        
        $translationTitle = $this->translation->translation($notice->title,$this->translation->langCode($notice->title));
        $translationContent = $this->translation->translation($notice->content,$this->translation->langCode($notice->title));
         
        
        return
            view('notice.show')
            ->with('notice',$notice)
            ->with('page',$page)
            ->with('search',$search)
            ->with('where',$where)
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
        $user = $this->noticeModel->getMsg($id);

        if(Session::get('locale') == 'ja'){
            $message = '修正権限がありません。';
        }else{
            $message = '수정권한이 없습니다.';
        }


        if(Auth::user()->id == $user->user_id ){
            return 
                view('notice.edit')
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
            $message = 'お知らせを修正されました。';
        }else{
            $message = '공지사항이 수정되었습니다.';
        }

        
        $this->noticeModel->updateMsg($id,$request->title,$request->content);
        return redirect(route('notice.index',['search'=>$search,'where'=>$where,'page'=>$page]))->with('message',$message);
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
        $user = $this->noticeModel->getMsg($id);

        if(Session::get('locale') == 'ja'){
            $message = '削除権限がありません。';
        }else{
            $message = '삭제권한이 없습니다.';
        }

        
         if(Auth::user()->id == $user->user_id ){
            $this->noticeModel->deleteMsg($id);
            return redirect(route('notice.index',['search'=>$search,'where'=>$where,'page'=>$page]));
        }else{
            return back()->with('message',$message);
        }      
    }

}
