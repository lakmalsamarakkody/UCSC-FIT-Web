<?php

namespace App\Http\Controllers\Mobileapp;

use App\Http\Controllers\Controller;
use App\Models\Exam as ModelsExam;
use App\Models\Exam\Schedule as ExamSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student_Exam as StuExam;

use App\Models\Subject;

class StudentExamController extends Controller
{

    function examSchedule(){
       return [
        "status"=>true,
        "Data"=>DB::table('exam_schedules')
       ->join('subjects','exam_schedules.subject_id',"=",'subjects.id')
       ->join('exam_types','exam_schedules.exam_type_id',"=",'exam_types.id')
       ->join('exams','exam_schedules.exam_id',"=",'exams.id')
       ->select(
           'exam_schedules.date',
           'exam_schedules.start_time',
           'exam_schedules.end_time',
           'subjects.code',
           'subjects.name',
           'exam_types.exam_type',
           'exams.year',
           'exams.month'
           )
       ->get()];
    }
}
