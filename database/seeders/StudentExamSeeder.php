<?php

namespace Database\Seeders;

use App\Models\Student_Exam\Result_Month;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=\Faker\Factory::create();
        $months=Result_Month::all();
        foreach($months as $month):
            for($i=0;$i<30;$i++):
                $mark=$faker->numerify('##.##');
                if($mark>=50):
                    $result=1;
                else:
                    $result=0;
                endif;
                DB::table('student_exams')->insert(
                    array (
                        [
                            'result_id'=>$month->id,
                            'exam_id'=>$faker->numberBetween($min = 1, $max = 14),
                            'student_id'=>$faker->numberBetween($min = 1, $max = 30),
                            'mark'=>$mark,
                            'result'=>$result,
                            'created_at'=> '2020-11-25 10:13:53',
                            'updated_at'=> '2020-11-25 10:13:53'
                        ]
                        
                    )
                );
            endfor;
        endforeach;
    }
}
