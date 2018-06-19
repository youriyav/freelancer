<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormuleDescriptionValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formule_description_values', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('value');
            $table->integer('description_formule_id')->unsigned()->nullable()->index();
            $table->foreign('description_formule_id')->references('id')->on('description_formules');
            $table->integer('formule_id')->unsigned()->nullable()->index();
            $table->foreign('formule_id')->references('id')->on('formules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formule_description_values');
    }
}
