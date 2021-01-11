<?php

namespace App\Http\Controllers\Portal\Staff\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student\Registration;
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
        return view('portal/staff/student/application/applications', compact('applications'));
    }

    public function applicantInfo(Request $request)
    {
        $student = Student::find($request->student_id)->first();
        $registration = $student->registration()->first();
        return response()->json(['status'=>'success', 'student'=>$student , 'registration'=>$registration]);
        
    }
}
