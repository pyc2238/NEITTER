<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInquiryCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiry_board__comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->string('country',255);
            $table->integer('board_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('board_id')->references('num')->on('inquiry_boards')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('inquiry_boards__comments');
    }
}
