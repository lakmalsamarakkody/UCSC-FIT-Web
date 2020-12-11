<?php

namespace App\Http\Controllers\Mobileapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student\Flag;
use App\Models\Student_Registration\Academic_Year as Registed;
use Hamcrest\Core\HasToString;
use Symfony\Component\Finder\Exception\AccessDeniedException;

use function PHPSTORM_META\type;

class RegUsersController extends Controller
{
    function countRegUser(){

      $co= Registed::count();
      $regCount=0;
    $data=Registed::all();
    $date1=date_create(date("Y-m-d"));
    $date2=date_create(date("Y-m-d"));
    $diff=date_diff($date1,$date2);

    for($i=0; $i<$co; $i++){

        $date3=($data[$i]->start) ;

          $date4=date_create($date3);

        $diff=date_diff($date4,$date1);
         $dayDiff=$diff->format("%R%a days");

         if($dayDiff<366){
                 $regCount++;
         }




        echo "\n";
    }

   // echo $diff->format("%R%a days");

       return [
           "status"=>true,
            "count"=>$regCount,
       ];






    }
}
