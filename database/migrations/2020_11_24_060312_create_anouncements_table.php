<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anouncements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('announcement');
            $table->string('link');
        });
        DB::table('anouncements')->insert(
            array(
                ['created_at'=> '2020-11-23 11:52:09',
                'updated_at'=> '2020-11-23 11:52:14',
                'announcement'=> 'October Exam Results Released',
                'link'=>"{{url('/portal/results')}}"],

                ['created_at'=> '2020-11-24 11:53:52',
                'updated_at'=> '2020-11-24 11:54:13',
                'announcement'=> 'Applications Now Open for December Exams',
                'link'=>"{{url('/portal/register')}}"],
                
                ['created_at'=> '2020-11-24 11:55:27',
                'updated_at'=> '2020-11-24 11:55:31',
                'announcement'=> 'IMPORTANT NOTICE – Communication During Curfew',
                'link'=>"{{url('/notice')}}"],
                
                ['created_at'=> '2020-11-24 12:01:16',
                'updated_at'=> '2020-11-24 12:01:20',
                'announcement'=> 'Extensions of Deadlines of the FIT Programme',
                'link'=>"{{url('/notice')}}"],

            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anouncements');
    }
}
