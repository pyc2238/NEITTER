<?php

namespace App\Http\Controllers\Penpal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\ConstantEnum;
use App\Http\Controllers\Helper\StoreImage;
use Auth;

use App\Models\Penpal\Penpal;
use App\Models\Penpal\Timeline;
use App\Models\Penpal\GoalPenpal;

class RegisterController extends Controller
{

    use StoreImage;

    private $penpalModel        = null;
    private $timelineModel      = null;
    private $goalPenpalModel    = null;

    public function __construct(){

        $this->penpalModel          = new Penpal();
        $this->timelineModel        = new Timeline();
        $this->goalPenpalModel      = new GoalPenpal();
      
    }


    //펜팔 등록
    public function registration(Request $request){
     

        if($request->file){
            $file = $this->fileUpload($request,ConstantEnum::S3['penpal']);

            if($file == false){
                return response()->json(['message'=>'false'],400);
            }

        }

        $penpalData = array(
            'self_context'  => $request->selfContext,
            'language'      => $request->language,
            'user_id'       => Auth::id(),
            'image'         => $file,
        );

       
        $penpal = $this->penpalModel->create($penpalData);
     
        $goalPenpalData = array(
            'penpal_id'     => $penpal->id,
            'goal_id'       => $request->goal,
        );


        $this->goalPenpalModel->create($goalPenpalData);
       
        
        if(session('locale') == 'ja'){
            $message = 'ペンパル登録が完了しました。';
        }else{
            $message = '펜팔 등록이 완료되었습니다.';
        }

        return redirect(route('penpal.index'))->with('message',$message);
    
    }

    public function test(){
      
      $rs = $this->penpalModel->find(1)->first();
      return $rs->language;
    }
}
