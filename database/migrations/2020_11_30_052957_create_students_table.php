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
            $table->string('reg_no')->unique();
            $table->string('index_no')->unique();
            $table->integer('user_id')->unique();
            $table->string('title');
            $table->string('first_name');
            $table->string('middle_names');
            $table->string('last_name');
            $table->string('full_name');
            $table->string('initials');
            $table->date('dob');
            $table->string('gender');
            $table->string('citizenship');
            $table->string('nic_old')->unique()->length(10);
            $table->integer('nic_new')->unique()->length(12);
            $table->string('postal')->unique()->length(9);
            $table->string('passport')->unique();
            $table->string('education');
            $table->string('permanent_house');
            $table->string('permanent_address_line1');
            $table->string('permanent_address_line2');
            $table->string('permanent_address_line3');
            $table->string('permanent_address_line4');
            $table->string('permanent_city');
            $table->string('permanent_country');
            $table->string('current_house');
            $table->string('current_address_line1');
            $table->string('current_address_line2');
            $table->string('current_address_line3');
            $table->string('current_address_line4');
            $table->string('current_city');
            $table->string('current_country');
            $table->integer('telephone')->unique()->length(10);
            $table->string('designation')->nullable();
            $table->integer('reg_year')->length(4);
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
