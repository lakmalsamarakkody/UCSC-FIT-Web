<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('subjects')->truncate();
    // $faker=\Faker\Factory::create();
        DB::table('subjects')->insert(
            array(
                ['name'=> 'ICT Applications',
                'code'=> '103',
                'created_at'=>'2020-11-30 10:13:53',
                'updated_at'=> '2020-11-30 10:13:53'],
                
                ['name'=> 'English for ICT',
                'code'=> '203',
                'created_at'=>'2020-11-30 10:13:53',
                'updated_at'=> '2020-11-30 10:13:53'],

                
                ['name'=> 'Mathematics for ICT',
                'code'=> '303',
                'created_at'=>'2020-11-30 10:13:53',
                'updated_at'=> '2020-11-30 10:13:53']

            )
        );
        
DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
