<?php

namespace App\Http\Controllers\Penpal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\ConstantEnum;
use App\Http\Controllers\Helper\StoreImage;
use Auth;

use App\Models\Penpal\Sender;
use App\Models\Penpal\Transmit;




class PenpalController extends Controller
{
 
    use StoreImage;

    private $senderModel = null;
    private $transmitModel = null;
    
    public function __construct(){
        $this->senderModel      = new Sender();
        $this->transmitModel    = new Transmit();
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

        $this->senderModel->create($senderModelData);
        $this->transmitModel->create($transmitModelData);

        if(session('locale') == 'ja'){
            $message = $request->recipient_name.'様にメールをお届けしました。';
        }else{
            $message = $request->recipient_name.'님께 쪽지를 전달하였습니다.';
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

