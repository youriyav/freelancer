<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLigneCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->float('prix');
            $table->integer('quantite');
            $table->string('libelle');
            $table->integer('commande_id')->unsigned()->nullable()->index();
            $table->foreign('commande_id')->references('id')->on('commandes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ligne_commandes');
    }
}
