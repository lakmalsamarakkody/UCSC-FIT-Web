<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_registrations', function (Blueprint $table) {            
            $table->id();
            $table->integer('student_id');
            $table->date('registered_at')->nullable();
            $table->date('registration_expire_at')->nullable();
            $table->boolean('application_submit')->default(false);
            $table->string('application_status')->length(25)->nullable();
            $table->boolean('document_submit')->default(false);
            $table->string('document_status')->length(25)->nullable();
            $table->integer('payment_id')->nullable();
            $table->boolean('status')->length(25)->nullable();
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
        Schema::dropIfExists('student_registrations');
    }
}
