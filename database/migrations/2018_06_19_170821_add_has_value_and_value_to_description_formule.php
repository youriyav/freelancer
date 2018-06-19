<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHasValueAndValueToDescriptionFormule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('description_formules', function (Blueprint $table) {
            $table->integer('hasValue')->nullable();
            $table->string('value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('description_formules', function (Blueprint $table) {
            $table->dropColumn('hasValue');
            $table->dropColumn('value');
        });
    }
}
