<?php

namespace App\Http\Controllers\Penpal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\ConstantEnum;
use App\Http\Controllers\Helper\StoreImage;
use Auth;

use App\Models\Penpal\Timeline;
class TimelineController extends Controller
{

    use StoreImage;

    private $timelineModel = null;


    public function __construct(){
        $this->timelineModel = new Timeline();
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
