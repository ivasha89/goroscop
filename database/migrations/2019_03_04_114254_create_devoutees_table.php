<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevouteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devoutees', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('planet_zodiac_sign');
            $table->unsignedInteger('planet_house');
            $table->string('planet_name', '16');
            $table->bigIncrements('id');
            $table->engine='InnoDB';
            $table->charset='Utf8mb4';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devoutees');
    }
}
