<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProfilesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->string('type');
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->string('email');
            $table->integer('phone');
            $table->integer('postcode');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')
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
        Schema::drop('company_profiles');
    }
}
