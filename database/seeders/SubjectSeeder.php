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
        $faker=\Faker\Factory::create();
        DB::table('subjects')->insert(
            array(
                ['subject_name'=> 'ICT Applications',
                'subject_code'=> 'FIT103',
                'created_at'=>$faker->dateTimeBetween('2020-11-01', '2020-11-30'),
                'updated_at'=> '2020-11-30 10:13:53'],
                
                ['subject_name'=> 'English for ICT',
                'subject_code'=> 'FIT203',
                'created_at'=>$faker->dateTimeBetween('2020-11-01', '2020-11-30'),
                'updated_at'=> '2020-11-30 10:13:53'],

                
                ['subject_name'=> 'Mathematics for ICT',
                'subject_code'=> 'FIT303',
                'created_at'=>$faker->dateTimeBetween('2020-11-01', '2020-11-30'),
                'updated_at'=> '2020-11-30 10:13:53']

            )
        );
    }
}
