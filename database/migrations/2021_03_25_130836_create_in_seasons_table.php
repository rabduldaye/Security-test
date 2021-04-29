<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('inseason', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userid')->unsigned();
            //needs to hold the score for this user
            $table->integer('score')->default(0);
            //need the division/conf/tags
            $table->string('division')->default('');
            $table->string('conference')->default('');
            $table->string('tags')->default('');
            //now for other statistical needs: (best/worst start/finishes)
            $table->integer("streak")->default(0);
            $table->string("winloss")->default("none");
            $table->foreign('userid')->references('id')->on('users');
            
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
        Schema::dropIfExists('inseason');
    }
}
