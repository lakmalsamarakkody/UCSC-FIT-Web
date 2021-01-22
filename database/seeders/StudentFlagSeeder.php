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
                        'student_id'=>$student->id,
                        'bit_eligible'=>$bit,
                        'info_complete' => $faker->randomElement($array = array (true, false)),
                        'info_editable' => $faker->randomElement($array = array (true, false)),
                        'declaration' => $faker->randomElement($array = array (true, false)),
                        'fit_cert'=>$fit,
                        'phase_id'=>'1',
                    ]
                )
            );
        endforeach;
    }
}
