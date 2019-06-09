<?php

namespace App\Http\Controllers\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\Translation;
use Auth;

use App\Models\Users\User;
use App\Models\Users\Friend;
use App\Models\Penpal\Sender;
use App\Models\Penpal\Transmit;

class ViewController extends Controller
{

    use Translation;

    private $senderModel        = null;
    private $transmitModel      = null;
    private $userModel          = null;
    private $friendModel        = null;

    public function __construct(){
        $this->senderModel      = new Sender();
        $this->transmitModel    = new Transmit();
        $this->userModel        = new User();
        $this->friendModel      = new Friend();
    }


    public function inbox(Request $request){
       
        $senders = $this->senderModel->where('recipient_name',Auth::user()->name)
            ->with(['user'])->latest()
            ->paginate(8);

            //친구여부
            $friends = $this->friendModel->where('user_id',Auth::id())->get();

            foreach($senders as $sender){
                    foreach($friends as $friend){
                        if($sender->user_id === $friend->friend_id && $friend->is_friend === 1){
                            $sender->friend = $friend->friend_id;
                            $sender->friend_status = $friend->is_friend;
                        }   
                    }
            }


            // return json_encode($senders,JSON_UNESCAPED_UNICODE);
         
        return view('home.component.mail.component.receiveTable')->with([
            'name'          => null,
            'senders'       => $senders,
            'sendersCount'  => $this->senderModel->where('recipient_name',Auth::user()->name)->get()->count(),
            'page'          => $request->page,   
        ]);;
    }



//보낸 메일함
    public function transmit(Request $request){
            
        $transmits = $this->transmitModel->where('user_id',Auth::id())
                ->with(['user'])->latest()
                ->paginate(8);


                //받은 사용자의 국적을 찾는다.
                foreach($transmits as $transmit){
                    $country = $this->userModel->where('name',$transmit->recipient_name)->value('country');
                    $transmit->country = $country;
                }
            
                
            return view('home.component.mail.component.transmitTable')->with([
                'name'              => null,
                'transmits'         => $transmits,
                'transmitsCount'    => $this->transmitModel->where('user_id',Auth::id())->get()->count(),
                'page'              => $request->page,   
            ]);;
    }





    //받은 메일함
    public function sendMail(Request $request){
        
        $is_friend = null;

        if($request->is_friend){
            $is_friend = $request->is_friend;
         }

        $senders = $this->senderModel->where('recipient_name',Auth::user()->name)->get();

        return view('home.component.mail.component.sendMail')->with([
            'name'          => $request->name,
            'senders'       => $senders,
            'is_friend'     => $is_friend,
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

            //친구 여부 
            $friends = $this->friendModel->where('user_id',Auth::id())->get();
            foreach($friends as $friend){
                $sender->friend = $friend->friend_id;
                $sender->friend_status = $friend->is_friend;
            }

            // return $sender;
        return view('home.component.mail.component.receiveShow')->with([
            'sender'       => $sender,
            'page'         => $request->page,   
        ]);
    }

    public function transmitShow(Request $request){
        $transmit = $this->transmitModel->where('user_id',Auth::id())
        ->with(['user'])
        ->first();


        //국적 추가
        $country = $this->userModel->where('name',$transmit->recipient_name)->value('country');
        $transmit->country = $country;


         //메일 내용 번역
        $translationMail = $this->translation(
            $transmit->content,
            $this->langCode($transmit->content)
        );
        $transmit->translation = $translationMail;
        
    return view('home.component.mail.component.transmitShow')->with([
        'transmit'     => $transmit,
        'page'         => $request->page,   
    ]);
    }




}
