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
use Illuminate\Support\Facades\DB;

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
        // $request->validate([
        //     'selectSearchSubject' => 'integer',
        //     'selectSearchExamType' => 'integer'
        // ]);

        $today = Carbon::today();
        $exam_schedules=Schedule::where('date', '<', $today)->orderBy('date','desc');
        $subjects=Subject::orderBy('id')->get();
        $exam_types=Types::orderBy('id')->get();
        $schedule_exams = Exam::where('year', '>=', $today->year)->orderBy('year', 'asc')->get();
        $search_exams = Exam::where('year', '<=', $today->year)->orderBy('year','desc')->get();
        $years = Exam::select('year')->where('year', '<=', $today->year)->orderBy('year','asc')->distinct()->get();
        $upcoming_schedules = Schedule::where('date', '>=',$today)->orderBy('date','asc')->paginate(5,['*'], 'upcoming');
        //$released_upcoming_scheduless = Schedule::where('date', '>=', $today)->orderBy('date', 'asc')->paginate(5,['*'],'released_schedule');

        // if ($request->selectSearchExamYear != null) {
        //     $exam_schedules = $exam_schedules->whereYear('date', $request->selectSearchExamYear);
        // }
        // if ($request->selectSearchExam != null) {
        //     $exam_schedules = $exam_schedules->where('exam_id', $request->selectSearchExam);
        // }
        // if($request->selectSearchExamDate != null) {
        //     $exam_schedules = $exam_schedules->where('date', $request->selectSearchExamDate);
        // }
        // if ($request->selectSearchSubject != null) {
        //     $exam_schedules = $exam_schedules->where('subject_id', $request->selectSearchSubject);
        // }
        // if ($request->selectSearchExamType != null) {
        //     $exam_schedules = $exam_schedules->where('exam_type_id', $request->selectSearchExamType);
        // }
        //$exam_schedules = $exam_schedules->paginate(5,['*'], 'held');
        //$upcoming_schedules = $upcoming_schedules->paginate(5,['*'],'upcoming');
        //$exam_schedules = $exam_schedules->get();
        return view('portal/staff/exams',compact('exam_schedules','subjects','exam_types', 'schedule_exams', 'search_exams', 'years', 'upcoming_schedules'));
    }

    // SCHEDULES TABLE(BEFORE RELEASE)
    public function getSchedulesBeforeRelease(Request $request)
    {
        $today = Carbon::today();
        if($request->ajax()) {
            $data = Schedule::where('date', '>=' , $today)->addSelect([
                'exam' => Exam::select('year')->whereColumn('exam_id', 'exams.id'),
                'subject_code' => Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
                'subject_name' => Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
                'exam_type' => Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')
            ]);
            return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
        }
    }
    // SCHEDULES TABLE(BEFORE RELEASE)

    // SCHEDULES TABLE(AFTER RELEASE)
    public function getSchedulesAfterRelease(Request $request)
    {
        $today = Carbon::today();
        if($request->ajax()) {
            $data = Schedule::where('date', '>=' , $today)->addSelect([
                'exam' => Exam::select('year')->whereColumn('exam_id', 'exams.id'),
                'subject_code' => Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
                'subject_name' => Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
                'exam_type' => Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')
            ]);
            return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
        }
    }
    // /SCHEDULES TABLE(AFTER RELEASE)

    // EXAMS TABLE(HELD)
    public function getHeldExams(Request $request)
    {
        $today = Carbon::today();
        if ($request->ajax()):
            $data = Schedule::where('date', '<=', $today)->addSelect([
                'exam' => Exam::select('year')->whereColumn('exam_id','exams.id'),
                'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
                'subject_name'=> Subject::select('name')->whereColumn('subject_id','subjects.id'),
                'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')]);

            if($request->year != null || $request->exam != null || $request->date != null || $request->subject != null || $request->type != null):

                if($request->year != null):
                    $data = $data->whereYear('date', $request->year);
                endif;
                
                if($request->exam != null): 
                    $data = $data->where('exam_id',$request->exam);
                endif;
                if($request->date != null):
                    $data = $data->where('date', $request->date);
                endif;
                if($request->subject != null):
                    $data = $data->where('subject_id', $request->subject);
                endif;
                if($request->type != null):
                    $data = $data->where('exam_type_id', $request->type);
                endif;
                $data = $data->get();
            else:
                // $data = $data->orderByRaw('DATE_FORMAT(date, "%y-%m-%d")', 'asc')->take(15)->get();
                $data = $data->orderBy('id', 'desc')->take(15)->get();
            endif;
            return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
        endif;
    }
    // /EXAMS TABLE(HELD)

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

       $exists_schedule = Schedule::where('subject_id', $request->scheduleSubject)->where('exam_type_id', $request->scheduleExamType)
       ->where('date',$request->scheduleDate)->first();
        //Check if the exact schedule is in the table
        if($exists_schedule != null):
            $exists_schedule_validator = Validator::make($request->all(), [
                'schedule' => ['multicolumn_unique'],
            ]);
        endif;
    
        //Check validation errors
        if($exam_schedule_validator->fails()):
            return response()->json(['errors'=>$exam_schedule_validator->errors()]);
        elseif(isset($exists_schedule_validator) && $exists_schedule_validator->fails()):
            return response()->json(['errors'=>$exists_schedule_validator->errors()]);
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
