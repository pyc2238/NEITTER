<?php

namespace App\Http\Controllers\Penpal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\ConstantEnum;
use App\Http\Controllers\Helper\StoreImage;
use Auth;

use App\Models\Penpal\Penpal;
use App\Models\Penpal\Timeline;
use App\Models\Penpal\PenpalUser;

class RegisterController extends Controller
{

    use StoreImage;

    private $penpalModel        = null;
    private $timelineModel      = null;
    private $penpalUserModel    = null;

    public function __construct(){

        $this->penpalModel          = new Penpal();
        $this->timelineModel        = new Timeline();
        $this->penpalUserModel      = new PenpalUser();
      
    }

    //펜팔 등록
    public function registration(Request $request){

        if($request->file){
            $file = $this->fileUpload($request,ConstantEnum::S3['penpal']);

            if($file == false){
                return response()->json(['message'=>'false'],400);
            }

        }


        //checkbox에 아무런 체크를 하지 않았을 경우
        if(!$request->language){
            $language = ["1"];
        }else{
            $language = $request->language;
        }

        $penpalData = array(
            'self_context'  => $request->selfContext,
            'language'      => $language,
            'user_id'       => Auth::id(),
            'image'         => $file,
            'goal_id'       => $request->goal,
        );

       
        $penpal = $this->penpalModel->create($penpalData);
            

        $penpalData = array(
            'user_id'       => Auth::id(),
            'penpal_id'     => $penpal->id, 
        );

        $this->penpalUserModel->create($penpalData);


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
