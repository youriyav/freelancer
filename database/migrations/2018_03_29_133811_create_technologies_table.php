<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technologies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('libelle');
            $table->text('description');
            $table->integer('isDeleted');
            $table->integer('plateforme_id')->unsigned()->nullable()->index();
            $table->foreign('plateforme_id')->references('id')->on('plateformes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technologies');
    }
}
