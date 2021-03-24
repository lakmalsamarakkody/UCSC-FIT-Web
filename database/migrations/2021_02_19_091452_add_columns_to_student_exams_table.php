<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToStudentExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_exams', function (Blueprint $table) {
            $table->integer('subject_id')->after('student_id');
            $table->integer('exam_type_id')->after('subject_id');
            $table->integer('requested_exam_id')->after('exam_type_id');
            $table->string('payment_status')->nullable()->after('payment_id');
            $table->text('declined_message')->nullable()->after('payment_status');
            $table->string('schedule_status')->default('Pending')->after('declined_message');
            $table->integer('medical_id')->nullable()->after('schedule_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('student_exams', function (Blueprint $table) {
        //     $table->dropColumn('subject_id');
        //     $table->dropColumn('exam_type_id');
        //     $table->dropColumn('requested_exam_id');
        //     $table->dropColumn('payment_status');
        //     $table->dropColumn('declined_message');
        //     $table->dropColumn('schedule_status');
        //     $table->dropColumn('medical_id');
        // });
    }
}
