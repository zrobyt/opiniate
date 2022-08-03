<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_votes', function (Blueprint $table) {
            $table->id();
            $table->nullableTimestamps();
            $table->bigInteger('pid')->foreign('pid')->references('id')->on('polls')->onDelete('cascade');
            $table->bigInteger('uid')->foreign('uid')->references('id')->on('gusers')->onDelete('cascade');
            $table->integer('option');
            $table->string('comment');
            $table->string('notify');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_votes');
    }
}
