<?php

namespace App\Http\Controllers\Mobileapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
class SubjectController extends Controller
{
   function subjectDetails(){
    return Subject::all();
   }

   function subjectresult($id,$year=0){
       if($year==0){

           $year=idate('Y');
       }
   $data=DB::table('exam_schedules')
    ->join('subjects','exam_schedules.subject_id',"=",'subjects.id')
    ->join('student_exams','exam_schedules.id',"=",'student_exams.exam_schedule_id')
    ->join('students','student_exams.student_id',"=",'students.id')
    ->join('exams','exam_schedules.exam_id',"=",'exams.id')
    ->where('subjects.id',$id)
    ->where('exams.year',$year)
    ->select(
        'subjects.name',
        'subjects.code',
        'student_exams.result',
        'student_exams.mark',
        'exam_schedules.date',
         'exams.year',
         'exams.month',
         'exam_schedules.id'
    )
    ->get();
     $co=$data->count();
     for($i=0; $i<$co; $i++){

     }
    return $data->count();
}
}
