<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentPhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('student_phases')->truncate();
    DB::table('student_phases')->insert(
            array(
                ['code'=> '1',
                'name'=> 'Default User',
                'description'=> 'Default user...',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],

                ['code'=> '2',
                'name'=> 'Blocked User',
                'description'=> 'Blocked user...',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
            )
        );
        
DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
