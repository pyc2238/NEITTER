<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session; 
use Auth;
use App\User;
use App\Community;

class CommunityContoller extends Controller
{
    public function __construct(){
        $this->communityModel = new Community();
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
      
        return 
            view('community.index')
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
       
        $community = $this->communityModel->getMsg($id);
        $translationTitle = $this->translation($community->title,0);
        $translationContent = $this->translation($community->content,0);
        
        return
            view('community.show')
            ->with('community',$community)
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
    //해당 아이디의 수정 폼
    public function edit(Request $request,$id)
    {   
        $page = $request->page;
        $search = $request->search;
        $where = $request->where;
        $user = $this->communityModel->getMsg($id);
         
        if(!Auth::check()){
            return back()->with('message','로그인 후 사용가능합니다.');
        }else if(Auth::user()->id == $user->user_id ){
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
        return redirect(route('community.index',['search'=>$search,'where'=>$where,'page'=>$page]));
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
        
        if(!Auth::check()){
            return back()->with('message','로그인 후 사용가능합니다.');
        }else if(Auth::user()->id == $user->user_id ){
            $this->communityModel->deleteMsg($id);
            return redirect(route('community.index',['search'=>$search,'where'=>$where,'page'=>$page]));
        }else{
            return back()->with('message','삭제권한이 없습니다.');
        }      
    }



    //언어 감지
    public function langCode($papago){
   
        //네이버 Papago 언어감지 API 예제 
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

    //언어 변환
    public  function translation($papago,$langCode) {
          // 네이버 Papago SMT 기계번역 Open API 
          $client_id = "XhF4hpyBJquD0uxxiIT9"; // 네이버 개발자센터에서 발급받은 CLIENT ID
          $client_secret = "v15ft5DNeN";// 네이버 개발자센터에서 발급받은 CLIENT SECRET
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
