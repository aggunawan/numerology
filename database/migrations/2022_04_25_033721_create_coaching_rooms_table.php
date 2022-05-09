<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('session_name');
            $table->string('coaching_name');
            $table->string('coaching_date');
            $table->string('coaching_role');
            $table->string('room_code');
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
        Schema::dropIfExists('coaching_rooms');
    }
}
