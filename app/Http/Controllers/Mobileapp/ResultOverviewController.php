<?php

namespace App\Http\Controllers\Mobileapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultOverviewController extends Controller
{

    function resultoverview($year=0){
        $ar=array();
        if($year==0 ){

            $year=idate('Y');
        }
        $subjectcount=DB::table('subjects')->count();
        for($i=1; $i<=$subjectcount; $i++){
            $idv=$i;
            $data=DB::table('exam_schedules')
            ->join('subjects','exam_schedules.subject_id',"=",'subjects.id')
            ->join('student_exams','exam_schedules.id',"=",'student_exams.exam_schedule_id')
            ->join('students','student_exams.student_id',"=",'students.id')
            ->join('exams','exam_schedules.exam_id',"=",'exams.id')

            ->where('exams.year',$year)
            ->where('subjects.id',$idv);

           array_push
           ($ar,
              array(
                "NotAB"=>$data->where('student_exams.status','OK')->count(),
                "RegStu"=>$data->count(),

                "Pass"=>$data->where('student_exams.result','>',0)->count(),
                "details"=>$data->select('subjects.name','subjects.code','subjects.id','exams.year')->first(),


              )
              );
              $idv=0;
        }

        return
            $ar;

    }
}
