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
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('anouncements')->insert(
            array(
                ['title'=> 'October Exam Results Released',
                'description'=> '',
                'link'=>"{{url('/portal/results')}}",
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],

                ['title'=> 'Applications Now Open for December Exams',
                'description'=> 'Deadline on 31st of December',
                'link'=>"{{url('/portal/register')}}",
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],
                
                ['title'=> 'IMPORTANT NOTICE – Communication During Curfew',
                'description'=> '',
                'link'=>"{{url('/notice')}}",
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],
                
                ['title'=> 'Extensions of Deadlines of the FIT Programme',
                'description'=> 'Deadline on 31st of December',
                'link'=>"{{url('/notice')}}",
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],
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
