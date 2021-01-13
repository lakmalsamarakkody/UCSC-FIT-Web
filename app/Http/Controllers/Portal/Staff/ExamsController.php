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
use Illuminate\Support\Carbon;

class ExamsController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('staff.auth');
    }
    
    public function index(Request $request)
    {
        $exam_schedules=Schedule::orderby('date','desc');
        $subjects=Subject::orderby('id')->get();
        $exam_types=Types::orderby('id')->get();
        $exams = Exam::orderby('year')->get();
        $years = Exam::select('year')->distinct()->get();

        if ($request->selectSearchExamYear != 0) {
            $exam_schedules = $exam_schedules->whereYear('date', $request->selectSearchExamYear);
        }
        if ($request->selectSearchExam != 0) {
            $exam_schedules = $exam_schedules->where('exam_id', $request->selectSearchExam);
        }
        if($request->selectSearchExamDate != null) {
            $exam_schedules = $exam_schedules->where('date',$request->selectSearchExamDate);
        }
        if ($request->selectSearchExamType != 0) {
            $exam_schedules = $exam_schedules->where('exam_type_id', $request->selectSearchExamType);
        }
        if ($request->selectSearchSubject != 0) {
            $exam_schedules = $exam_schedules->where('subject_id', $request->selectSearchSubject);
        }

        $exam_schedules = $exam_schedules->paginate(6);
        return view('portal/staff/exams',compact('exam_schedules','subjects','exam_types', 'exams', 'years'));
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
    
    // SCHEDULE

    // CREATE
    public function createExamSchedule(Request $request)
    {
        //Validate form data
        $exam_schedule_validator = Validator::make($request->all(), [
            'scheduleExam' => ['required','exists:App\Models\Exam,id'],
            'scheduleSubject' => ['required','exists:App\Models\Subject,id'],
            'scheduleExamType' => ['required','exists:App\Models\Exam\Types,id'],
            'scheduleDate' => ['required', 'date', 'after:today'],
            'scheduleStartTime' => ['required'],
        ]);

        //Check validation errors
        if($exam_schedule_validator->fails()):
            return response()->json(['errors'=>$exam_schedule_validator->errors()]);
        else:
            $exam_schedule = new Schedule();
            $exam_schedule->exam_id = $request->scheduleExam;
            $exam_schedule->subject_id = $request->scheduleSubject;
            $exam_schedule->exam_type_id = $request->scheduleExamType;
            $exam_schedule->date = $request->scheduleDate;
            $exam_schedule->start_time = $request->scheduleStartTime;
            $exam_schedule->end_time = Carbon::parse($request->scheduleStartTime)->addHours('2');
            //Check if data save to db
            if($exam_schedule->save()):
                return response()->json(['status'=>'success', 'exam_schedule'=>$exam_schedule]);
            endif;
        endif;
        return response()->json(['status'=>'error']);
    }
    // CREATE

    // EDIT
    // Load schedule details to modal
    public function editScheduleGetDetails(Request $request)
    {
        //Validate schedule id
        $schedule_id_validator = Validator::make($request->all(), [
            'schedule_id'=> ['required', 'integer', 'exists:App\Models\Exam\Schedule,id'],
        ]);

        //Check validator fails
        if($schedule_id_validator->fails()):
            return response()->json(['status'=>'error', 'errors'=>$schedule_id_validator->errors()]);
        else:
            if($schedule = Schedule::find($request->schedule_id)):
                return response()->json(['status'=>'success', 'schedule'=>$schedule]);
            endif;
        endif;
        return response()->json(['status'=>'error', 'data'=>$request->all()]);
    }
    // /Load schedule details to modal

    public function editExamSchedule(Request $request)
    {
        //Validate edit fields
        $edit_schedule_validator = Validator::make($request->all(), [
            'editScheduleExam'=>['required', 'exists:App\Models\Exam,id'],
            'editScheduleId'=> ['required', 'integer', 'exists:App\Models\Exam\Schedule,id'],
            'editScheduleSubject'=> ['required', 'exists:App\Models\Subject,id'],
            'editScheduleExamType'=> ['required', 'exists:App\Models\Exam\Types,id'],
            'editScheduleExamDate'=> ['required', 'date', 'after:today'],
            'editScheduleStartTime'=> ['required'],
            'editScheduleEndTime'=> ['required'],
        ]);

        //Check validator fails
        if($edit_schedule_validator->fails()):
            return response()->json(['status'=>'error', 'errors'=>$edit_schedule_validator->errors()]);
        else:
            $schedule = Schedule::find($request->editScheduleId);
            $schedule->exam_id = $request->editScheduleExam;
            $schedule->subject_id = $request->editScheduleSubject;
            $schedule->exam_type_id = $request->editScheduleExamType;
            $schedule->date = $request->editScheduleExamDate;
            $schedule->start_time = $request->editScheduleStartTime;
            $schedule->end_time = $request->editScheduleEndTime;
            if($schedule->save()):
                return response()->json(['status'=>'success', 'schedule'=>$schedule]);
            endif;
        endif;
    }
    // /EDIT

    // DELETE
    public function deleteExamSchedule(Request $request)
    {
        //Validate schedule id
        $schedule_id_validator = Validator::make($request->all(), [
            'schedule_id' => ['required', 'integer', 'exists:App\Models\Exam\Schedule,id'],
        ]);

        //Check validator fails
        if($schedule_id_validator->fails()):
            return response()->json(['status'=>'error','errors'=>$schedule_id_validator->errors()]);
        else:
            if(Schedule::destroy($request->schedule_id)):
                return response()->json(['status'=>'success']);
            endif;
        endif;
        return response()->json(['status'=>'error', 'data'=>$request->all()]);
            
    }
    // /DELETE

    // /SCHEDULE
}
