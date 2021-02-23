<?php

namespace App\Http\Controllers\Portal\Staff\Student;

use App\Http\Controllers\Controller;
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
        $applied_exams = hasExam::where('student_id', 1)->take(5)->get();
        return view('portal/staff/student/exam_application', [
            'applied_exams' => $applied_exams
        ]);
    }
}
