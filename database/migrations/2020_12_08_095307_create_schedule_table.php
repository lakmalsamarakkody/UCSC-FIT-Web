<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('exam_id');
            $table->integer('subject_id');
            $table->integer('exam_type_id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->string('schedule_approval')->nullable();
            $table->text('declined_message')->nullable();
            $table->boolean('schedule_release')->default(false);
            $table->boolean('schedule_declined')->default(false);
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
        Schema::dropIfExists('exam_schedules');
    }
}
