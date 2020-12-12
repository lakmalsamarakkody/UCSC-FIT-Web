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
         return DB::table('students')
         ->join('student_exams','students.id',"=",'student_exams.student_id')
         ->get();
    }

}
