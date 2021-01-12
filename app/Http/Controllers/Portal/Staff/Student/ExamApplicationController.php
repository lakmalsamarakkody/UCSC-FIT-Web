<?php

namespace App\Http\Controllers\Portal\Staff\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamApplicationController extends Controller
{
    public function index()
    {
        return view('portal/staff/student/exam_application');
    }
}
