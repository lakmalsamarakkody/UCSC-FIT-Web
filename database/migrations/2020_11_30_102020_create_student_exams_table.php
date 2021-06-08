<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_exams', function (Blueprint $table) {
            $table->id();
            $table->integer('exam_schedule_id')->nullable();
            $table->integer('student_id');
            $table->integer('subject_id');
            $table->integer('exam_type_id');
            $table->integer('requested_exam_id')->nullable();
            $table->boolean('result')->nullable()->default(false);
            $table->integer('raw_mark')->nullable();
            $table->integer('round_mark')->nullable();
            $table->decimal('mark',10,2)->nullable();
            $table->string('status')->nullable()->default('AB');
            $table->integer('payment_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->text('declined_message')->nullable();
            $table->string('schedule_status')->default('Pending');
            $table->integer('medical_id')->nullable();
            $table->integer('exam_reschedule_id')->nullable();
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
        Schema::dropIfExists('student_exams');
    }
}
