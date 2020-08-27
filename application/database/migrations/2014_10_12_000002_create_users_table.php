<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // Keys
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('user_types');

            // System
            $table->timestamps();
            $table->tinyInteger('active')->default(1);
            $table->timestamp('last_login')->nullable();
            $table->rememberToken()->nullable();

            // General
            $table->string('first_name');
            $table->string('last_name');
            $table->string('password');
            $table->string('api_token')->unique()->nullable();

            // Contact
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
