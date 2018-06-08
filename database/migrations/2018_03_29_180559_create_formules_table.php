<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formules', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('libelle');
            $table->string('prix');
            $table->string('couleur');
            $table->integer('isDeleted');
            $table->integer('isActivated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formules');
    }
}
