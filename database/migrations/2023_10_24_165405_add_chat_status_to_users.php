<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up():void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('chat_status', ['Online', 'Away', 'Busy', 'Offline'])->default('Offline');
        });
    }

    public function down():void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('chat_status');
        });
    }
};
