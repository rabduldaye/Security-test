<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('espnID')->unique();
            $table->string('name');
            $table->date('date');
            $table->string('team1')->default('10');
            $table->string('team1Name')->default('');
            $table->string('team2Name')->default('');
            $table->string('team2')->default('1');
            $table->integer('team1_score')->default(0);
            $table->integer('team2_score')->default(0);
            $table->integer('points')->default(0);
            $table->string('scoredflag')->default('no');



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
        Schema::dropIfExists('games');
    }
}
