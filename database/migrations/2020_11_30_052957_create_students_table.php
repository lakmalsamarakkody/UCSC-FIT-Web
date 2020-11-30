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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('nic')->unique();            
            $table->string('email')->unique();
            $table->string('citizenship');
            $table->date('dob');
            $table->boolean('birth_cert');
            $table->boolean('nic_img');
            $table->timestamps();
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
