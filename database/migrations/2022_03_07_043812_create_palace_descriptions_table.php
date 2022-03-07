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
            $table->json('day_master')->nullable();
            $table->json('culture')->nullable();
            $table->json('education')->nullable();
            $table->json('mindset')->nullable();
            $table->json('belief')->nullable();
            $table->json('career')->nullable();
            $table->json('partner')->nullable();
            $table->json('ambition')->nullable();
            $table->json('talent')->nullable();
            $table->json('business')->nullable();
            $table->json('intellectual')->nullable();
            $table->json('spiritual')->nullable();
            $table->json('emotional')->nullable();
            $table->json('social')->nullable();
            $table->json('relationship')->nullable();
            $table->json('financial')->nullable();
            $table->json('son')->nullable();
            $table->json('daughter')->nullable();
            $table->json('character')->nullable();
            $table->json('health')->nullable();
            $table->json('physical')->nullable();
            $table->json('goal')->nullable();
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
