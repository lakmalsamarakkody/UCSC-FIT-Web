<?php

namespace App\Http\Controllers\Portal\Staff\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student\Registration;
use App\Models\Support\SlCity;
use App\Models\Support\SlDistrict;
use App\Models\Support\WorldCity;
use App\Models\Support\WorldCountry;
use App\Models\Support\WorldDivision;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('staff.auth');
    }
    public function index()
    {
        $applications = Registration::where('registered_at', NULL)->where('application_submit', '1')->get();
        return view('portal/staff/student/applications', compact('applications'));
    }

    public function applicantInfo(Request $request)
    {
        $student = Student::find($request->student_id)->first();
        $registration = $student->registration()->first();
        $email = $student->user->email;
        
        //PERMANENT ADDRESS
        $permanentCountry = WorldCountry::where('id',$student->permanent_country_id)->first()->name;
        $permanentState = NULL;
        $permanentCity = NULL;
        //GET DIVISION OR DISTRICT
        if($student->permanent_state_id != NULL):
            if($student->permanent_country_id == 67):
                $permanentState = SlDistrict::find($student->permanent_state_id)->first()->name;
            else:
                $permanentState = WorldDivision::where('id',$student->permanent_state_id)->first()->name;
            endif;
        endif;

        //GET CITY
        if($student->permanent_city_id != NULL):
            if($student->permanent_country_id == 67):
                $permanentCity = SlCity::find($student->permanent_city_id)->first()->name;
            else:
                $permanentCity = WorldCity::where('id',$student->permanent_city_id)->first()->name;
            endif;
        endif;
        $permanentAddressDetails = array('permanentCountry'=>$permanentCountry, 'permanentState'=>$permanentState, 'permanentCity'=>$permanentCity);
        // /PERMANENT ADDRESS

        //CURRENT ADDRESS
        $currentCountry = NULL;
        $currentState = NULL;
        $currentCity = NULL;
        //GET COUNTRY
        if($student->current_country_id != NULL):
            $currentCountry = WorldCountry::where('id',$student->current_country_id)->first()->name;
        endif;
        //GET DIVISION OR DISTRICT
        if($student->current_state_id != NULL):
            if($student->current_country_id == 67):
                $currentState = SlDistrict::find($student->current_state_id)->first()->name;
            else:
                $currentState = WorldDivision::where('id',$student->current_state_id)->first()->name;
            endif;
        endif;

        //GET CITY
        if($student->current_city_id != NULL):
            if($student->current_country_id == 67):
                $currentCity = SlCity::find($student->current_city_id)->first()->name;
            else:
                $currentCity = WorldCity::where('id',$student->current_city_id)->first()->name;
            endif;
        endif;
        $currentAddressDetails = array('currentCountry'=>$currentCountry, 'currentState'=>$currentState, 'currentCity'=>$currentCity);
        // /CURRENT ADDRESS
        return response()->json(['status'=>'success', 'student'=>$student , 'registration'=>$registration, 'email'=>$email, 'permanentAddressDetails'=>$permanentAddressDetails, 'currentAddressDetails'=>$currentAddressDetails]);
        
    }
}
