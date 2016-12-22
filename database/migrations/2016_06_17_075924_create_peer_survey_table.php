<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeerSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peer_surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('survey_id')->unsigned();
            $table->integer('peer_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
            $table->foreign('peer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('peer_surveys');
    }
}
