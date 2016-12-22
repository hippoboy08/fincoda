<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeerResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peer_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('peer_survey_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('indicator_id')->unsigned();
            $table->integer('answer');
            $table->timestamps();

            $table->foreign('peer_survey_id')->references('id')->on('peer_surveys')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('indicator_id')->references('id')->on('indicators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('peer_results');
    }
}
