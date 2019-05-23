<?php

namespace App\Http\Controllers\InquiryBoard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Models\Inquiries\inquiryBoard_Comment;

class CommentController extends Controller
{
    private $commentModel   = null;

    public function __construct(){

        $this->commentModel     = new inquiryBoard_Comment();
    
    }

    public function postInsertComment(Request $request,$id){
       
        $this->commentModel->insertComment(
            $request->comment,
            Auth::user()->country,
            $id,Auth::user()->id,
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

        return redirect(route('inquiry.show',[
            'id'        =>$id,
            'search'    =>$request->search,
            'where'     =>$request->where,
            'page'      =>$request->page
            ])
        );
    }
    
}
