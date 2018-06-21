<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestatairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestataires', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('type');
            $table->integer('user_id');
            $table->string('adresse');
            $table->text('description');
            $table->string('skype');
            $table->string('facebook');
            $table->string('whatssap');
            $table->integer('nbrVueProfil');
            $table->string('endAbonnement');
            //$table->text('ville');
            //$table->text('pays');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestataires');
    }
}
