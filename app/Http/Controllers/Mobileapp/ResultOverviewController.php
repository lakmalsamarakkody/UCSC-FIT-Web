<?php

namespace App\Http\Controllers\Mobileapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultOverviewController extends Controller
{
    function resultoverview($year=0){
        if($year==0 ){

            $year=idate('Y');
        }
        $data=DB::table('exam_schedules')
        ->join('subjects','exam_schedules.subject_id',"=",'subjects.id')
        ->join('student_exams','exam_schedules.id',"=",'student_exams.exam_schedule_id')
        ->join('students','student_exams.student_id',"=",'students.id')
        ->join('exams','exam_schedules.exam_id',"=",'exams.id')

        ->where('exams.year',$year)

        ->select(
            'subjects.name',
            'subjects.code',
            'student_exams.result',
            'student_exams.mark',
            'exam_schedules.date',
             'exams.year',
             'exams.month',
             'exam_schedules.id',
        );

        return [
            'sun.name'=>$data->where('subjects.id',1)
        ];
    }
}
