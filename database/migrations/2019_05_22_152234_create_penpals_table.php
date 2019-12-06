<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenpalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penpals', function (Blueprint $table) {
            $table->increments('id');
            $table->text('self_context')->nullable();
            $table->text('image')->nullable();
            $table->json('language');
            $table->integer('visitors_count')->default(0);
            $table->integer('winks_count')->default(0);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('goal_id')->unsigned();
            $table->foreign('goal_id')->references('id')->on('goals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penpals');
    }
}
