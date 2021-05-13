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
            $table->string('full_name');
            $table->string('unique_id')->unique();
            $table->bigInteger('telephone')->length(16)->nullable();
            $table->string('email')->unique();
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
