<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_schedules', function (Blueprint $table) {
            $table->boolean('approval_request')->default(false);
            $table->boolean('schedule_approve')->default(false);
            $table->boolean('schedule_release')->default(false);
            $table->boolean('delete_request')->default(false);
            $table->boolean('postpone_request')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_schedules', function (Blueprint $table) {
            //
        });
    }
}
