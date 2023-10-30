<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user');
            $table->unsignedBigInteger('to_user');
            $table->text('message');
            $table->timestamp('sent_at');

            // Define foreign key constraints if needed
            $table->foreign('from_user')->references('id')->on('users');
            $table->foreign('to_user')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat');
    }
};
