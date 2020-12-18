<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentFlagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $students=Student::all();
        $faker=\Faker\Factory::create();
        foreach($students as $student):
            $fit=$faker->randomElement($array = array (true, false));
            $bit=false;
            if ($fit==true){
                $bit=$fit;
            }else{
                $bit=$faker->randomElement($array = array (true, false));
            }
            DB::table('student_flags')->insert(
                array(
                    [
                        'id'=>$student->id,
                        'bit_eligible'=>$bit,
                        'fit_cert'=>$fit,
                    ]
                )
            );
        endforeach;
    }
}
