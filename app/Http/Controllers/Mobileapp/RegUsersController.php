<?php

namespace App\Http\Controllers\Mobileapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student\Flag;
use App\Models\Student_Registration\Academic_Year as Registed;
use Hamcrest\Core\HasToString;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Illuminate\Support\Facades\DB;
use function PHPSTORM_META\type;
use Carbon\Carbon;

class RegUsersController extends Controller
{
 
    function countRegUser($year=0,$month=''){
        $now = Carbon::now();
        if($year==0){

            $year=$now->year;
 
 
        }
        if($month==''){
          
            $month= $now->month;
        }
        $data=DB::table('students')
               ->join('student_registrations','students.id',"=",'student_registrations.student_id')
              ->whereYear('student_registrations.registered_at', $year)
              ->whereMonth('student_registrations.registered_at', $month)
              ->orderBy('updated_at', 'desc')
              ->select(
                  'students.reg_year',
                  'students.id',
                  'students.first_name',
                  'students.updated_at',
                  'student_registrations.registered_at',
                
              );
       
       return 
       [
            "yearReg"=>$data->count(),
            'Data'=>$data->first()
       ];


    }



    function activeStudents(){
        $data=DB::table('student_registrations')

        
        ->orderBy('updated_at', 'desc')
        ->join('students','student_registrations.student_id',"=",'students.id')
        ->select(
            'student_registrations.status',
            'students.first_name',
            'student_registrations.updated_at'

        );
        $users=DB::table('students')
        ->join('users','students.user_id',"=",'users.id')
        
        ->orderBy('updated_at', 'desc')
        ->select(
            'students.reg_year',
            'students.first_name',
            'students.updated_at'

        );


 return [

      "yearReg"=>$data->count(),
      "Pendiig"=>$users->count()-$users->where('users.status',1)->count(),
      "active"=>$data->where('student_registrations.status',1)->count(),
      "accActive"=>$users->where('users.status',1)->count(),
      "updateDate"=>$users->select('students.updated_at')->first(),


 ];

    }
}
