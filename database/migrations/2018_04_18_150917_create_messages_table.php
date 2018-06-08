<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('sender_id')->unsigned()->nullable()->index();
            $table->foreign('sender_id')->references('id')->on('users');
            $table->integer('receiver_id')->unsigned()->nullable()->index();
            $table->foreign('receiver_id')->references('id')->on('users');
            $table->integer('offre_id')->unsigned()->nullable()->index();
            $table->foreign('offre_id')->references('id')->on('offres');
            $table->longText('message');
            $table->integer('isReaded');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
