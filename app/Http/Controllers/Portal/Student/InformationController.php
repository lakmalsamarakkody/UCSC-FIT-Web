<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InformationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('student.auth');
        $this->middleware('student.info.view');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // GET STUDENT DETAILS
        $student = Student::where('user_id', Auth::user()->id)->first();
        return view('portal/student/information', compact('student'));
    }

    // UPDATE QUALIFICATION
    public function updateQualification(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [     
                'qualification'=> ['required']
            ]
        );
        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()]);
        else:
            if(Student::where('user_id', Auth::user()->id)->update(['education'=>$request->qualification])):
                return response()->json(['success'=>'success']);
            endif;
        endif;
        return response()->json(['error'=>'error']);
    }
    // /UPDATE QUALIFICATION

}
