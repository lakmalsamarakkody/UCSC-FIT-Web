<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentFlagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_flags', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->boolean('info_complete')->default(false);
            $table->boolean('info_editable')->default(true);
            $table->boolean('declaration')->default(false);
            $table->boolean('application_submit')->default(false);
            $table->boolean('birth_cert')->default(false);
            $table->boolean('nic_img')->default(false)->default(false);
            $table->boolean('postal_img')->default(false);
            $table->boolean('bit_eligible')->default(false);
            $table->boolean('fit_cert')->default(false);
            $table->integer('phase_id')->default(1);
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
        Schema::dropIfExists('student_flags');
    }
}
