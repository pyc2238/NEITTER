<?php

use Illuminate\Database\Seeder;

class CommunityCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Communities_Comment::class,40)->create();
    }
}
