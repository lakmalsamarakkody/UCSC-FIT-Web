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
            $table->string('medical_reason')->nullable()->after('declined_message');
            $table->string('medical_image')->nullable()->after('medical_reason');
            $table->string('medical_status')->nullable()->after('medical_image');
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
        //     $table->dropColumn('medical_reason');
        //     $table->dropColumn('medical_image');
        //     $table->dropColumn('medical_status');
        // });
    }
}
