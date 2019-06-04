<?php

namespace App\Http\Controllers\Penpal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\ConstantEnum;
use App\Http\Controllers\Helper\StoreImage;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Users\User;
use App\Models\Penpal\Timeline;
use App\Models\Penpal\Penpal;
use App\Models\Penpal\Wink;

class ShowPenpalController extends Controller
{

    use StoreImage;
    
    private $timelineModel      = null;
    private $penpalModel        = null;
    private $userModel          = null;
    private $winkModel          = null;
  

    public function __construct(){
        
        $this->timelineModel    = new Timeline();
        $this->penpalModel      = new Penpal();
        $this->userModel        = new User();
        $this->winkModel        = new Wink();
   
    }


    public function penpalUpdate(Request $request){
       
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
                'language'      => json_encode($language,JSON_UNESCAPED_UNICODE),
                'user_id'       => Auth::id(),
                'image'         => $file,
                'goal_id'       => $request->goal,
            );

        }else{
            $penpalData = array(
                'self_context'  => $request->selfContext,
                'language'      => json_encode($language,JSON_UNESCAPED_UNICODE),
                'user_id'       => Auth::id(),
                'goal_id'       => $request->goal,
            );
        }


        $this->penpalModel->where('id',$request->penpal_id)->update($penpalData);
        
        return redirect(route('penpal.index'));
    }

    public function penpalDelete(Request $request){
        
        $this->penpalModel->where('id',$request->id)->delete();

        return redirect(route('penpal.index'));
    }

    public function showTimelineUpdate(Request $request){
        $this->timelineModel->where('id',$request->id)
        ->update(['content' => $request->comment]);

        return back();
    }

    public function showTimelineDelete(Request $request){
        
        $this->timelineModel->where('id',$request->id)->delete();

        return back();
    }


    public function wink(Request $request){
       
      $penpalUser = $this->penpalModel->getUser()->where('id',$request->penpal_id)->first();

      if($penpalUser->user->id != Auth::id()){
        
        $winkUser = $this->winkModel->where([
            ['user_id',$request->user_id],
            ['penpal_id',$request->penpal_id],
            ])->first();
                        
            if(!$winkUser){
                $penpalUser->increment('winks_count');
                $this->winkModel->create([
                'user_id'   => $request->user_id,
                'penpal_id' => $request->penpal_id,
                ]);
            }else{
                if(session('locale') == 'ja'){
                    $message = 'すでにウィンクをした会員です。';
                }else{
                    $message = '이미 윙크를 한 회원입니다.';
                }

                return $message;
            }
        }
        
    }
}
