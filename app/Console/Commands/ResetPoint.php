<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Users\Point;
class ResetPoint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:point';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule to initialize daily point acquisition limits at 0:00 a.m. of the day.';

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
        $points = Point::all();
        foreach($points as $point)
        {
            $data = array(
                'penpal_point'      => 0,
                'community_point'   => 0,
                'timeline_point'    => 0,
                'letter_point'      => 0,
                'login_point'       => 0,
            ); 
            $point->update($data);      
        }
    }
}
