<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i=0;$i<30;$i++){

            $f_name= $faker->firstName;
            $l_name=$faker->lastName;
            $m_names=$f_name." ".$l_name;
            $initials= $f_name[0]." ".$l_name[0];
            $full_name=$f_name." ".$m_names." ".$l_name;
            $gender=$faker->randomElement($array = array ('male', 'female'));

            DB::table('students')->insert(
                array(
    
                    ['reg_no'=> 'F'. $faker->unique()->numerify('#########'),
                    'index_no'=> $faker->unique()->numerify('##########'),
                    'title'=> $faker->title($gender),
                    'first_name'=> $f_name,
                    'middle_names'=> $m_names,
                    'last_name'=> $l_name,
                    'full_name'=> $full_name,
                    'initials'=> $initials,
                    'gender'=> $gender,
                    'nic'=>$faker->unique()->numerify('#########').'V',
                    'email'=>$faker->email,
                    'citizenship'=>'Sri Lankan',
                    'dob'=>$faker->dateTimeBetween('1980-01-01', '2000-12-31'),
                    'created_at'=>$faker->dateTimeBetween('2020-11-01', '2020-11-30'),
                    'updated_at'=> '2020-11-30 13:14:56']
    
                )
            );
        }

    }
}
