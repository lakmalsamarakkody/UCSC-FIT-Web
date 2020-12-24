<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $faker=\Faker\Factory::create();
        for($i=0;$i<50;$i++):
            $student=$faker->numberBetween($min = 1, $max = 30);
            DB::table('student_registrations')->insert(
                array(
                    [
                        'student_id'=>$student,
                        'registered_at'=>$faker->dateTimeBetween('2020-11-25','2020-12-31'),
                        'registration_expire_at'=>$faker->dateTimeBetween('2021-11-25','2021-12-31'),
                        'registration_status'=>$faker->numberBetween($min = 0, $max = 1),
                        'payment_id'=>$faker->unique()->numberBetween($min = 1, $max = 50),
                        'created_at'=>'2020-11-25 10:13:53',
                        'updated_at'=>'2020-11-25 10:13:53',
                    ]
                )
            );
        endfor;
    }
}
