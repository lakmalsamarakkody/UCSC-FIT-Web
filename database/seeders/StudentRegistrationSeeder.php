<?php

namespace Database\Seeders;

use App\Models\Student_Registration\Academic_Year;
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
            $year_id=$faker->numberBetween($min = 1, $max = 5);
            $student=$faker->numberBetween($min = 1, $max = 30);
            $Academic_Year=Academic_Year::where('id', $year_id)->first();
            $created_date=$faker->dateTimeBetween($Academic_Year->start, $Academic_Year->end);
            DB::table('student_registrations')->insert(
                array(
                    [
                        'year_id'=>$year_id,
                        'student_id'=>$student,
                        'deadline'=>$Academic_Year->end,
                        'payment_id'=>$faker->unique()->numberBetween($min = 1, $max = 50),
                        'created_at'=>$created_date,
                        'updated_at'=>$faker->dateTimeBetween($created_date, $Academic_Year->end)
                    ]
                )
            );
        endfor;
    }
}
