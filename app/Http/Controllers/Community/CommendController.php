<?php

namespace App\Http\Controllers\Community;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Models\Communities\Community;
use App\Models\Communities\Communities_commends;

class CommendController extends Controller
{
    private $commendModel       = null;
    private $communityModel     = null;

    public function __construct(){

        $this->communityModel   = new Community();
        $this->commendModel     = new Communities_commends();
        
    }

    
    public function putIncreaseCommend(Request $request,$id){

       
        if(session('locale') == 'ja'){
            $message = 'すでに推薦したスレッドです';
        }else{
            $message = '이미 추천을 누른 게시물입니다.';
        }

          
        $result = $this->commendModel->getCommendId(Auth::user()->id,$id);
        
        if($this->commendModel->getCommendId(Auth::user()->id,$id)){
            return back()->with('message',$message);
        }else{
                $this->commendModel->insertCommendId(Auth::user()->id,$id);
                $this->communityModel->updateCommend($id);
          
            return redirect(route('community.show',[
                'id'       =>$id,
                'search'   =>$request->search,
                'where'    =>$request->where,
                'page'     =>$request->page
                ])
            );
        }
    }

}
