<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\Translation;
use Auth;

use App\Models\Users\TranslationRecord;

class TranslationController extends Controller
{

    use Translation;

    private $translationRecordModel = null;

    public function __construct(){

        $this->translationRecordModel = new TranslationRecord();
    
    }


    public function languageTranslation(Request $request){
    
        if(Auth::check() && $request->material){

            $lang = $this->langCode($request->material);
           
            $translationRes =  $this->translation($request->material,$lang);
    
            if($lang == "ko"){
                $translationData = array(
                    'korean'        => $request->material,
                    'japanese'      => $translationRes,
                    'user_id'       => Auth::id(),
                );

            }else{
                $translationData = array(
                    'korean'        => $translationRes,
                    'japanese'      => $request->material,
                    'user_id'       => Auth::id(),
                );
            }

            $this->translationRecordModel->create($translationData);

            return $translationRes;
        }else{
            return;
        }
        
    }


    public function getRecodes(Request $request){
     
        if(Auth::check()){
            $translationRecords = $this->translationRecordModel->
                where('user_id',Auth::id())
                ->latest('id')
                ->take(12)
                ->get();
        
            return $translationRecords;
        }

    }

    public function recodeDelete(Request $request){
        return 'asd';
        $this->translationRecordModel->where('id',$request->id)->delete();
        
        return response()->json('ok');
    }
}
