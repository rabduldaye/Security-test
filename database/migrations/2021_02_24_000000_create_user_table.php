<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nickname')->default('');
            $table->string('firstname')->default('');
            $table->string('lastname')->default('');
            $table->string('email')->unique();
            $table->string('password')->default('');
            $table->rememberToken();
            $table->string('city')->default('');
            $table->string('state')->default('');
            $table->string('bowling')->default('');
            $table->string('cq1')->default('');
            $table->string('cq2')->default('');
            $table->string('favsport')->default('');
            $table->string('knowme')->default('');
            $table->string('news')->default('');
            $table->string('smack')->default('');
            $table->string('startpage')->default('welcome');
            $table->string('status')->default('new');
            $table->boolean('is_admin')->nullable();
            $table->string('tags')->nullable()->default('');
            $table->string('division')->nullable()->default('');
            $table->string('conference')->nullable()->default('');
            $table->integer('score')->default(0);
            $table->integer('wins')->default(0);
            $table->integer('streak')->default(0);
            $table->string('streakWL')->default('');
            $table->integer('allscores')->default(0);
            $table->integer('selmichigan')->default(0);
            $table->integer('selnotredame')->default(0);
            $table->integer('coinflip')->default(0);
            $table->integer('divisionWins')->default(0);
            $table->double('nbi')->default(0.0);
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
        Schema::dropIfExists('users');
    }
}
