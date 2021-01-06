<?php

namespace App\Http\Controllers\Mobileapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Student_Exam;
use Illuminate\Support\Facades\DB;
class StduentDetailsController extends Controller
{
    function studentDetails($id){
         return DB::table('exam_schedules')
         ->join('subjects','exam_schedules.subject_id',"=",'subjects.id')
         ->join('student_exams','exam_schedules.id',"=",'student_exams.exam_schedule_id')
         ->join('students','student_exams.student_id',"=",'students.id')
         ->where('students.id',$id)
         ->select(
             'subjects.name',
             'subjects.code',
             'student_exams.result',
             'student_exams.mark',
             'exam_schedules.date'
         )
         ->get();
    }
    function searchStudents(){
         return Student::all();
    }
   function searchStudentsbyname($name=''){
       if($name==''){
        return Student::all();
       }
       else{
       return Student::where('first_name','LIKE',"%{$name}%")->get();
   }
}
}
