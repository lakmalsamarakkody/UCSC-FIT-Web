<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exam_types')->insert(
            array(
                ['subject'=> 'FIT103',
                'exam_type'=> '103-E-Test',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['subject'=> 'FIT203',
                'exam_type'=> '203-E-Test',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['subject'=> 'FIT303',
                'exam_type'=> '303-E-Test',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['subject'=> 'FIT103',
                'exam_type'=> '103-Practical',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['subject'=> 'FIT203',
                'exam_type'=> '203-Practical',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
            )
        );
    }
}
