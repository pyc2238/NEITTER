<?php

namespace App\Http\Controllers\Penpal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\ConstantEnum;
use App\Http\Controllers\Helper\StoreImage;
use Auth;


use App\Models\Users\User;
use App\Models\Users\Point;
use App\Models\Penpal\Timeline;
class TimelineController extends Controller
{

    use StoreImage;

    private $timelineModel  = null;
    private $userModel      = null;
    private $pointModel     = null;


    public function __construct(){
        $this->timelineModel    = new Timeline();
        $this->userModel        = new User();
        $this->pointModel       = new Point();
    }


    public function create(Request $request){

        if($request->file){
            $file = $this->fileUpload($request,ConstantEnum::S3['penpal']);

            if($file == false){
                return response()->json(['message'=>'false'],400);
            }

            $timelineData = array(
                'content'   => $request->content,
                'image'     => $file,
                'user_id'   => Auth::id(), 
            );

        }else{
            $timelineData = array(
                'content'   => $request->content,
                'user_id'   => Auth::id(), 
            );
        }

    

        $this->timelineModel->create($timelineData);

        $userPoint = $this->pointModel->where('user_id',Auth::id())->first();
        $user = $this->userModel->where('id',Auth::id())->first();

         //당일 타임라인 글등록 최대 3포인트 지급
         if($userPoint->timeline_point != 3){
            $userPoint->timeline_point += 1;
            $userPoint->save();
            $user->point += $userPoint->timeline_point;
            $user->save();
        }


        return redirect(route('penpal.timeline'));
    }


    public function update(Request $request){
        
        $this->timelineModel->where('id',$request->id)
            ->update(['content' => $request->comment]);

        return redirect(route('penpal.timeline'));
    }

    
    public function delete(Request $request){

        $this->timelineModel->where('id',$request->id)->delete();

        return redirect(route('penpal.timeline'));
    }
}
