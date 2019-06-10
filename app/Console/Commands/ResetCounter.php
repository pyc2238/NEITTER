<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Users\User;

class ResetCounter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:counter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scheduling the users penpal counter to zero at midnight';

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
        $users = User::all();
        foreach($users as $user)
        {
            $data['penpal_count'] = 0;
            $user->update($data);      
        }
    }
}
