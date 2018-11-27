<?php

if ($_FILES["upload"]["size"] > 0  ){


    //오리지널 파일 이름.확장자
    $ext = substr(strrchr($_FILES["upload"]["name"],"."),1);
    $ext = strtolower($ext);
    $savefilename = $_FILES["upload"]["name"];
    $url="/myPhoto";
    $uploadpath  = $_SERVER['DOCUMENT_ROOT']."$url";
    $uploadsrc = $_SERVER['HTTP_HOST']."/myPhoto";
    $http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ? 's' : '') . '://';

    //php 파일업로드하는 부분

        if(move_uploaded_file($_FILES['upload']['tmp_name'],$uploadpath."/".iconv("UTF-8","EUC-KR",$savefilename))){
            $uploadfile = $savefilename;
            echo '
            {
                "fileName": "'.$savefilename.'",
                "uploaded": 1,
                "url": "'.$url.'/'.$savefilename.'"
            }
            ';
        }


}else{
    exit;

}

?>