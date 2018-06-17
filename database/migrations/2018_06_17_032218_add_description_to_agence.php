<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToAgence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agences', function (Blueprint $table) {
            $table->longText('description')->nullable();
            $table->longText('adresse')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agences', function (Blueprint $table) {
            $table->dropColumn("description");
            $table->dropColumn("adresse");
        });
    }
}
