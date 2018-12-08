<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $autoSearch = $this->communityModel->select('title')->get(); //테이블 자동 검색창
      
        return 
            view('community.index')
            ->with('page',$page)
            ->with('search',$search)
            ->with('where',$where)
            ->with('msgs',$msgs)
            ->with('count',$count)
            ->with('autoSearch',$autoSearch);
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
       
        $this->communityModel->insertMsg(Auth::user()->country,$request->title,$request->content,Auth::user()->id);
        
        return 
            redirect()
            ->route('community.index')
            ->with('message','글 작성이 완료되었습니다.')
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
        
        $translationTitle = $this->translation($community->title,$this->langCode($community->title));
        $translationContent = $this->translation($community->content,$this->langCode($community->title));
         
        
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
            return back()->with('message','수정권한이 없습니다.');
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
        
        $this->communityModel->updateMsg($id,$request->title,$request->content);
        return redirect(route('community.index',['search'=>$search,'where'=>$where,'page'=>$page]))->with('message','게시물이 수정되었습니다.');
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
        
         if(Auth::user()->id == $user->user_id ){
            $this->communityModel->deleteMsg($id);
            return redirect(route('community.index',['search'=>$search,'where'=>$where,'page'=>$page]));
        }else{
            return back()->with('message','삭제권한이 없습니다.');
        }      
    }


    public function putIncreaseCommend(Request $request,$id){
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
       
        $userNum = Auth::user()->id;  
        $result = $this->commendsModel->getCommendId($userNum,$id);
        
        if($result){
            return back()->with('message','이미 추천을 누른 게시물입니다.');
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

        
        $this->commentModel->insertComment($request->comment,Auth::user()->country,$id,Auth::user()->id);
    
      
        // return response()->json($comments, 200, [], JSON_PRETTY_PRINT);
        
        return redirect(route('community.show',['id'=>$id,'search'=>$search,'where'=>$where,'page'=>$page]));
    }


    public function putUpdateComment(Request $request,$id){
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
        
        $this->commentModel->updateComments($request->commentId,$request->comment);
        
        return redirect(route('community.show',['id'=>$id,'search'=>$search,'where'=>$where,'page'=>$page]));
    }

    public function getDeleteComment(Request $request,$id){
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
        $this->commentModel->deleteComments($request->commentId);
        return redirect(route('community.show',['id'=>$id,'search'=>$search,'where'=>$where,'page'=>$page]));
    }


    public function fetch_data(Request $request){
        if($request->ajax()){
            $msgs = Coumminty::orderBy('num','desc')->paginate(2);
            return view('community.component.indexTable',compact('msgs'))->render();
        }
    }


    //언어 감지 Papago
    public static function langCode($papago){
   
        $client_id = "GsqdMHiH8jYipihfkH23";
        $client_secret = "49rHFbtM4x";
        $encQuery = urlencode($papago);
        $postvars = "query=".$encQuery;
        $url = "https://openapi.naver.com/v1/papago/detectLangs";
        $is_post = true;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
        $headers = array();
        $headers[] = "X-Naver-Client-Id: ".$client_id;
        $headers[] = "X-Naver-Client-Secret: ".$client_secret;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //   echo "status_code:".$status_code."<br>";
        curl_close ($ch);
        if($status_code == 200) {
            // echo $response['langCode'];
            $json = json_decode($response, true);
            $langCode = $json['langCode']; 
        } else {
            echo "점검 중";
            // echo "Error 내용:".$response;
        }
        return $langCode;    
    }

    //언어 변환 Papago SMT 
    public static function translation($papago,$langCode) {

          $client_id = "XhF4hpyBJquD0uxxiIT9";
          $client_secret = "v15ft5DNeN";
          $encText = urlencode($papago);
          

          if($langCode == "ko"){
            $postvars = "source=ko&target=ja&text=".$encText;
           
          }else if($langCode == "ja"){
            $postvars = "source=ja&target=ko&text=".$encText;
            
          }else{
            $postvars = "source=ko&target=ja&text=".$encText;
          }
          
          $url = "https://openapi.naver.com/v1/language/translate";
          $is_post = true;
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_POST, $is_post);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
          $headers = array();
          $headers[] = "X-Naver-Client-Id: ".$client_id;
          $headers[] = "X-Naver-Client-Secret: ".$client_secret;
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          $response = curl_exec ($ch);
          $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
          //   echo "status_code:".$status_code."<br>";
          curl_close ($ch);
          
          if($status_code == 200) {  
            $json = json_decode($response, true);   //json_decode는  디코딩 된 json문자열을 연관배열로 만든다.
            $translation = $json['message']['result']['translatedText']; 

        } else {
            $translation = '점검 중';
            //   echo "Error 내용:".$response;
          }
          return  $translation;
    }

}
