<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam\Duration;
use App\Models\Exam\Schedule;
use App\Models\Subject;
use App\Models\Exam\Types;
use App\Models\Student;
use App\Models\Lab;
use App\Models\Student\hasExam;
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
        // var_dump($today->month);
        // exit;
        // $exam_schedules=Schedule::where('date', '<', $today)->orderBy('date','desc');
        $subjects=Subject::orderBy('id')->get();
        $exam_types=Types::orderBy('id')->get();
        $labs = Lab::where('status', 'Active')->orderBy('id')->get();

        $next_years_exams = Exam::where('year', '>', $today->year);
        $upcoming_exams = Exam::where('year', $today->year)->where('month', '>=', $today->month)->union($next_years_exams)->orderBy('year', 'asc')->orderBy('month', 'asc')->get();
        $previous_year_exams = Exam::where('year', '<', $today->year);
        $search_exams = Exam::where('year', $today->year)->where('month', '<=', $today->month)->union($previous_year_exams)->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

        $years = Exam::select('year')->where('year', '<=', $today->year)->orderBy('year','desc')->distinct()->get();
        // $upcoming_schedules = Schedule::where('date', '>=',$today)->orderBy('date','asc')->get();
        //$released_upcoming_scheduless = Schedule::where('date', '>=', $today)->orderBy('date', 'asc')->paginate(5,['*'],'released_schedule');
        // return view('portal/staff/exams',compact('exam_schedules','subjects','exam_types', 'upcoming_exams', 'search_exams', 'years', 'upcoming_schedules'));
        return view('portal/staff/exams',compact('subjects','exam_types', 'labs','upcoming_exams', 'search_exams', 'years'));
    }

    // SCHEDULES TABLE(BEFORE RELEASE)
    public function getSchedulesBeforeRelease(Request $request)
    {
        $today = Carbon::today();
        if($request->ajax()) {
            $data = Schedule::where('date', '>=' , $today)->addSelect([
                //'exam' => Exam::select(DB::raw("CONCAT(month,' ', year) AS examname"))->whereColumn('exam_id', 'exams.id'),
                'month' => Exam::select(DB::raw("MONTHNAME(CONCAT(year,'-',month,'-01')) as monthname"))->whereColumn('exam_id', 'exams.id'),
                'year' => Exam::select('year')->whereColumn('exam_id', 'exams.id'),
                'subject_code' => Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
                'subject_name' => Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
                'exam_type' => Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')
            ])->where('schedule_release', false);
            
            return DataTables::of($data)
            ->editColumn('start_time', function($data){ $start_time = Carbon::createFromFormat('H:i:s', $data->start_time)->isoFormat('hh:mm A'); return $start_time; })
            ->editColumn('end_time', function($data){ $end_time = Carbon::createFromFormat('H:i:s', $data->end_time)->isoFormat('hh:mm A'); return $end_time; })
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
                //'exam' => Exam::select(DB::raw("CONCAT(month, ' ', year) AS examname"))->whereColumn('exam_id', 'exams.id'),
                'month' => Exam::select(DB::raw("MONTHNAME(CONCAT(year,'-',month,'-01')) as monthname"))->whereColumn('exam_id', 'exams.id'),
                'year' => Exam::select('year')->whereColumn('exam_id', 'exams.id'),
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
            ->editColumn('start_time', function($data){ $start_time = Carbon::createFromFormat('H:i:s', $data->start_time)->isoFormat('hh:mm A'); return $start_time; })
            ->editColumn('end_time', function($data){ $end_time = Carbon::createFromFormat('H:i:s', $data->end_time)->isoFormat('hh:mm A'); return $end_time; })
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
            $data = Schedule::where('date', '<', $today)->addSelect([
                //'exam' => Exam::select(DB::raw("CONCAT(month, ' ', year) AS examname"))->whereColumn('exam_id','exams.id'),
                'year' => Exam::select('year')->whereColumn('exam_id', 'exams.id'),
                'month' => Exam::select(DB::raw("MONTHNAME(CONCAT(year,'-',month,'-01')) as monthname"))->whereColumn('exam_id', 'exams.id'),
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
            endif;
            $data = $data->get();
            return DataTables::of($data)
            ->editColumn('start_time', function($data){ $start_time = Carbon::createFromFormat('H:i:s', $data->start_time)->isoFormat('hh:mm A'); return $start_time; })
            ->editColumn('end_time', function($data){ $end_time = Carbon::createFromFormat('H:i:s', $data->end_time)->isoFormat('hh:mm A'); return $end_time; })
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
            'scheduleLab' =>['required', 'exists:App\Models\Lab,id' ]
        ]);
    
        //Check validation errors
        if($exam_schedule_validator->fails()):
            return response()->json(['errors'=>$exam_schedule_validator->errors()]);
        else:
            //Check if the exact schedule is in the table
            $selected_lab = Lab::where('id', $request->scheduleLab)->first();
            $exists_schedule = Schedule::where('date',$request->scheduleDate)->where('end_time', '>', $request->scheduleStartTime)->where('lab', $selected_lab->name)->first();
            if($exists_schedule != null):
                return response()->json(['status'=>'exist', 'msg'=>'Exam schedule already exists.']);
            endif;

            // Check if the schedule date is in same month as exam
            $exam = Exam::where('id', $request->scheduleExam)->first();
            $exam_date = Carbon::createFromDate($exam->year,$exam->month,1);
            $schedule_date = Carbon::createFromDate($request->scheduleDate);
            // if(!$schedule_date->isSameMonth($exam_date)):
            //     return response()->json(['status'=>'date_error', 'msg'=>'Exam schedule date not in selected exam month. Please select suitable schedule date.']);
            // endif;

            $exam_schedule = new Schedule();
            $exam_schedule->exam_id = $request->scheduleExam;
            $exam_schedule->subject_id = $request->scheduleSubject;
            $exam_schedule->exam_type_id = $request->scheduleExamType;
            $exam_schedule->date = $request->scheduleDate;
            $exam_schedule->start_time = $request->scheduleStartTime;
            $exam_schedule->lab = $selected_lab->name;
            $exam_schedule->lab_capacity = $selected_lab->capacity;
            $exam_schedule->schedule_approval = 'requested';

            //SET EXAM END TIME
            $examDuration = Duration::where('subject_id', $request->scheduleSubject)->where('exam_type_id', $request->scheduleExamType)->first();
            if($examDuration != NULL):
                $examDurationHours = $examDuration->hours;
                $examDurationMinutes = $examDuration->minutes;
            else:
                $examDurationHours = '2';
                $examDurationMinutes = '0';
            endif;
            $exam_schedule->end_time = Carbon::parse($request->scheduleStartTime)->addHours($examDurationHours)->addMinutes($examDurationMinutes);

            //Check if data save to db
            if($exam_schedule->save()):
                return response()->json(['status'=>'success', 'exam_schedule'=>$exam_schedule]);
            endif;
        endif;
        return response()->json(['status'=>'error', 'msg'=>'Exam schedule creation process failed.']);
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
                $scheduled_lab_id = Lab::where('name', $schedule->lab)->first()->id;
                return response()->json(['status'=>'success', 'schedule'=>$schedule, 'scheduled_lab_id'=>$scheduled_lab_id]);
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
            'editScheduleLab'=> ['required', 'exists:App\Models\Lab,id'],
            'editScheduleLabCapacity'=> ['required', 'integer']
        ]);

        //Check validator fails
        if($edit_schedule_validator->fails()):
            return response()->json(['status'=>'error', 'errors'=>$edit_schedule_validator->errors()]);
        else:
            //Check if the exact schedule is in the table
            $scheduled_lab = Lab::where('id', $request->editScheduleLab)->first();
            $exists_schedule = Schedule::where('id', '!=', $request->editScheduleId)->where('date',$request->editScheduleExamDate)->where('end_time', '>', $request->editScheduleStartTime)->where('lab', $scheduled_lab->name)->first();
            if($exists_schedule != null):
                return response()->json(['status'=>'exist', 'msg'=>'Another schedule already exists in this time period.']);
            endif;

            // Check if the schedule date is in same month as exam
            $exam = Exam::where('id', $request->editScheduleExam)->first();
            $exam_date = Carbon::createFromDate($exam->year,$exam->month,1);
            $schedule_date = Carbon::createFromDate($request->editScheduleExamDate);
            // if(!$schedule_date->isSameMonth($exam_date)):
            //     return response()->json(['status'=>'date_error', 'msg'=>'Exam schedule date not in selected exam month. Please select suitable schedule date.']);
            // endif;

            if(Schedule::where('id',$request->editScheduleId)->update([
                'exam_id' => $request->editScheduleExam,
                'subject_id' => $request->editScheduleSubject,
                'exam_type_id' => $request->editScheduleExamType,
                'date' => $request->editScheduleExamDate,
                'start_time' => $request->editScheduleStartTime,
                'end_time' => $request->editScheduleEndTime,
                'lab' => $scheduled_lab->name,
                'lab_capacity'=> $request->editScheduleLabCapacity
            ])):
                return response()->json(['status'=>'success']);
            endif;
        endif;
        return response()->json(['status'=>'error', 'msg'=>'Exam schedule updating process failed.']);
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
                'schedule_approval' => 'declined',
                'declined_message' => $request->message,
            ])):
            return response()->json(['status'=>'success']);
            endif;
        endif;
    }
    // /DECLINE SCHEDULE

    // GET SCHEDULE DECLINED MESSAGE
    public function getScheduleDeclinedMessage(Request $request)
    {
        // Validate schedule id
        $schedule_id_validator = Validator::make($request->all(), [
            'schedule_id' => ['required', 'integer', 'exists:App\Models\Exam\Schedule,id'],
        ]);

        // Check validator fails
        if($schedule_id_validator->fails()):
            return response()->json(['status'=>'errors']);
        else:
            if($schedule = Schedule::find($request->schedule_id)):
                return response()->json(['status'=>'success', 'schedule'=>$schedule]);
            endif;
        endif;
        return response()->json(['status'=>'error', 'data'=>$request->all()]);
    }
    // /GET SCHEDULE DECLINED MESSAGE

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

    // RELEASE ALL APPROVED SCHEDULES
    public function releaseAllSchedules(Request $request)
    {
        if($request->ajax()) {
            $today = Carbon::today();
            $approved_schedules = Schedule::where('date', '>=', $today)->where('schedule_approval', 'approved')->where('schedule_release', false)->get();
            foreach($approved_schedules as $schedule):
                Schedule::where('id',$schedule->id)->update(['schedule_release'=> true]);
            endforeach;
            return response()->json(['status' => 'success']);
        }
    }
    // /RELEASE ALL APPROVED SCHEDULES

    // ASSIGNED STUDENTS OF A SCHEDULE
    public function getScheduleDetails(Request $request)
    {
        $schedule = Schedule::where('id', $request->schedule_id)->addSelect([
                'month' => Exam::select(DB::raw("MONTHNAME(CONCAT(year,'-',month,'-01')) as monthname"))->whereColumn('exam_id', 'exams.id'),
                'year' => Exam::select('year')->whereColumn('exam_id', 'exams.id'),
                'subject_code' => Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
                'subject_name' => Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
                'exam_type' => Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')
        ])->first();
        $start_time = \Carbon\Carbon::parse($schedule->start_time)->format('h:i A');
        $end_time = \Carbon\Carbon::parse($schedule->end_time)->format('h:i A');
        return response()->json(['status'=>'success', 'schedule'=>$schedule, 'start_time'=>$start_time, 'end_time'=>$end_time]);
    }

    // STUDENTS TABLE
    public function getAssignedStudents(Request $request)
    {
        if($request->ajax()):
            $data = hasExam::where('exam_schedule_id', $request->schedule_id)->addSelect([
                'student_name'=> Student::select('full_name')->whereColumn('student_id', 'students.id'),
                'reg_no'=> Student::select('reg_no')->whereColumn('student_id', 'students.id'),
                'nic_old'=> Student::select('nic_old')->whereColumn('student_id', 'students.id'),
                'nic_new'=> Student::select('nic_new')->whereColumn('student_id', 'students.id'),
                'postal'=> Student::select('postal')->whereColumn('student_id', 'students.id'),
                'passport'=> Student::select('passport')->whereColumn('student_id', 'students.id'),
                'schedule_date' => Schedule::select('date')->whereColumn('exam_schedule_id', 'exam_schedules.id')
            ])->get();
            return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
        endif;
    }
    // /STUDENTS TABLE

    // DESCHEDULE STUDENT
    public function descheduleStudent(Request $request)
    {
        $student_exam = hasExam::where('id', $request->id)->first();
        if($student_exam->update(['exam_schedule_id'=> null, 'schedule_status'=>'Pending'])):
            return response()->json(['status'=>'success']);
        endif;
        return response()->json(['status'=>'errors']);

    }
    // /DESCHEDULE STUDENT
    // /ASSIGNED STUDENTS OF A SCHEDULE

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
                $Exam = $schedule->exam->year." ". Carbon::createFromDate($schedule->exam->year,$schedule->exam->month)->monthName;
                $subjectCode = $schedule->subject->code;
                $subjectName = $schedule->subject->name;
                $examType = $schedule->type->name;
                $title = $Exam." / ".$subjectName." (FIT-".$subjectCode.") / ".$examType;
                $scheduled_lab_id = Lab::where('name', $schedule->lab)->first()->id;
                return response()->json(['status'=> 'success', 'schedule'=> $schedule, 'title'=> $title, 'scheduled_lab_id'=>$scheduled_lab_id]);
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
            'postponeExam'=>['required', 'integer', 'exists:exams,id'],
            'postponeExamDate'=> ['required', 'date', 'after: today'],
            'postponeExamStartTime'=> ['required'],
            'postponeExamEndTime'=> ['required'],
            'postponeExamLab'=> ['required', 'exists:App\Models\Lab,id']
        ]);

        // Check validator fails
        if($postpone_exam_validator->fails()):
            return response()->json(['status'=>'errors', 'errors'=>$postpone_exam_validator->errors()]);
        else:
            // Check if the schedule is already exists
            $scheduled_lab = Lab::where('id', $request->postponeExamLab)->first();
            $exists_schedule = Schedule::where('date',$request->postponeExamDate)->where('end_time', '>', $request->postponeExamStartTime)
            ->where('lab', $scheduled_lab->name)->first();
            if($exists_schedule != null):
                return response()->json(['status'=>'exist', 'msg'=>'Another schedule already exists in this time period.']);
            endif;

            // Check if the schedule date is in same month as exam
            $exam = Exam::where('id', $request->postponeExam)->first();
            $exam_date = Carbon::createFromDate($exam->year,$exam->month,1);
            $schedule_date = Carbon::createFromDate($request->postponeExamDate);
            // if(!$schedule_date->isSameMonth($exam_date)):
            //     return response()->json(['status'=>'date_error', 'msg'=>'Exam schedule date not in selected exam month. Please select suitable schedule date.']);
            // endif;

            
            if(Schedule::where('id', $request->postponeScheduleId)->update([
                'exam_id'=>$request->postponeExam,
                'date' => $request->postponeExamDate,
                'start_time' => $request->postponeExamStartTime,
                'end_time' => $request->postponeExamEndTime,
                'lab' => $scheduled_lab->name,
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
}
