<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Results extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('survey_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('indicator_id')->unsigned();
            $table->integer('answer');
            $table->timestamps();

            $table->foreign('survey_id')
                ->references('id')
                ->on('surveys')
                ->onDelete('cascade');

            $table->foreign('indicator_id')
                ->references('id')
                ->on('indicators')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('results');
    }
}
