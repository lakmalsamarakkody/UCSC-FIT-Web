<?php

namespace App\Http\Controllers\Portal\Staff\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Student\Payment;
use App\Models\Support\Bank;
use App\Models\Support\BankBranch;
use App\Models\Student\hasExam;
use Illuminate\Http\Request;

class ExamApplicationController extends Controller
{
    public function index()
    {
        
        $exam_applicants = hasExam::get()->unique('student_id');
        $applied_exams = hasExam::where('exam_schedule_id', '!=', null)->where('status', 'AB')->get();
        return view('portal/staff/student/exam_application', [
            'exam_applicants' => $exam_applicants,
            'applied_exams' => $applied_exams
        ]);
    }

    public function getApplicantExamDetails(Request $request)
    {
        $student_applied_exams = hasExam::where('student_id',$request->student_id)->where('exam_schedule_id', null)->where('status', 'AB')->get();
        return response()->json(['status'=>'success', 'student_applied_exams'=>$student_applied_exams]); 
        // dd($request->all());
    }
}
