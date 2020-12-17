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
            $table->string('nic_old')->unique()->length(10)->nullable();
            $table->bigInteger('nic_new')->unique()->length(12)->nullable();
            $table->string('postal')->unique()->length(9)->nullable();
            $table->string('passport')->unique();
            $table->string('education')->nullable();
            $table->string('permanent_house')->nullable();
            $table->string('permanent_address_line1')->nullable();
            $table->string('permanent_address_line2')->nullable();
            $table->string('permanent_address_line3')->nullable();
            $table->string('permanent_address_line4')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanent_country')->nullable();
            $table->string('current_house')->nullable();
            $table->string('current_address_line1')->nullable();
            $table->string('current_address_line2')->nullable();
            $table->string('current_address_line3')->nullable();
            $table->string('current_address_line4');
            $table->string('current_city')->nullable();
            $table->string('current_country')->nullable();
            $table->integer('telephone')->unique()->length(10)->nullable();
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
