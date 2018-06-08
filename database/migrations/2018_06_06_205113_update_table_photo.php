<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTablePhoto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->integer('plateforme_id')->unsigned()->nullable()->index();
            $table->integer('realisation_id')->nullable();
            $table->integer('agence_id')->nullable();
            //$table->foreign('plateforme_id')->references('id')->on('plateformes');
            //$table->foreign('plateforme_id')->references('id')->on('plateformes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('photos', function (Blueprint $table) {
            //
        });
    }
}
