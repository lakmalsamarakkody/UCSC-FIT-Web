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

       if($year==0){

           $year=idate('Y');


       }
       if($month==''){
        $month=date("F", mktime(0, 0, 0, 0, 10));
        echo $month;
       }
   $data=DB::table('exam_schedules')
    ->join('subjects','exam_schedules.subject_id',"=",'subjects.id')
    ->join('student_exams','exam_schedules.id',"=",'student_exams.exam_schedule_id')
    ->join('students','student_exams.student_id',"=",'students.id')
    ->join('exams','exam_schedules.exam_id',"=",'exams.id')
    ->where('subjects.id',$id)
    ->where('exams.year',$year)
     ->where('exams.month',$month)
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

    $absent=$data->where('student_exams.status','OK')->count();
     $co=$data  ->count();
     $pass=$data->where('student_exams.result','>',0)->orderBy('exams.month')->count();
     $fail=$data->where('student_exams.result','<',1)->count();

//    $pa=0;
//    $average = array(
//             array(
//          'month' => 'January',
//          'all'=>$data->where( "exams.month", "August",)->get(),



//             ),



//         );
    //  for($i=0; $i<$co; $i++){
    //     $pass=$data->where('student_exams.result','1')->where( "exams.month", "October",)  ->get();
    //    switch($fullData[$i]->month){
    //            case "January":
    //             $pa=$data->where('student_exams.result','1')->where( "exams.month", "January",)  ->count();
    //            break;
    //            case "February":
    //             $pa=$data->where('student_exams.result','1')->where( "exams.month", "February",)  ->count();
    //            break;
    //            case 'March':
    //             $pa=$data->where('student_exams.result','1')->where( "exams.month", "March",)  ->count();
    //            break;
    //            case 'April':
    //             $pa=$data->where('student_exams.result','1')->where( "exams.month", "April",)  ->count();
    //            break;
    //            case 'May':
    //             $pa=$data->where('student_exams.result','1')->where( "exams.month", "May",)  ->count();
    //            break;
    //            case 'June':
    //             $pa=$data->where('student_exams.result','1')->where( "exams.month", "June",)  ->count();
    //            break;
    //            case 'July':
    //             $pa=$data->where('student_exams.result','1')->where( "exams.month", "July",)  ->count();
    //            break;
    //            case 'August':
    //             $pa=$data->where('student_exams.result','1')->where( "exams.month", "August",)  ->count();
    //            break;
    //            case 'September':
    //             $pa=$data->where('student_exams.result','1')->where( "exams.month", "September",)  ->count();
    //            break;
    //            case 'October':
    //             $pa=$data->where('student_exams.result','1')->where( "exams.month", "October",)  ->count();
    //            break;
    //            case 'November':
    //             $pa=$data->where('student_exams.result','1')->where( "exams.month", "November",)  ->count();
    //            break;
    //         //    case 'December':
    //         //     $pa=$data->where('student_exams.result','1')->where( "exams.month", "December",)  ->count();
    //         //    break;
    //    }
    //  }
    return

        [

            "Fail"=>$fail,
            "Pass"=>$pass,
            "Regstu"=>$co,
            "Ab"=>$absent

        ];





}
}
