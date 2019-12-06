<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInquiryBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiry_boards', function (Blueprint $table) {
            $table->increments('num');
            $table->string('country',255);
            $table->string('title',255);
            $table->text('content');
            $table->integer('hits')->default(0);
            $table->integer('commend')->default(0);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('comment_count')->default(0);
            $table->string('ip',50);
            $table->softDeletes();
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
        Schema::dropIfExists('inquiry_boards');
    }
}
