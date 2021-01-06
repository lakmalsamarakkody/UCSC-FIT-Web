<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use App\Models\Subject;
use App\Models\Exam\Types;
//use Dotenv\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ExamsController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('staff.auth');
    }
    
    public function index()
    {
        $exams=Schedule::orderby('date','desc')->take(6)->get();
        $subjects=Subject::orderby('id')->get();
        $exam_types=Types::orderby('id')->get();
        return view('portal/staff/exams',compact('exams','subjects','exam_types'));
    }

    public function getExamList(Request $request)
    {
        if ($request->ajax()) {
            $data = Schedule::latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> 
                <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['sction'])
            ->make(true);
        }
    }

    public function createSchedule(Request $request)
    {
        $schedule = new Schedule();
        $schedule->subject_id = request('subject');
        $schedule->exam_type_id = request('examType');
        $schedule->date = request('examDate');
        $schedule->start_time = request('startTime');


    }
    //View examList page
    public function examList()
    {
        $exams = Exam::orderBy('year','asc')->orderBy('month','asc')->get();
        return view('portal/staff/examList', compact('exams'));
    }
    
    //Create Exam
    public function createExam(Request $request)
    {
        //Validate form data
        $exam_validator = Validator::make($request->all(), [
            'examYear'=>['required', 'integer'],
            'examMonth'=>['required', 'alpha', Rule::in(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])],
        ]);

        //Check validator fails
        if($exam_validator->fails()):
            return response()->json(['status'=>'error', 'errors'=>$exam_validator->errors()]);
        else:
            $exam = new Exam();
            $exam->year = $request->examYear;
            $exam->month = $request->examMonth;
            if($exam->save()):
                return response()->json(['status'=>'success', 'exam'=>$exam]);
            endif;
        endif;
    }

    
}
