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
use Illuminate\Support\Facades\Auth;
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
        $today = Carbon::today();
        $exam_schedules=Schedule::where('date', '<', $today)->orderBy('date','desc');
        $subjects=Subject::orderBy('id')->get();
        $exam_types=Types::orderBy('id')->get();
        $schedule_exams = Exam::where('year', '>=', $today->year)->orderBy('year', 'asc')->get();
        $search_exams = Exam::where('year', '<=', $today->year)->orderBy('year','desc')->get();
        $years = Exam::select('year')->where('year', '<=', $today->year)->orderBy('year','asc')->distinct()->get();
        $upcoming_schedules = Schedule::where('date', '>=',$today)->orderBy('date','asc')->get();
        //$released_upcoming_scheduless = Schedule::where('date', '>=', $today)->orderBy('date', 'asc')->paginate(5,['*'],'released_schedule');

        return view('portal/staff/exams',compact('exam_schedules','subjects','exam_types', 'schedule_exams', 'search_exams', 'years', 'upcoming_schedules'));
    }

    // SCHEDULES TABLE(BEFORE RELEASE)
    public function getSchedulesBeforeRelease(Request $request)
    {
        $today = Carbon::today();
        if($request->ajax()) {
            $data = Schedule::where('date', '>=' , $today)->addSelect([
                'exam' => Exam::select(DB::raw("CONCAT(month,' ', year) AS examname"))->whereColumn('exam_id', 'exams.id'),
                'subject_code' => Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
                'subject_name' => Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
                'exam_type' => Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')
            ])->where('schedule_release', false);
            // if(Auth::user()->role->name == 'Co-Ordinator'):
            //     $data = $data->where('schedule_approval', 'requested')->where('schedule_release', false);
            // elseif(Auth::user()->role->name == 'MA'):
            //     $data = $data->where('schedule_approval', null)->where(function ($query){
            //         $query->where('schedule_release', false);
            //     })->orWhere('schedule_approval', 'approve')->where(function ($query) {
            //         $query->where('schedule_release', false);
            //     });
            // else:
            //     $data = $data;
            // endif;
            return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
        }
    }
    // /SCHEDULES TABLE(BEFORE RELEASE)

    // SCHEDULES TABLE(AFTER RELEASE)
    public function getSchedulesAfterRelease(Request $request)
    {
        $today = Carbon::today();
        if($request->ajax()) {
            $data = Schedule::where('date', '>=' , $today)->addSelect([
                'exam' => Exam::select(DB::raw("CONCAT(month, ' ', year) AS examname"))->whereColumn('exam_id', 'exams.id'),
                'subject_code' => Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
                'subject_name' => Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
                'exam_type' => Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')
            ])->where('schedule_approval', 'approved')->where('schedule_release', true);
            // if(Auth::user()->role->name == 'MA'):
            //     $data = $data->where('schedule_approval', 'approve')->where('schedule_release', true);
            // elseif(Auth::user()->role->name == 'Co-Ordinator'):
            //     $data = $data->where('schedule_approval', 'approve')->where('schedule_release', true);
            // else:
            //     $data = $data;
            // endif;
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
                'exam' => Exam::select(DB::raw("CONCAT(month, ' ', year) AS examname"))->whereColumn('exam_id','exams.id'),
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
                $data = $data->get();
            endif;
            return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
        endif;
    }
    // /EXAMS TABLE(HELD)

    // SCHEDULE(Before release)
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
    // /CREATE

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
            if(Schedule::where('id',$request->editScheduleId)->update([
                'exam_id' => $request->editScheduleExam,
                'subject_id' => $request->editScheduleSubject,
                'exam_type_id' => $request->editScheduleExamType,
                'date' => $request->editScheduleExamDate,
                'start_time' => $request->editScheduleStartTime,
                'end_time' => $request->editScheduleEndTime
            ])):
                return response()->json(['status'=>'success']);
            endif;
        endif;
    }
    // /EDIT

    // DELETE
    public function deleteExamSchedule(Request $request)
    {
        // Validate schedule id
        $schedule_id_validator = Validator::make($request->all(), [
            'schedule_id' => ['required', 'integer', 'exists:App\Models\Exam\Schedule,id'],
        ]);

        // Check validator fails
        if($schedule_id_validator->fails()):
            return response()->json(['status'=>'errors']);
        else:
            if(Schedule::destroy($request->schedule_id)):
                return response()->json(['status'=>'success']);
            endif;
        endif;
        return response()->json(['status'=>'error', 'data'=>$request->all()]);
            
    }
    // /DELETE
    // /SCHEDULE(Before release)

    // REQUEST APPROVAL
    public function requestScheduleApproval(Request $request)
    {
        // Validate schedule id
        $schedule_id_validator = Validator::make($request->all(), [
            'schedule_id' => ['required', 'integer', 'exists:App\Models\Exam\Schedule,id'],
        ]);

        // Check validator fails
        if($schedule_id_validator->fails()):
            return response()->json(['status'=>'errors']);
        else:
            $schedule = Schedule::where('id', $request->schedule_id)->first();
            if($schedule->schedule_approval == 'requested'):
                return response()->json(['status'=>'requested']);
            else:
                if(Schedule::where('id', $request->schedule_id)->update([
                    'schedule_approval' => 'requested'
                ])):
                return response()->json(['status'=>'success']);
                endif;
            endif;
         endif;
    }
    // /REQUEST APPROVAL

    // APPROVE SCHEDULE
    public function approveSchedule(Request $request)
    {
        // Validate schedule id
        $schedule_id_validator = Validator::make($request->all(), [
            'schedule_id' => ['required', 'integer', 'exists:App\Models\Exam\Schedule,id'],
        ]);

        // Check validator fails
        if($schedule_id_validator->fails()):
            return response()->json(['status'=>'errors']);
        else:
            if(Schedule::where('id', $request->schedule_id)->update([
                'schedule_approval' => 'approved'
            ])):
            return response()->json(['status'=>'success']);
            endif;
        endif;
    }
    // /APPROVE SCHEDULE

    // DECLINE SCHEDULE
    public function declineSchedule(Request $request)
    {
        // Validate schedule id
        $schedule_id_validator = Validator::make($request->all(), [
            'schedule_id' => ['required', 'integer', 'exists:App\Models\Exam\Schedule,id'],
        ]);

        // Check validator fails
        if($schedule_id_validator->fails()):
            return response()->json(['status'=>'errors']);
        else:
            if(Schedule::where('id', $request->schedule_id)->update([
                'schedule_approval' => 'declined'
            ])):
            return response()->json(['status'=>'success']);
            endif;
        endif;
    }
    // /DECLINE SCHEDULE

    // RELEASE INDIVIDUAL SCHEDULE
    public function releaseIndividualSchedule(Request $request)
    {
        // Validate schedule id
        $schedule_id_validator = Validator::make($request->all(), [
            'schedule_id' => ['required', 'integer', 'exists:exam_schedules,id'],
        ]);

        // Check validator fails
        if($schedule_id_validator->fails()):
            return response()->json(['status'=>'errors']);
        else:
            $schedule = Schedule::where('id',$request->schedule_id)->first();
            if($schedule->schedule_approval != 'approved'):
                return response()->json(['status'=>'decline']);
            else:
                if(Schedule::where('id', $request->schedule_id)->update([
                'schedule_release' => true 
            ])):
            return response()->json(['status'=>'success']);
                endif;
            endif;
        endif;
    }
    // /RELEASE INDIVIDUAL SCHEDULE

    // SCHEDULE(After release)
    // POSTPONE
    // Load schedule details to modal
    public function postponeScheduleGetDetails(Request $request)
    {
        // Validate schedule id
        $schedule_id_validator = Validator::make($request->all(), [
            'schedule_id' => ['required', 'integer', 'exists:App\Models\Exam\Schedule,id'],
        ]);

        // Check validator fails
        if($schedule_id_validator->fails()):
            return response()->json(['status'=>'error', 'errors'=>$schedule_id_validator->errors()]);
        else:
            if($schedule = Schedule::find($request->schedule_id)):
                $subject = $schedule->subject->name;
                return response()->json(['status'=> 'success', 'schedule'=> $schedule, 'subject'=> $subject]);
            endif;
        endif;
        return response()->json(['status'=>'error', 'data'=>$request->all()]);
    }
    // /Load schedule details to modal

    // Postpone exam
    public function postponeExam(Request $request)
    {
        // Validate form data
        $postpone_exam_validator = Validator::make($request->all(), [
            'postponeExamId'=> ['required', 'integer', 'exists:exam_schedules,id'],
            'postponeExamDate'=> ['required', 'date', 'after: today'],
            'postponeExamStartTime'=> ['required'],
            'postponeExamEndTime'=> ['required'],
        ]);

        // Check validator fails
        if($postpone_exam_validator->fails()):
            return response()->json(['status'=>'error', 'errors'=>$postpone_exam_validator->errors()]);
        else:
            if(Schedule::where('id', $request->postponeExamId)->update([
                'date' => $request->postponeExamDate,
                'start_time' => $request->postponeExamStartTime,
                'end_time' => $request->postponeExamEndTime
            ])):
            return response()->json(['status'=>'success']);
            endif;
        endif;
    }
    // /Postpone exam
    // /POSTPONE

    // DELETE
    public function deleteScheduleAfterRelease(Request $request)
    {
        // Validate schedule id
        $schedule_id_validator = Validator::make($request->all(), [
            'schedule_id' => ['required', 'integer', 'exists:exam_schedules,id'],
        ]);

        // Check validator fails
        if($schedule_id_validator->fails()):
            return response()->json(['status'=>'errors']);
        else:
            if(Schedule::destroy($request->schedule_id)):
                return response()->json(['status'=>'success']);
            endif;
        endif;
    }
    // /DELETE
    // /SCHEDULE(After release)
}
