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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('exam_types')->truncate();
    DB::table('exam_types')->insert(
            array(
                ['name'=> 'E-Test',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53'],
                ['name'=> 'Practical',
                'created_at'=> '2020-11-25 10:13:53',
                'updated_at'=> '2020-11-25 10:13:53']
            )
        );
        
DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
