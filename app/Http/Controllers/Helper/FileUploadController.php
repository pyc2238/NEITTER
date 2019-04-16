<?php
namespace App\Http\Controllers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Webpatser\Uuid\Uuid;

class FileUploadController extends Controller
{
    public function fileUpload(Request $request){
      
        $buckets = $request->buckets;
        if($request->file('upload')){
            $file = $request->file('upload')->getClientOriginalName();
            $uuid = (String)Uuid::generate(4);               
            $file = $uuid.$file;
            $path = $request->upload->storeAs(
                $buckets,
                $file,
                's3'
        );
            $url = config('filesystems.disks.s3.url').'/'.$buckets.'/'.$file;
            echo '{"filename" : "'.$file.'", "uploaded" : 1, "url":"'.$url.'"}';
          }else{
            return back()->with('error',true);
          }
    }
}