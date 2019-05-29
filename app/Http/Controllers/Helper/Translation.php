<?php

namespace App\Http\Controllers\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

trait Translation 
{
     
     public static function langCode($papago){
   
        $client_id      =  config('papago.client_sening_id');
        $client_secret  =  config('papago.client_sening_secret');
        $encQuery = urlencode($papago);
        $postvars = "query=".$encQuery;
        $url = "https://openapi.naver.com/v1/papago/detectLangs";
        $is_post = true;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
        $headers = array();
        $headers[] = "X-Naver-Client-Id: ".$client_id;
        $headers[] = "X-Naver-Client-Secret: ".$client_secret;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //   echo "status_code:".$status_code."<br>";
        curl_close ($ch);
        if($status_code == 200) {
            // echo $response['langCode'];
            $json = json_decode($response, true);
            $langCode = $json['langCode']; 
        } else {
            echo "점검 중";
            // echo "Error 내용:".$response;
        }
        return $langCode;    
    }

    public static function translation($papago,$langCode) {

          $client_id      = config('papago.client_language_translation_id');
          $client_secret  = config('papago.client_language_translation_secret');
          $encText = urlencode($papago);
          

          if($langCode == "ko"){
            $postvars = "source=ko&target=ja&text=".$encText;
           
          }else if($langCode == "ja"){
            $postvars = "source=ja&target=ko&text=".$encText;
            
          }else{
            $postvars = "source=ko&target=ja&text=".$encText;
          }
          
          $url = "https://openapi.naver.com/v1/language/translate";
          $is_post = true;
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_POST, $is_post);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
          $headers = array();
          $headers[] = "X-Naver-Client-Id: ".$client_id;
          $headers[] = "X-Naver-Client-Secret: ".$client_secret;
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          $response = curl_exec ($ch);
          $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
          //   echo "status_code:".$status_code."<br>";
          curl_close ($ch);
          
          if($status_code == 200) {  
            $json = json_decode($response, true);   //json_decode는  디코딩 된 json문자열을 연관배열로 만든다.
            $translation = $json['message']['result']['translatedText']; 

        } else {
            $translation = '점검 중';
            //   echo "Error 내용:".$response;
          }
          return  $translation;
    }
}
