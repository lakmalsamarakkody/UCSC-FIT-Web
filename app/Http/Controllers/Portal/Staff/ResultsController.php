<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Student_Exam;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;

class ResultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('staff.auth');
    }
    
    public function index()
    {
        $exams = Exam::latest();
        $exams = $exams->paginate(10);
        $years = Exam::select('year')->groupBy('year')->get();
        $months = Exam::select('month')->groupBy('month')->get();
        return view('portal/staff/results',compact('exams','years','months'));
    }

    public function viewResults($id)
    {
        $schedules=Schedule::where('exam_id',$id)->get();
        $results = array();
        foreach($schedules as $schedule){
            $results[]=Student_Exam::where('exam_schedule_id',$schedule->id);
        }
        $results = collect($results);
        $results=$results->groupBy('student_id');
        Log::debug($results);
        return view('portal/staff/result/view', compact('results'));
    }
}
