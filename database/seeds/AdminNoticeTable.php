<?php

use Illuminate\Database\Seeder;

class AdminNoticeTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Admin_Notice::class,5)->create();
    }
}
