<?php

namespace App\Http\Controllers\Penpal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\ConstantEnum;
use App\Http\Controllers\Helper\StoreImage;
use Auth;


use App\Models\Users\User;
use App\Models\Users\Point;
use App\Models\Penpal\Penpal;
use App\Models\Penpal\Timeline;

class RegisterController extends Controller
{

    use StoreImage;

    private $userModel          = null;
    private $pointModel         = null;
    private $penpalModel        = null;
    private $timelineModel      = null;

    public function __construct(){

        $this->userModel            = new User();
        $this->pointModel           = new Point();
        $this->penpalModel          = new Penpal();
        $this->timelineModel        = new Timeline();

    }

    //펜팔 등록
    public function registration(Request $request){


         //checkbox에 아무런 체크를 하지 않았을 경우
         if(!$request->language){
            $language = ["1"];
        }else{
            $language = $request->language;
        }


        if($request->file){
            $file = $this->fileUpload($request,ConstantEnum::S3['penpal']);

            if($file == false){
                return response()->json(['message'=>'false'],400);
            }

            $penpalData = array(
                'self_context'  => $request->selfContext,
                'language'      => $language,
                'user_id'       => Auth::id(),
                'image'         => $file,
                'goal_id'       => $request->goal,
            );

        }else{
            $penpalData = array(
                'self_context'  => $request->selfContext,
                'language'      => $language,
                'user_id'       => Auth::id(),
                'goal_id'       => $request->goal,
            );
        }


        $penpal = $this->penpalModel->create($penpalData);
            
        $userPoint = $this->pointModel->where('user_id',Auth::id())->first();
        $user = $this->userModel->where('id',Auth::id())->first();

         //당일 펜팔 등록 최대 5포인트 지급
         if($userPoint->penpal_point != 5){
            $userPoint->penpal_point += 1;
            $userPoint->save();
            $user->point += $userPoint->penpal_point;
            $user->save();
        }
        


        $timelineData = array(
            'user_id'       => Auth::id(),
            'is_system'     => 1, 
        );

    
        $this->timelineModel->create($timelineData);
    
        
        if(session('locale') == 'ja'){
            $message = 'ペンパル登録が完了しました。';
        }else{
            $message = '펜팔 등록이 완료되었습니다.';
        }

        return redirect(route('penpal.index'))->with('message',$message);
    
    }

  
}
