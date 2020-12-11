<?php

namespace App\Http\Controllers\Mobileapp;

use App\Http\Controllers\Controller;
use App\Models\Exam as ModelsExam;
use App\Models\Exam\Schedule as ExamSchedule;
use Illuminate\Http\Request;
use App\Models\Student_Exam as StuExam;

class StudentExamController extends Controller
{
    function currentExam(){
        return ExamSchedule::all();
    }
}
