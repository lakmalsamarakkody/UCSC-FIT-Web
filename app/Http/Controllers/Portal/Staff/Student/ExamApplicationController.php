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
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Exam\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class ExamApplicationController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $exam_applicants = hasExam::get()->where('payment_id', '!=', null)->where('status', '!=', 'Approved')->unique('payment_id');
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
        $payment = Payment::where('id',$request->payment_id)->addSelect([
            'bank'=> Bank::select('name')->whereColumn('bank_id', 'banks.id'),
            'bank_branch'=> BankBranch::select('name')->whereColumn('bank_branch_id', 'bank_branches.id'),
            'bank_branch_code'=> BankBranch::select('code')->whereColumn('bank_branch_id', 'bank_branches.id'),
        ])->first();
        $student = Student::where('id', $payment->student_id)->first();
        $student_applied_exams = hasExam::where('payment_id', '!=', null)->where('payment_id',$request->payment_id)->where(function($query) {
            $query->where('status', 'Scheduled')->orWhere('status', 'AB');
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
        $submitted_date = Payment::select('created_at')->where('id', $request->payment_id)->latest()->first();
        return response()->json(['status'=>'success', 'student_applied_exams'=>$student_applied_exams, 'submitted_date'=>$submitted_date, 'student'=>$student, 'payment'=>$payment]);
    }
    // /LOAD EXAM APPLICATION VIEW MODAL

    // APPLIED EXAMS TABLE
    public function appliedExamsTable(Request $request)
    {
        $today = Carbon::today();
        $data = hasExam::where('payment_id', '!=', null)->where('payment_id',$request->payment_id)->where(function($query) {
            $query->where('status', 'Scheduled')->orWhere('status', 'AB');
        })->addSelect([
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id'),
            'requested_month'=> Exam::select(DB::raw("MONTHNAME(CONCAT(year, '-',month, '-01')) as monthname"))->whereColumn('requested_exam_id', 'exams.id'),
            'requested_year'=> Exam::select('year')->whereColumn('requested_exam_id', 'exams.id'),
            'schedule_date'=> Schedule::select('date')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
            'schedule_time'=> Schedule::select(DB::raw('CONCAT(start_time, end_time) as time'))->whereColumn('exam_schedule_id', 'exam_schedules.id'),
            'start_time'=>Schedule::select('start_time')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
            'end_time'=>Schedule::select('end_time')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
        ]);
        return DataTables::of($data)
        ->addColumn('requested_exam', function($row) {
            return $row->requested_year.' '.$row->requested_month;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    // /APPLIED EXAMS TABLE

    // APPROVE PAYMENT
    public function approveExamPayment(Request $request)
    {
        $applied_exams = hasExam::where('payment_id', '!=', null)->where('payment_id', $request->payment_id)->get();
        $payment = Payment::where('id', $request->payment_id)->first();
        if($payment->update(['status'=>'Approved'])):
            foreach($applied_exams as $exam):
                $exam->update(['payment_status'=>'Approved']);
            endforeach;
            return response()->json(['status'=>'success']);
        endif;
        return response()->json(['status'=>'error']);
    }
    // /APPROVE PAYMENT

    // DECLINE PAYMENT
    public function declineExamPayment(Request $request)
    {
        $applied_exams = hasExam::where('payment_id', '!=', null)->where('payment_id', $request->payment_id)->get();
        $payment = Payment::where('id', $request->payment_id)->first();
        if($payment->update(['status'=>'Declined'])):
            foreach($applied_exams as $exam):
                $exam->update(['payment_status'=>'Declined', 'declined_message'=>$request->message]);
            endforeach;
            return response()->json(['status'=>'success']);
        endif;
        return response()->json(['status'=>'error']);
    }
    // /DECLINE PAYMENT

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
        // $schedules = Schedule::where('subject_id',$applied_exam->subject_id)->where('exam_type_id',$applied_exam->exam_type_id)->where('date', '>=', $today)->addSelect([
        //     'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
        // ])->get();
        return response()->json(['status'=>'success', 'applied_exam'=>$applied_exam]);
    }
    // /LOAD SCHEDULE THE EXAM MODAL
    
    // SCHEDULES FOR APPLIED EXAM TABLE
    public function schedulesForExamTable(Request $request)
    {
        $today = Carbon::today();
        if($request->ajax()):
            $applied_exam = hasExam::where('id',$request->applied_exam_id)->first();
            $data = Schedule::where('subject_id',$applied_exam->subject_id)->where('exam_type_id',$applied_exam->exam_type_id)->where('date', '>=', $today)->addSelect([
                'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
            ]);
            if($request->exam != null):
                $data = $data->where('exam_id', $request->exam);
            endif;
            $data = $data->get();
            return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
        endif;
    }
    // SCHEDULES FOR APPLIED EXAM TABLE

    // SEARCH THE SCHEDULES BY EXAM
    // public function searchSchedulesByExam(Request $request)
    // {
    //     $today = Carbon::today();
    //     $applied_exam = hasExam::where('id',$request->applied_exam_id)->first();
    //     $searched_schedules = Schedule::where('subject_id',$applied_exam->subject_id)->where('exam_type_id',$applied_exam->exam_type_id)->where('date', '>=', $today)->where('exam_id',$request->exam_id)->addSelect([
    //         'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
    //     ])->get();
    //     return response()->json(['status'=> 'success', 'searched_schedules'=>$searched_schedules, 'applied_exam'=> $applied_exam]);
    // }
    // SEARCH THE SCHEDULES BY EXAM
    // /GET DETAILS FOR MODALS LOAD

    // SCHEDULE APPLIED EXAM
    public function scheduleAppliedExam(Request $request)
    {
        if(hasExam::where('id', $request->applied_exam_id)->update([
            'exam_schedule_id'=> $request->schedule_id,
            'status'=> 'Scheduled',
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
        $scheduled_exams = hasExam::where('payment_id', $request->payment_id)->where('exam_schedule_id', '!=', null)->where('status', 'Scheduled')->get();
        if($scheduled_exams->isEmpty()):
            return response()->json(['status'=>'error', 'msg'=>'There are no scheduled exams.']);
        else:
            foreach($scheduled_exams as $exam):
                hasExam::where('id', $exam->id)->update(['status'=>'Approved']);
            endforeach;
            return response()->json(['status'=>'success']);
        endif;
        //dd($request->all());
    }
    // APPROVE SCHEDULED EXAMS


}
