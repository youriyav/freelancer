<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slugs', function (Blueprint $table) {
            $table->integer('projet_id')->unsigned()->nullable()->index();
            $table->foreign('projet_id')->references('id')->on('projets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projets', function (Blueprint $table) {
            //
            $table->dropColumn('projet_id');
        });
    }
}
