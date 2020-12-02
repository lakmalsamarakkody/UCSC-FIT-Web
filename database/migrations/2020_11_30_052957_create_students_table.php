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
            $table->string('gender');
            $table->string('nic')->unique();   
            $table->string('citizenship');
            $table->date('dob');
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
