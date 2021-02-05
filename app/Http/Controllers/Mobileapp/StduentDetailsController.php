<?php

namespace App\Http\Controllers\Mobileapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Student_Exam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

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
         $stuData= DB::table('students')
         ->join('student_flags','students.id',"=",'student_flags.student_id')
         ->select(
             "students.id",
             "students.reg_no",
             "students.user_id",
             "students.first_name",
             "students.middle_names",
             "students.last_name",
             "students.full_name",
             "students.dob",
             "students.gender",
             "students.reg_year",
             "students.citizenship",
             "students.nic_new",
             "students.education",
             "students.permanent_house",
             "students.permanent_address_line1",
             "students.permanent_address_line2",
             "students.permanent_address_line3",
             "students.permanent_address_line4",
             "students.telephone_country_code",
             "students.telephone",
             "student_flags.bit_eligible",
             "student_flags.fit_cert"
             
         )
         ->get();
         return $stuData;
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
