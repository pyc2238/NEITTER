<?php

namespace App\Http\Controllers\Penpal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\ConstantEnum;
use App\Http\Controllers\Helper\StoreImage;
use Auth;

use App\Models\Penpal\Sender;
use App\Models\Penpal\Transmit;
use App\Models\Users\Friend;
use App\Models\Users\User;



class PenpalController extends Controller
{
 
    use StoreImage;

    private $senderModel    = null;
    private $transmitModel  = null;
    private $friendModel    = null;
    private $userModel      = null;

    public function __construct(){
        $this->senderModel      = new Sender();
        $this->transmitModel    = new Transmit();
        $this->friendModel      = new Friend();
        $this->userModel        = new User();
    }


    public function penpal(Request $request){
       

        if($request->file){
            $file = $this->fileUpload($request,ConstantEnum::S3['penpal_user']);

            if($file == false){
                return response()->json(['message'=>'false'],400);
            }

            $senderModelData = array(
                'recipient_name'    => $request->recipient_name,
                'content'           => $request->content,
                'image'             => $file,
                'country'           => Auth::user()->country,
                'user_id'           => Auth::id(),
            );


            $transmitModelData = array(
                'recipient_name'    => $request->recipient_name,
                'content'           => $request->content,
                'image'             => $file,
                'user_id'           => Auth::id(),
            );
           
        }else{
            $senderModelData = array(
                'recipient_name'    => $request->recipient_name,
                'content'           => $request->content,
                'country'           => Auth::user()->country,
                'user_id'           => Auth::id(),
            );

            $transmitModelData = array(
                'recipient_name'    => $request->recipient_name,
                'content'           => $request->content,
                'user_id'           => Auth::id(),
            );
        }

        //친구 추가 요청을 할 경우
        if($request->friendChk){
            $senderModelData["is_friend"] = $request->friendChk;
            
            //이미 친구인지 검증
            $user_id = $this->userModel->where('name',$request->recipient_name)->value('id');

            $userFriend = $this->friendModel->where([
                ['user_id', Auth::id()],
                ['friend_id', $user_id],
                ])->first();

                if($userFriend->count() > 0){

                    if(session('locale') == 'ko'){
                        $message = $request->recipient_name.'님은 이미 회원님의 친구입니다.';
            
                    }else{
                        $message = $request->recipient_name.'様はもう会員様の友達です。';
                    }

                    return back()->with([
                        'message'   => $message, 
                    ]);
                }
        }


        $this->senderModel->create($senderModelData);
        $this->transmitModel->create($transmitModelData);

        if(session('locale') == 'ko'){
            $message = $request->recipient_name.'님께 쪽지를 전달하였습니다.';

        }else{
            $message = $request->recipient_name.'様にメールをお届けしました。';
        }

        return redirect(route('mail.inbox'))->with([
            'message'   => $message,
        ]);

    }

    public function deleteMail(Request $request){
      
            if($request->deleteAll){
               
                $mails = collect();
                $mails = $request->deleteAll;
                $this->senderModel->destroy($mails);
                return $this->senderModel->where('recipient_name',Auth::user()->name)->get()->count();  
    
            }


            $this->senderModel->where('id',$request->id)->delete();
            
        return back();
        

    }

    public function transmitDeleteMail(Request $request){
        
        
        if($request->deleteAll){
               
            $mails = collect();
            $mails = $request->deleteAll;
            $this->transmitModel->destroy($mails);
            return $this->transmitModel->where('user_id',Auth::id())->get()->count();  

        }


        $this->transmitModel->where('id',$request->id)->delete();
        
    return back();

}


    public function mailCount(){
        
       if(Auth::check()){
        $mailCount =  $this->senderModel->where([
            ['recipient_name',Auth::user()->name],
            ['is_read',0], 
            ])->get()->count();
       } 
      
      return $mailCount;   
    }





}

