<?php

namespace App\Console\Commands;
use App\User;
use Mail;
use Event;
use App\Events\registeredUserMail;
use Illuminate\Console\Command;

class RunRegisteredUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature =  'registered:users';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email of registered users';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $totalUsers = User::whereRaw('Date(created_at) = CURDATE()')->count();   
        Event::fire(new registeredUserMail($totalUsers));             
        
    }
}
