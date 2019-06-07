<?php

namespace App\Http\Controllers\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\Translation;
use Auth;

use App\Models\Penpal\Sender;

class ViewController extends Controller
{

    use Translation;

    private $penpalUserModel = null;

    public function __construct(){
        $this->senderModel  = new Sender();
    }


    public function inbox(Request $request){
       
        $senders = $this->senderModel->where('recipient_name',Auth::user()->name)
            ->with(['user'])->latest()
            ->paginate(8);

        
    //    return json_encode($senders,JSON_UNESCAPED_UNICODE);
       
        return view('home.component.mail.component.receiveTable')->with([
            'name'      => null,
            'senders'   => $senders,
            'page'      => $request->page,   
        ]);;
    }

    public function sendMail(Request $request){
        
        $senders = $this->senderModel->where('recipient_name',Auth::user()->name)->get();

        return view('home.component.mail.component.sendMail')->with([
            'name'          => $request->name,
            'senders'       => $senders,
        ]);
    }

    public function show(Request $request){
       
        $sender = $this->senderModel->where('id',$request->id)
            ->with(['user'])
            ->first();

            //메일 열람
            $sender->is_read = 1;
            $sender->save();

             //메일 내용 번역
            $translationMail = $this->translation(
                $sender->content,
                $this->langCode($sender->content)
            );
            $sender->translation = $translationMail;
            
        return view('home.component.mail.component.receiveShow')->with([
            'sender'       => $sender,
            'page'         => $request->page,   
        ]);
    }
}
