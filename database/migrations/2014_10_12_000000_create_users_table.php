<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
           $table->id('userID');
        //    $table->string('uuid')->unique()->nullable(); //stands for unique user id
            $table->string('accountType'); //user,responder,admin
            $table->string('email')->unique();
            $table->string('password');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('gender');
            $table->date('birthdate');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contactNumber', 13)->nullable();
            $table->string('avatar')->nullable(); //if user did not upload an image, set image to deafult img
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
