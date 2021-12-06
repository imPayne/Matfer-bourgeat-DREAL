<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->integer('posX');
            $table->integer('posY');
            $table->integer('width');
            $table->integer('height');
            $table->string('alley');
            $table->string('column');
            $table->integer('massWood');
            $table->integer('massPlastic');
            $table->integer('massDangerousProducts');
            $table->foreignId('building_id')->references('id')->on('buildings');
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
        Schema::dropIfExists('zones');
    }
}
