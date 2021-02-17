<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use App\Models\Exam\Types;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ExamsController extends Controller
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
    $today = Carbon::today();
    $exams=Schedule::orderby('date')->take(6)->get();
    $exam_types = Types::orderBy('id')->get();
    $exam = Exam::where('year', '>=', $today->year)->where('month', '>=', $today->month)->get();
    
    return view('portal/student/exams',[
      'exams' => $exams,
      'exam_types' => $exam_types,
      'exam' =>$exam
    ]);
  }
}
