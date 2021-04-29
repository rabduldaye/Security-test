<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_games', function (Blueprint $table) {
            $table->id();
	    $table->string('game name');
            $table->string('espnID')->unique();
            $table->string('team1');
            $table->string('team2');
            $table->integer('team1-score')->default(0);
            $table->integer('team2-score')->default(0);
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
        Schema::dropIfExists('create_games');
    }
}
