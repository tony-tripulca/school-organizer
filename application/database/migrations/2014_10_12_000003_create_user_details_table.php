<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            // Keys
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('status_id')->unsigned()->default(1);
            $table->foreign('status_id')->references('id')->on('user_statuses');

            // System
            $table->timestamps();
            $table->tinyInteger('active')->default(1);
            $table->string('identifier')->index()->nullable();
            $table->string('username')->index()->nullable();

            // General
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();  
            $table->string('alias')->nullable();
            $table->date('birthday')->nullable();

            // Personal
            $table->string('image')->nullable();
            $table->string('gender')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();

            // Location
            $table->string('full_address')->nullable();
            $table->text('pres_line_1')->nullable();
            $table->text('pres_line_2')->nullable();
            $table->string('pres_municipality')->nullable();
            $table->string('pres_city')->nullable();
            $table->string('pres_province')->nullable();
            $table->string('pres_zip')->nullable();
            $table->text('perma_line_1')->nullable();
            $table->text('perma_line_2')->nullable();
            $table->string('perma_municipality')->nullable();
            $table->string('perma_city')->nullable();
            $table->string('perma_province')->nullable();
            $table->string('perma_zip')->nullable();

            // Contact
            $table->string('mobile')->nullable();
            $table->string('telephone')->nullable();
            $table->string('e_contact_name')->nullable();
            $table->string('e_contact_relation')->nullable();
            $table->string('e_contact_mobile')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
