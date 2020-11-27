<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('anouncements')->insert(
            array(
                ['title'=> 'October Exam Results Released',
                'description'=> '',
                'link'=>"/portal/results",
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],

                ['title'=> 'Applications Now Open for December Exams',
                'description'=> 'Deadline on 31st of December',
                'link'=>"/portal/register",
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],
                
                ['title'=> 'IMPORTANT NOTICE – Communication During Curfew',
                'description'=> '',
                'link'=>"/notice",
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],
                
                ['title'=> 'Extensions of Deadlines of the FIT Programme',
                'description'=> 'Deadline on 31st of December',
                'link'=>"/notice",
                'created_at'=> '2020-11-23 10:13:53',
                'updated_at'=> '2020-11-23 10:13:53'],
            )
        );
    }
}
