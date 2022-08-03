<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->nullableTimestamps();
            $table->string('title');
            $table->string('link');
            $table->string('loca');
            $table->string('subloca');
            $table->integer('year');
            $table->string('category');
            $table->string('subcate');
            $table->longText('tags');
            $table->longText('options');
            $table->enum('status',['open','closed']);
            $table->integer('views');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polls');
    }
}
