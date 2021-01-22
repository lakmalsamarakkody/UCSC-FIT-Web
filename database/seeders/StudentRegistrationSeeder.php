<?php

namespace Database\Seeders;

use App\Models\Student;
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
        $students=Student::all();
        foreach($students as $student):
            DB::table('student_registrations')->insert(
                array(
                    [
                        'student_id'=>$student->id,
                        'registered_at'=>$faker->dateTimeBetween('2020-11-25','2020-12-31'),
                        'registration_expire_at'=>$faker->dateTimeBetween('2021-11-25','2021-12-31'),
                        'application_submit' => $faker->numberBetween($min = 0, $max = 1),
                        'application_status' => $faker->randomElement($array = array (null, 'Approved', 'Declined')),
                        'document_submit' => $faker->numberBetween($min = 0, $max = 1),
                        'document_status' => $faker->randomElement($array = array (null, 'Approved', 'Declined')),
                        'payment_id'=>$faker->unique()->numberBetween($min = 1, $max = 100),
                        'payment_status' => $faker->randomElement($array = array (null, 'Approved', 'Declined')),
                        'status'=>$faker->numberBetween($min = 0, $max = 1),
                        'created_at'=>'2020-11-25 10:13:53',
                        'updated_at'=>'2020-11-25 10:13:53',
                    ]
                )
            );
        endforeach;
    }
}
