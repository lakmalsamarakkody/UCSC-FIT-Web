<?php

namespace App\Http\Controllers\Portal\Staff\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Student\Payment;
use App\Models\Support\Bank;
use App\Models\Support\BankBranch;
use App\Models\Student\hasExam;
use App\Models\Exam\Types;
use App\Models\Subject;
use App\Models\Exam;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Exam\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamApplicationController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $exam_applicants = hasExam::get()->unique('student_id');
        $exams = Exam::where('year', '>=', $today->year)->where('month', '>=', $today->month)->orderBy('year', 'asc')->get();
        $applied_exams = hasExam::where('exam_schedule_id', '!=', null)->where('status', 'AB')->get();
        return view('portal/staff/student/exam_application', [
            'exam_applicants' => $exam_applicants,
            'applied_exams' => $applied_exams,
            'exams' => $exams
        ]);
    }
    // GET DETAILS FOR MODAL LOAD
    // LOAD EXAM APPLICATION VIEW MODAL
    public function getApplicantExamDetails(Request $request)
    {
        $today = Carbon::today();
        $student = Student::where('id',$request->student_id)->first();
        $student_applied_exams = hasExam::where('student_id',$request->student_id)->where('status', 'ab')->orWhere(function($query) {
            $query->where('status', 'scheduled');
        })->addSelect([
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id'),
            'requested_month'=> Exam::select(DB::raw("MONTHNAME(CONCAT(year, '-',month, '-01')) as monthname"))->whereColumn('requested_exam_id', 'exams.id'),
            'requested_year'=> Exam::select('year')->whereColumn('requested_exam_id', 'exams.id'),
            // 'schedule_date'=> Schedule::select('date')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
            // 'start_time'=>Schedule::select('start_time')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
            // 'end_time'=>Schedule::select('end_time')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
        ])->get();
        $submitted_date = hasExam::select('updated_at')->where('student_id', $request->student_id)->latest()->first();
        return response()->json(['status'=>'success', 'student_applied_exams'=>$student_applied_exams, 'submitted_date'=>$submitted_date, 'student'=>$student]);
    }
    // /LOAD EXAM APPLICATION VIEW MODAL

    // APPLIED EXAMS TABLE
    public function appliedExamsTable(Request $request)
    {
        $today = Carbon::today();
        $data = hasExam::where('student_id',$request->student_id)->where('status', 'ab')->orWhere(function($query) {
            $query->where('status', 'scheduled');
        })->addSelect([
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id'),
            'requested_exam'=> Exam::select(DB::raw("MONTHNAME(CONCAT(year, '-',month, '-01')) as monthname"))->whereColumn('requested_exam_id', 'exams.id'),
            // 'requested_year'=> Exam::select('year')->whereColumn('requested_exam_id', 'exams.id'),
            'schedule_date'=> Schedule::select('date')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
            'start_time'=>Schedule::select('start_time')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
            'end_time'=>Schedule::select('end_time')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
        ]);
        return DataTables::of($data)
        ->rawColumns(['action'])
        ->make(true);
    }
    // /APPLIED EXAMS TABLE

    // LOAD SCHEDULE THE EXAM MODAL
    public function getAppliedSubjectScheduleDetails(Request $request)
    {
        $today = Carbon::today();
        $applied_exam = hasExam::where('id',$request->applied_exam_id)->addSelect([
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id'),
            'requested_month'=> Exam::select(DB::raw("MONTHNAME(CONCAT(year, '-',month, '-01')) as monthname"))->whereColumn('requested_exam_id', 'exams.id'),
            'requested_year'=> Exam::select('year')->whereColumn('requested_exam_id', 'exams.id'),
        ])->first();
        $schedules = Schedule::where('subject_id',$applied_exam->subject_id)->where('exam_type_id',$applied_exam->exam_type_id)->where('date', '>=', $today)->addSelect([
            'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
        ])->get();
        return response()->json(['status'=>'success', 'schedules'=>$schedules, 'applied_exam'=>$applied_exam]);
    }
    // /LOAD SCHEDULE THE EXAM MODAL

    // SEARCH THE SCHEDULES BY EXAM
    public function searchSchedulesByExam(Request $request)
    {
        $today = Carbon::today();
        $applied_exam = hasExam::where('id',$request->applied_exam_id)->first();
        $searched_schedules = Schedule::where('subject_id',$applied_exam->subject_id)->where('exam_type_id',$applied_exam->exam_type_id)->where('date', '>=', $today)->where('exam_id',$request->exam_id)->addSelect([
            'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
        ])->get();
        return response()->json(['status'=> 'success', 'searched_schedules'=>$searched_schedules, 'applied_exam'=> $applied_exam]);
    }
    // SEARCH THE SCHEDULES BY EXAM
    // /GET DETAILS FOR MODALS LOAD

    // SCHEDULE APPLIED EXAM
    public function scheduleAppliedExam(Request $request)
    {
        if(hasExam::where('id', $request->applied_exam_id)->update([
            'exam_schedule_id'=> $request->schedule_id,
            'status'=> 'scheduled'
        ])):
        return response()->json(['status'=>'success']);
        else:
            return response()->json(['status'=>'error']);
        endif;
    }
    // /SCHEDULE APPLIED EXAM

    // APPROVE SCHEDULED EXAMS
    public function approveScheduledExams(Request $request)
    {
        $student = Student::where('reg_no', $request->student_regno)->first();
        $scheduled_exams = hasExam::where('student_id', $student->id)->where('exam_schedule_id', '!=', null)->where('status', 'scheduled')->get();
        if($scheduled_exams == null):
            return response()->json(['status'=>'none_scheduled']);
        else:
            foreach($scheduled_exams as $exam):
                hasExam::where('id', $exam->id)->update(['status'=>'approved']);
            endforeach;
            return response()->json(['status'=>'success']);
        endif;
        //dd($request->all());
    }
    // APPROVE SCHEDULED EXAMS


}
