<?php

namespace App\Http\Controllers\Mobileapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Student_Exam;
use Illuminate\Support\Facades\DB;
class StduentDetailsController extends Controller
{
    function studentDetails(){
         return DB::table('exam_schedules')
         ->join('subjects','exam_schedules.subject_id',"=",'.subjects.id')
         ->join('student_exams','exam_schedules.id',"=",'student_exams.exam_schedule_id')
         ->join('students','student_exams.student_id',"=",'students.id')
         ->get();
    }
    function searchStudents(){
         return Student::all();
    }

}
