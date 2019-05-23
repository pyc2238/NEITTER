<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name',50)->unique();
            $table->string('email',255)->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('gender')->nullable();
            $table->integer('age')->unsigned()->nullable();
            $table->string('address',255)->nullable();
            $table->string('country',20)->nullable();
            $table->string('selfContext',255)->nullable();
            $table->text('selfPhoto')->nullable();
            $table->integer('socialite')->default(0)->unsigned();
            $table->boolean('admin')->default(false);
            $table->timestamps();
            // $table->softDeletes();
            $table->rememberToken();       
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
