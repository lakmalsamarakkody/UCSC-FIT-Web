<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Student\hasExam;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Exam\Schedule;

class ResultsController extends Controller
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
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $student = Student::where('user_id',Auth::user()->id)->first();
    // $exams = hasExam::where('student_id', $student->id)->where('exam_schedule_id', '!=' , null)->get();
    $exams = hasExam::where('student_id', $student->id)->join('exam_schedules', 'student_exams.exam_schedule_id', '=', 'exam_schedules.id')->groupBy('exam_id')->select('exam_id')->get();
    return view('portal/student/results', compact('exams'));
  }
}
