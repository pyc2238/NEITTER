<?php

namespace App\Http\Controllers\InquiryBoard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Models\Inquiries\inquiryBoard_Comment;
use App\Models\Inquiries\inquiryBoard;

class CommentController extends Controller
{
    private $commentModel   = null;
    private $inquiryModel   = null;

    public function __construct(){

        $this->commentModel     = new inquiryBoard_Comment();
        $this->inquiryModel     = new inquiryBoard();
    }

    public function postInsertComment(Request $request,$id){
       
        $this->commentModel->insertComment(
            $request->comment,
            Auth::user()->country,
            $id,Auth::user()->id,
            $request->getClientIp()
        );

        $this->inquiryModel->where('num', $id)->increment('comment_count');  
    
    return redirect(route('inquiry.show',[
        'id'        =>$id,
        'search'    =>$request->search,
        'where'     =>$request->where,
        'page'      =>$request->page
        ])
    );
}


    public function putUpdateComment(Request $request,$id){
        
            $this->commentModel->updateComments(
                $request->commentId,
                $request->comment,
                $request->getClientIp()
            );
        
        return redirect(route('inquiry.show',[
            'id'        =>$id,
            'search'    =>$request->search,
            'where'     =>$request->where,
            'page'      =>$request->page
            ])
        );
    }

    public function getDeleteComment(Request $request,$id){
            
            $this->commentModel->deleteMsg('id',$request->commentId);
            $this->inquiryModel->where('num', $id)->decrement('comment_count');
        return redirect(route('inquiry.show',[
            'id'        =>$id,
            'search'    =>$request->search,
            'where'     =>$request->where,
            'page'      =>$request->page
            ])
        );
    }
    
}
