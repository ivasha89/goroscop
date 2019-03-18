<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanetRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planet_relations', function (Blueprint $table) {
            $table->unsignedInteger('man_sign');
            $table->unsignedInteger('woman_sign');
            $table->boolean('count_planet');
            $table->unsignedInteger('strength');
            $table->bigIncrements('id');
            $table->engine = 'InnoDB';
            $table->charset = 'Utf8mb4';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planet_relations');
    }
}
