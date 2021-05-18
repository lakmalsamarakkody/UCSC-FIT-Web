<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentExamScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students=Student::all();
        
        foreach($students as $student):
            if ($student->id < 81) {
                DB::table('student_exams')->insert(
                    array(
                        [
                            'exam_schedule_id' => 136,
                            'student_id'=>$student->id,
                            'subject_id'=> 1,
                            'exam_type_id' =>  1,
                            'requested_exam_id' => 28,
                            'status'=> 'AB',
                            'payment_id'=> $student->id,
                            'payment_status'=> 'Approved',
                            'schedule_status'=> 'Approved',
                            'created_at'=> '2021-04-13 15:47:51',
                            'updated_at'=>  '2021-04-13 15:47:51'
                        ]
                    )
                );
            }
            
        endforeach;
    }
}
