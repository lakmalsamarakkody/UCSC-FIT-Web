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

class RegUsersController extends Controller
{
    function countRegUser(){
        $data=DB::table('students')
              ->where('students.reg_year',idate('Y'))
              ->orderBy('updated_at', 'desc')
              ->select(
                  'students.reg_year',
                  'students.first_name',
                  'students.updated_at'

              );


       return [
            "yearReg"=>$data->count(),
            'Data'=>$data->first(),

       ];






    }
    function activeStudents(){
        $data=DB::table('students')

        ->where('students.reg_year',idate('Y'))
        ->orderBy('updated_at', 'desc')
        ->select(
            'students.reg_year',
            'students.first_name',
            'students.updated_at'

        );
        $users=DB::table('students')
        ->join('users','students.user_id',"=",'users.id')
        ->where('students.reg_year',idate('Y'))
        ->orderBy('updated_at', 'desc')
        ->select(
            'students.reg_year',
            'students.first_name',
            'students.updated_at'

        );


 return [

      "yearReg"=>$data->count(),
      "Pendiig"=>$users->count()-$users->where('users.status',1)->count(),
      "active"=>$users->where('users.status',1)->count(),
      "updateDate"=>$users->select('users.updated_at')->first(),


 ];

    }
}
