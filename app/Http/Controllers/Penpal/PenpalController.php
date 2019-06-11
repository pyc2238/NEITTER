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
use App\Models\Users\Point;


class PenpalController extends Controller
{
 
    use StoreImage;

    private $senderModel    = null;
    private $transmitModel  = null;
    private $friendModel    = null;
    private $userModel      = null;
    private $pointModel     = null;

    public function __construct(){
        $this->senderModel      = new Sender();
        $this->transmitModel    = new Transmit();
        $this->friendModel      = new Friend();
        $this->userModel        = new User();
        $this->pointModel       = new Point();
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


        //이미 친구인지 검증
        $recipient = $this->userModel->where('name',$request->recipient_name)->first();

        if($recipient != null){
           
            $userFriend = $this->friendModel->where([
                ['user_id', Auth::id()],
                ['friend_id', $recipient->id],
                ])->first();

            //친구 추가 요청을 할 경우
            if($request->friendChk){
                $senderModelData["is_friend"] = $request->friendChk;
            
            
                    if(Auth::id() == $recipient->id){
                        if(session('locale') == 'ko'){
                            $message = '자신에게 친구요청을 할 수 없습니다.';
                
                        }else{
                            $message = '自分に友達を要請することはできません。';
                        }

                        return back()->with([
                            'message'   => $message, 
                        ]);
                    }

                    if($userFriend != null){

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

            //펜팔을 보내는 유저가 친구가아닐 경우
            if($userFriend == null){
                //일일 펜팔 횟수(10회제한)
                $user = $this->userModel->where('id',Auth::id())->first();
        
                    if($user->penpal_count === 10){
                        
                        $userPoint = $this->pointModel->where('user_id',Auth::id())->first();
                        
                         //당일 펜팔 10회시 최대 7포인트 지급
                         if($userPoint->letter_point != 7){ 
                            $userPoint->letter_point += 7;
                            $userPoint->save();
                            $user->point += $userPoint->letter_point;
                            $user->save();
                        }


                        if(session('locale') == 'ko'){
                            $message = '금일의 펜팔 횟수를 초과하였습니다.';
                
                        }else{
                            $message = '本日のメール友回数を超えています';
                        }
        
                        return back()->with([
                            'message'   => $message, 
                        ]);
        
                    }
                
                $user->increment('penpal_count');
                
                }
        }else{
            if(session('locale') == 'ko'){
                $message = '존재하지 않는 회원입니다.';
    
            }else{
                $message = '存在しない会員です。';
            }

            return back()->with([
                'message'   => $message, 
            ]);
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

