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

   function subjectresult($id,$year=0,$month=''){
    $ar=array();
       if($year==0){

           $year=idate('Y');


       }
       if($month==''){
        $month=date("F", mktime(0, 0, 0, 0, 10));
        echo $month;
       }
   $sheduleIds=DB::table('exam_schedules')
    ->join('subjects','exam_schedules.subject_id',"=",'subjects.id')
    //->join('student_exams','exam_schedules.id',"=",'student_exams.exam_schedule_id')
    // ->join('students','student_exams.student_id',"=",'students.id')
     ->join('exams','exam_schedules.exam_id',"=",'exams.id')
     ->join('exam_types',"exam_schedules.exam_type_id","=",'exam_types.id')
    ->where('subjects.id',$id)
    ->where('exams.year',$year)
     ->where('exams.month',$month)
    ->select(
        'subjects.name',
        'subjects.code',
        // 'student_exams.result',
        // 'student_exams.mark',
        'exam_schedules.date',  
         'exams.year',
         'exams.month',
         'exam_schedules.id',
         'exam_types.name'
    )->get();
   $idcount=$sheduleIds->count();
   for ($i=0; $i<$idcount; $i++) { 
    $data=DB::table('exam_schedules')
    ->join('subjects','exam_schedules.subject_id',"=",'subjects.id')
    ->join('student_exams','exam_schedules.id',"=",'student_exams.exam_schedule_id')
     ->join('students','student_exams.student_id',"=",'students.id')
     ->join('exams','exam_schedules.exam_id',"=",'exams.id')
    ->where('subjects.id',$id)
    ->where('exams.year',$year)
     ->where('exams.month',$month)
     ->where('student_exams.exam_schedule_id',$sheduleIds[$i]->id)
     ->select(
        'subjects.name',
        'subjects.code',
        'student_exams.result',
        'student_exams.mark',
        'exam_schedules.date',  
         'exams.year',
         'exams.month',
         'exam_schedules.id'
    );
    // ->whrere('student_exams.exam_schedule_id',$sheduleIds[$i]->id)
    array_push
    ($ar,
       array(
    
        "Shedule ID"=>$sheduleIds[$i]->id,
        "typeName"=>$sheduleIds[$i]->name,
         "NotAB"=>$data->where('student_exams.status','OK')->count(),
         "RegStu"=>$data->count(),

         "Pass"=>$data->where('student_exams.result','>',0)->orderBy('exams.month')->count(),
         "fail"=>$data->where('student_exams.result','<',1)->count(),


       )
       );
   }
   
    // $absent=$data->where('student_exams.status','OK')->count();
    //  $co=$data  ->count();
    //  $pass=$data->where('student_exams.result','>',0)->orderBy('exams.month')->count();
    //  $fail=$data->where('student_exams.result','<',1)->count();

    return
            $ar;
     




}
}
