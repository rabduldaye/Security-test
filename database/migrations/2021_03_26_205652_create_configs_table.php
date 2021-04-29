<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->id();
            $table->string('welcome')->default("Welcome to Nolan Bowl XXX");
            $table->string('title')->default("Nolan Bowl XXX");
            $table->longText('rules');
            $table->longText('mapembed');
            $table->string('seasonlock')->default('no');
            $table->string('userssortedflag')->default('no');
            $table->string('cq1');
            $table->string('cq2');
            $table->integer('michiganID')->default('130');
            $table->integer('notredameID')->default('87');


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
        Schema::dropIfExists('config');
    }
}
