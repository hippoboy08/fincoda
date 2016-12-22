<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('user_group_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->text('end_message');
            $table->string('start_time');
            $table->string('end_time');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('type_id')->references('id')->on('survey_types')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('category_id')->references('id')->on('survey_categories')->onDelete('cascade');
            $table->foreign('user_group_id')->references('id')->on('user_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('surveys');
    }
}
