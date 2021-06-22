<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('reg_no')->unique()->nullable();
            $table->integer('user_id')->unique();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_names')->nullable();
            $table->string('last_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('initials')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('citizenship')->nullable();
            
            $table->string('nic_old')->unique()->nullable();
            $table->string('nic_new')->unique()->nullable();
            $table->string('postal')->unique()->nullable();
            $table->string('passport')->unique()->nullable();

            $table->string('education')->nullable();

            $table->string('permanent_house')->nullable();
            $table->string('permanent_address_line1')->nullable();
            $table->string('permanent_address_line2')->nullable();
            $table->string('permanent_address_line3')->nullable();
            $table->string('permanent_address_line4')->nullable();
            $table->integer('permanent_city_id')->nullable();
            $table->integer('permanent_state_id')->nullable();
            $table->integer('permanent_country_id')->nullable();

            $table->string('current_house')->nullable();
            $table->string('current_address_line1')->nullable();
            $table->string('current_address_line2')->nullable();
            $table->string('current_address_line3')->nullable();
            $table->string('current_address_line4')->nullable();
            $table->integer('current_city_id')->nullable();
            $table->integer('current_state_id')->nullable();
            $table->integer('current_country_id')->nullable();

            $table->integer('telephone_country_code')->length(5)->nullable();
            $table->bigInteger('telephone')->length(16)->nullable();
            $table->string('designation')->nullable();
            $table->integer('reg_year')->length(4)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
