<?php

namespace Database\Seeders;

use App\Models\Exam\Schedule;
use App\Models\Student;
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
        $exam_schedules=Schedule::all();
        foreach($exam_schedules as $exam):
            $students=Student::all();
            foreach($students as $student):
                $mark=$faker->numerify('##.##');
                if($mark>=50):
                    $result=1;
                else:
                    $result=0;
                endif;
                DB::table('student_exams')->insert(
                    array (
                        [
                        'exam_schedule_id'=>$exam->id,
                        'subject_id'=>$exam->subject_id,
                        'student_id'=>$student->id,
                        'exam_type_id'=>$exam->exam_type_id,
                        'requested_exam_id'=>10,
                        'mark'=>$mark,
                        'result'=>$result,
                        'status'=>'OK',
                        'payment_id'=>$faker->numberBetween($min = 1, $max =  500),
                        'created_at'=> '2020-11-25 10:13:53',
                        'updated_at'=> '2020-11-25 10:13:53'
                        ]
                    )
                );
            endforeach;
        endforeach;

    }
}
