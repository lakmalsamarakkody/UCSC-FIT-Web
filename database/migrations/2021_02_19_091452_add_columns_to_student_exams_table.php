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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_exams', function (Blueprint $table) {
            $table->dropColumn('subject_id');
            $table->dropColumn('exam_type_id');
            $table->dropColumn('requested_exam_id');
        });
    }
}
