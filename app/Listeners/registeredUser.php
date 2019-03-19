<?php

namespace App\Listeners;

use App\Events\registeredUserMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class registeredUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  registeredUserMail  $event
     * @return void
     */
    public function handle(registeredUserMail $event)
    {
        
        $count = $event->userCount;
        session(['userCount' => $count]);

        Mail::send(['html'=>'component.registeredUserMail'],['name','Sathak'],function($message){
            $message->to('pyc2238@naver.com','보근님')->subject('안녕하세요 NEITTER입니다.');
            $message->from('pyc2238@gmail.com','보근');
        });
    }
}
