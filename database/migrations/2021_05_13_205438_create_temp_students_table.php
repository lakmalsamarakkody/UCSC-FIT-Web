<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_students', function (Blueprint $table) {
            $table->id();
            $table->string('reg_no')->unique();
            $table->string('full_name')->nullable();
            $table->string('initials')->nullable();
            $table->string('last_name')->nullable();
            $table->string('title')->nullable();
            $table->string('gender')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('unique_id')->unique();
            $table->string('dob')->nullable();
            $table->string('permanent_address_line1')->nullable();
            $table->string('permanent_address_line2')->nullable();
            $table->string('permanent_address_line3')->nullable();
            $table->string('city')->nullable();
            $table->bigInteger('telephone')->length(16)->nullable();
            $table->string('email')->unique();
            $table->string('reg_fee')->nullable();
            $table->string('paid_branch')->nullable();
            $table->string('paid_date')->nullable();
            $table->string('designation')->nullable();            
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
        Schema::dropIfExists('temp_students');
    }
}
