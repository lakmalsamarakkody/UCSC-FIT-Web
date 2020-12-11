<?php

namespace App\Http\Controllers\Mobileapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student\Flag;
use App\Models\Student_Registration\Academic_Year;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class RegUsersController extends Controller
{
    function countRegUser(){

      $co= Academic_Year::count();

       return [
           "status"=>true,
            "count"=>$co,
       ];






    }
}
