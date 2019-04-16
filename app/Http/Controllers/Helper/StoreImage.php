<?php

namespace App\Http\Controllers\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Webpatser\Uuid\Uuid;
trait StoreImage
{
    public function fileUpload($request,$storage){
        
        //파일 데이터 검증
        if($request->hasFile('file')) {
            $file = $request->file('file')->getClientOriginalName();                    //파일 원본 이름 출력
            $uuid = (String)Uuid::generate(4);                                          //uuid 생성
            $file = $uuid.$file;
            $fileUrl = config('filesystems.disks.s3.url').'/'.$storage.'/'.$file;       //저장소 url 생성
        }else {
            return false;
        } 

        //S3저장소 저장
        $request->file('file')->storeAs(
            $storage,
            $file,
            's3'
        );

        return $fileUrl;
    }
}
