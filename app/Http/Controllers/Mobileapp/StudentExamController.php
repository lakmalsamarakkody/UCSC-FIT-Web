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
    function currentExam(){
        $ar=array();
        $subjectcount=DB::table('subjects')->count();
        for($i=1; $i<=$subjectcount; $i++){
        $scheId=DB::table('exam_schedules')
        ->join('student_exams','exam_schedules.id',"=",'student_exams.exam_schedule_id')
        ->join('subjects','exam_schedules.subject_id',"=",'subjects.id')
        ->orderBy('student_exams.updated_at', 'desc')
        ->where('subjects.id',$i)
        ->select('exam_schedules.id')
        ->take(1)->get();



        $data=DB::table('exam_schedules')
        ->join('subjects','exam_schedules.subject_id',"=",'subjects.id')
        ->join('exam_types','exam_schedules.exam_type_id',"=",'exam_types.id')
        ->join('exams','exam_schedules.exam_id',"=",'exams.id')
        ->join('student_exams','exam_schedules.id',"=",'student_exams.exam_schedule_id')

        ->where('student_exams.exam_schedule_id',$scheId[0]->id)
        ->select(
            'exam_schedules.date',
            'exam_schedules.start_time',
            'exam_schedules.end_time',
            'subjects.code',
            'subjects.name',
            'exam_types.exam_type',
            'exams.year',
            'exams.month',
            'exam_schedules.updated_at',
            'exam_schedules.id'
        );
        array_push
        ($ar,
           array(
             "NotAB"=>$data->where('student_exams.status','OK')->count(),
             "RegStu"=>$data->count(),
             "details"=>$data->select
             ('subjects.name',
             'subjects.code',
             'subjects.id',
             'exams.year',
             'exam_schedules.date',
             'student_exams.updated_at')->first(),


           )
           );
        }
        return $ar;
    }
}
