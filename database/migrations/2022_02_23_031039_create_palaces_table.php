<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePalacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palaces', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('code')->unique();
            $table->string('name');
            $table->string('description');
            $table->string('font_color', 7);
            $table->string('background_color', 7);
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
        Schema::dropIfExists('palaces');
    }
}
