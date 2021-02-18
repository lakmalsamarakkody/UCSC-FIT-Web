<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Support\Fee;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
    $student = Student::where('user_id',Auth::user()->id)->first();
    
    return view('portal/student/exams',[
      'schedule' => $schedule,
      'exams' =>$exams,
      'exams_to_apply' => $exams_to_apply,
      'student' => $student
    ]);
  }

  public function applyForExams(Request $request)
  {
    // Validate form data
    $apply_exam_validator = Validator::make($request->all(), [
      

    ]);
    return response()->json(['success']);
  }
}
