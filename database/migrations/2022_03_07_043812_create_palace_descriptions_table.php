<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePalaceDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palace_descriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('palace_id')->constrained();
            $table->json('day_master');
            $table->json('culture');
            $table->json('education');
            $table->json('mindset');
            $table->json('belief');
            $table->json('career');
            $table->json('partner');
            $table->json('ambition');
            $table->json('talent');
            $table->json('business');
            $table->json('intellectual');
            $table->json('spiritual');
            $table->json('emotional');
            $table->json('social');
            $table->json('relationship');
            $table->json('financial');
            $table->json('son');
            $table->json('daughter');
            $table->json('character');
            $table->json('health');
            $table->json('physical');
            $table->json('goal');
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
        Schema::dropIfExists('palace_descriptions');
    }
}
