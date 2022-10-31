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
        Schema::create('history_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requestID')->references('id')->on('requests');
            $table->foreignId('userID')->references('id')->on('users');
            $table->foreignId('responderID')->nullable()->references('id')->on('responders');
            $table->string('requestType');
            $table->string('lat');
            $table->string('lng');
            $table->string('status');
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
        Schema::dropIfExists('history_requests');
    }
};
