<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slugs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('content')->unique();
            $table->integer('plateforme_id')->unsigned()->nullable()->index();
            $table->foreign('plateforme_id')->references('id')->on('plateformes');
            $table->integer('technologie_id')->unsigned()->nullable()->index();
            $table->foreign('technologie_id')->references('id')->on('technologies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slugs');
    }
}
