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
    DB::table('student_phases')->truncate();
    DB::table('student_phases')->insert(
            array(
                ['code'=> '1',
                'name'=> 'Fresh User',
                'description'=> 'Fresh user...',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53']
            )
        );
    }
}
