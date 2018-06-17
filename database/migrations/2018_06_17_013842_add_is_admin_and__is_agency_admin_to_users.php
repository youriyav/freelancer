<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAdminAndIsAgencyAdminToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('agency')->nullable();
            $table->integer('isAdmin')->nullable();
            $table->integer('isAgencyAdmin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("agency");
            $table->dropColumn("isAdmin");
            $table->dropColumn("isAgencyAdmin");
        });
    }
}
