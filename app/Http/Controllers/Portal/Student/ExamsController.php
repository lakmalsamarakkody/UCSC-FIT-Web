<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use App\Models\Support\Fee;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    $schedule=Schedule::orderby('date')->take(6)->get();
    $exams_to_apply = Fee::where('purpose', 'exam')->get();
    $exams = Exam::where('year', '>=', $today->year)->where('month', '>=', $today->month)->get();
    
    return view('portal/student/exams',[
      'schedule' => $schedule,
      'exams' =>$exams,
      'exams_to_apply' => $exams_to_apply
    ]);
  }
}
