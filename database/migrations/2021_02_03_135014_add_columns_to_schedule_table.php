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
            $table->string('schedule_approval')->nullable()->after('end_time');
            $table->string('declined_message')->nullable()->after('schedule_approval');
            $table->boolean('schedule_release')->default(false)->after('declined_message');
            $table->boolean('schedule_declined')->default(false)->after('schedule_release');
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
            $table->dropColumn('schedule_release');
            $table->dropColumn('declined_message');
            $table->dropColumn('schedule_approval');
            $table->dropColumn('schedule_declined');
        });
    }
}
