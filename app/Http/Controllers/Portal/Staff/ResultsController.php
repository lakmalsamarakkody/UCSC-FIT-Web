<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Student_Exam;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use App\Models\Student\hasExam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;
use Yajra\DataTables\Facades\DataTables;

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

        $years = Exam::select('year')->groupBy('year')->get();
        $months = Exam::select('month')->groupBy('month')->get();
        return view('portal/staff/results',compact('years','months'));
    }

    public function getExamList(Request $request)
    {
        if ($request->ajax()) {
            $data = Exam::orderby('id', 'asc');

            if($request->year!=null){
                $data = $data->where('year', $request->year);
            }            
            if($request->month!=null){
                $data = $data->where('month', $request->month);
            }
            $data = $data->get();
            return DataTables::of($data)
            ->editColumn('month', function ($data) {
                return $data->month ? with(Carbon::createFromDate($data->year,$data->month)->monthName) : '';
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function viewResults($id)
    {
        $schedules=Schedule::where('exam_id',$id)->get();

        
        $schedule_ids = array();
        foreach($schedules as $schedule){
            $schedule_ids [] = $schedule->id;
        }
        // $results = hasExam::whereIn('exam_schedule_id',$schedule_ids)->groupBy('student_id')->dd();
        $students = hasExam::whereIn('exam_schedule_id',$schedule_ids)->distinct()->select('student_id')->get();
        // $results = collect($results);
        // $results=$results->groupBy('student_id');
        // Log::debug($results);
        // foreach($results as $result){
        //     echo $result;
        // }
        // echo $results;
        return view('portal/staff/result/view', compact('students', 'schedule_ids'));
    }
}
