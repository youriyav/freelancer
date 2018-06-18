<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToDescriptionFormule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('description_formules', function (Blueprint $table) {
            $table->integer('type')->nullable();
        });
    }
    public function down()
    {
        Schema::table('description_formules', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
