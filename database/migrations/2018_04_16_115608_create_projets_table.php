<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('titre');
            $table->integer('state');
            $table->integer('nbrVue');
            $table->text('description');
            $table->integer('demarrage_projet_id')->unsigned()->nullable()->index();
            $table->foreign('demarrage_projet_id')->references('id')->on('demarrage_projets');
            $table->integer('budget_id')->unsigned()->nullable()->index();
            $table->foreign('budget_id')->references('id')->on('budgets');
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('freelancer_id')->unsigned()->nullable()->index();
            $table->foreign('freelancer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projets');
    }
}
