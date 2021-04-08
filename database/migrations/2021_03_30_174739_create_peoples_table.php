<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeoplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peoples', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('age');
            $table->unsignedInteger('boss_id')->nullable();
            $table->foreign('boss_id')->references('id')->on('peoples');   
            $table->unsignedInteger('favorite_author_id')->nullable();
            $table->foreign('favorite_author_id')->references('id')->on('peoples');   
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
        Schema::dropIfExists('peoples');
    }
}
