<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('set_seasons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userid')->unsigned();
            $table->integer('gameid');
            $table->foreign('gameid')->references('espnID')->on('games');
            $table->foreign('userid')->references('id')->on('users');
            $table->integer('selection');
            $table->timestamps();
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('set_seasons');
    }
}
