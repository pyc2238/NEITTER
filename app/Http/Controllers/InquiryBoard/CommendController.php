<?php

namespace App\Http\Controllers\InquiryBoard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Models\Inquiries\inquiryBoard;
use App\Models\Inquiries\inquiryBoard_commends;

class CommendController extends Controller
{
    private $inquiryModel   = null;
    private $commendsModel  = null;

    public function __construct(){

        $this->inquiryModel     = new inquiryBoard();
        $this->commendsModel    = new inquiryBoard_commends();

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
          
            return redirect(route('inquiry.show',[
                'id'        =>$id,
                'search'    =>$request->search,
                'where'     =>$request->where,
                'page'      =>$request->page
                ])
            );
        }
    }


}
