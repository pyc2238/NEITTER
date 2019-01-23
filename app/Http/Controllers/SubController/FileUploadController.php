<?php

namespace App\Http\Controllers\SubController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileUploadController extends Controller
{
    public function fileUpload(Request $request){
        $buckets = $request->buckets;
        if($request->file('upload')){
            $file_name = $request->file('upload')->getClientOriginalName();
            $path = $request->upload->storeAs(
                $buckets
                ,$file_name,
                's3'
        );
            $url = 'https://s3.ap-northeast-2.amazonaws.com/neitter/'.$buckets.'/'.$file_name;
            echo '{"filename" : "'.$file_name.'", "uploaded" : 1, "url":"'.$url.'"}';
          }else{
            return back()->with('error',true);
          }
    }
}
