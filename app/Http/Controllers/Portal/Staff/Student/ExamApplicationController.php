<?php

namespace App\Http\Controllers\Portal\Staff\Student;

use App\Http\Controllers\Controller;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Student\Payment;
use App\Models\Student\Medical;
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
use App\Models\Student\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\isEmpty;

class ExamApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('staff.auth');
    }
    // PAGES FROM HOME PAGE EXAMS CARDS
    // REVIEW EXAM PAYMENTS
    public function reviewExamPayments()
    {
        $today = Carbon::today();
        $exam_applicants = hasExam::where('payment_id', '!=', null)->where('payment_status', null)->where('schedule_status', 'Pending')->orWhere('schedule_status', 'Scheduled')->orderBy('created_at', 'asc')->get()->unique('payment_id');
        $exams = Exam::where('year', '>=', $today->year)->where('month', '>=', $today->month)->orderBy('year', 'asc')->get();
        $applied_exams = hasExam::where('exam_schedule_id', '!=', null)->where('schedule_status', 'Pending')->get();
        return view('portal/staff/student/exam_payments', [
            'exam_applicants' => $exam_applicants,
            'applied_exams' => $applied_exams,
            'exams' => $exams
        ]);
    }
    // /REVIEW EXAM PAYMENTS

    // REVIEW EXAM APPLICATIONS
    public function reviewExamApplications()
    {
        $selSechedule = Null;
        $today = Carbon::today();
        $exam_applicants = hasExam::where('payment_id', '!=', null)->where('payment_status', 'Approved')->where('schedule_status', 'Pending')->orWhere('schedule_status', 'Scheduled')->orderBy('created_at', 'asc')->get()->unique('payment_id');
        $exams = Exam::where('year', '>=', $today->year)->where('month', '>=', $today->month)->orderBy('year', 'asc')->get();
        $applied_exams = hasExam::where('exam_schedule_id', '!=', null)->where('schedule_status', 'Pending')->get();
        $schedules = Schedule::where('date', '>', $today)->where('schedule_release', 1)->addSelect([
            'year' => Exam::select('year')->whereColumn('exam_id', 'exams.id'),
            'month' => Exam::select(DB::raw("MONTHNAME(CONCAT(year,'-',month,'-01')) as monthname"))->whereColumn('exam_id', 'exams.id'),
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'subject_name'=> Subject::select('name')->whereColumn('subject_id','subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')])->get();
        $sel_exam_applicants = null;
        return view('portal/staff/student/exam_application', compact('exam_applicants', 'applied_exams', 'exams', 'schedules', 'selSechedule', 'sel_exam_applicants'));
    }
    // /REVIEW EXAM APPLICATIONS

    // SELECT SCHEDULE
    public function selectSchedule($id)
    {
        if($id==null):
            return redirect('student.application.exams');
        endif;
        $selSechedule = Null;
        $today = Carbon::today();
        $exam_applicants = hasExam::where('payment_id', '!=', null)->where('payment_status', 'Approved')->where('schedule_status', 'Pending')->orWhere('schedule_status', 'Scheduled')->orderBy('created_at', 'asc')->get()->unique('payment_id');
        $exams = Exam::where('year', '>=', $today->year)->where('month', '>=', $today->month)->orderBy('year', 'asc')->get();
        $applied_exams = hasExam::where('exam_schedule_id', '!=', null)->where('schedule_status', 'Pending')->get();
        $schedules = Schedule::where('date', '>', $today)->where('schedule_release', 1)->addSelect([
            'year' => Exam::select('year')->whereColumn('exam_id', 'exams.id'),
            'month' => Exam::select(DB::raw("MONTHNAME(CONCAT(year,'-',month,'-01')) as monthname"))->whereColumn('exam_id', 'exams.id'),
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'subject_name'=> Subject::select('name')->whereColumn('subject_id','subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')])->get();
        $selSechedule = Schedule::where('id', $id)->addSelect([
            'year' => Exam::select('year')->whereColumn('exam_id', 'exams.id'),
            'month' => Exam::select(DB::raw("MONTHNAME(CONCAT(year,'-',month,'-01')) as monthname"))->whereColumn('exam_id', 'exams.id'),
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'subject_name'=> Subject::select('name')->whereColumn('subject_id','subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')])->first();
        $lab_occupied = hasExam::where('exam_schedule_id', $id)->count();
        $sel_exam_applicants = hasExam::where('payment_id', '!=', null)->where('payment_status', 'Approved')->where('schedule_status', 'Scheduled')->where('exam_schedule_id', $id)->orderBy('created_at', 'asc')->get()->unique('payment_id');
        return view('portal/staff/student/exam_application', compact('exam_applicants', 'applied_exams', 'exams', 'schedules', 'selSechedule', 'lab_occupied', 'sel_exam_applicants'));

    }
    // /SELECT SCHEDULE

    // EXAM SCHEDULES TABLE


    public function getSchedulesToAssign(Request $request)
    {
        $today = Carbon::today();
        if ($request->ajax()):
            $data = Schedule::where('date', '>', $today)->where('schedule_release', 1)->addSelect([
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
    // /EXAM SCHEDULES TABLE

    // REVIEW MEDICALS
    public function reviewMedicals()
    {
        $medicals = Medical::where('status', 'Pending')->where('type', 'medical')->orderBy('created_at', 'asc')->get();
        return view('portal/staff/student/medical', [
            'medicals'=> $medicals
        ]);
    }
    // /REVIEW MEDICALS

    // REVIEW RESCHEDULE REQUESTS
    public function reviewRescheduleRequests()
    {
        // $medicals = Medical::where('status', 'Pending')->where('type', 'reschedule')->orderBy('created_at', 'asc')->get();
        $payments = Payment::where('status', null)->where('type_id', 3)->get();
        return view('portal/staff/student/reschedule_requests', [
            'payments'=> $payments
        ]);
    }
    // /REVIEW RESCHEDULE REQUESTS

    // REVIEW EXAMS TO RESCHEDULE
    public function reviewExamsToReschedule()
    {
        $today = Carbon::today();
        $exams_to_reschedule = Medical::where('status', 'Approved')->get();
        $exams = Exam::where('year', '>=', $today->year)->where('month', '>=', $today->month)->orderBy('year', 'asc')->get();
        return view('portal/staff/student/exam_reschedule', [
            'exams_to_reschedule'=>$exams_to_reschedule,
            'exams'=>$exams
        ]);
    }
    // /REVIEW EXAMS TO RESCHEDULE
    // /PAGES FROM HOME PAGE EXAMS CARDS

    // FUNCTIONS IN EXAM APPLICATION/PAYMENT VIEW MODAL
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
            $query->where('schedule_status', 'Scheduled')->orWhere('schedule_status', 'Pending');
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
        $data = hasExam::where('payment_id', '!=', null)
            ->where('payment_id',$request->payment_id)
            ->where('schedule_status', '!=', 'Approved')
            ->addSelect([
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id'),
            'schedule_date'=> Schedule::select('date')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
            'requested_month'=> Exam::select(DB::raw("MONTHNAME(CONCAT(year, '-',month, '-01')) as monthname"))->whereColumn('requested_exam_id', 'exams.id'),
            'requested_year'=> Exam::select('year')->whereColumn('requested_exam_id', 'exams.id'),
            'schedule_time'=> Schedule::select(DB::raw('CONCAT(start_time, end_time) as time'))->whereColumn('exam_schedule_id', 'exam_schedules.id'),
            'start_time'=>Schedule::select('start_time')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
            'end_time'=>Schedule::select('end_time')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
        ])->orderBy('requested_exam_id')->orderBy('subject_id')->orderBy('exam_type_id');
        return DataTables::of($data)
        ->addColumn('requested_exam', function($row) {
            return $row->requested_year.' '.$row->requested_month;
        })
        ->addColumn('schedule_time', function($row) {
            if($row->start_time && $row->end_time ):
                return Carbon::createFromFormat('H:i:s', $row->start_time)->isoFormat('hh:mmA').' '.Carbon::createFromFormat('H:i:s', $row->end_time)->isoFormat('hh:mmA');
            else:
                return NULL;
            endif;
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
            $student = Student::where('id', Payment::where('id', $request->payment_id)->first()->student_id)->first();
            $details = [
                'subject' => 'Exam Payment Approved',
                'title' => 'Exam Payment Approved',
                'body' => 'Exam Payment Approved! <br> You will ne notified when it is scheduled',
                'color' => '#1b672a'
            ];
            Mail::to($student->user->email)->queue( new NotificationEmail($details) );
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
            $student = Student::where('id', Payment::where('id', $request->payment_id)->first()->student_id)->first();
            if($request->message != NULL):
                $decline_msg = $request->message;
            else:
                $decline_msg = '';
            endif;
            $details = [
                'subject' => 'Exam Payment Declined',
                'title' => 'Exam Payment Declined',
                'body' => $decline_msg,
                'color' => '#821919'
            ];
            Mail::to($student->user->email)->queue( new NotificationEmail($details) );
            return response()->json(['status'=>'success']);
        endif;
        return response()->json(['status'=>'error']);
    }
    // /DECLINE PAYMENT

    // LOAD SCHEDULES TO MODAL
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
    // /LOAD SCHEDULES TO MODAL
    
    // SCHEDULES FOR APPLIED EXAM TABLE
    public function schedulesForExamTable(Request $request)
    {
        $today = Carbon::today();
        if($request->ajax()):
            $applied_exam = hasExam::where('id',$request->applied_exam_id)->first();
            $data = Schedule::where('subject_id',$applied_exam->subject_id)->where('exam_type_id',$applied_exam->exam_type_id)->where('date', '>=', $today)->where('schedule_release', 1)->addSelect([
                'subject'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
                'examtype'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id'),
            ]);
            if($request->exam != null):
                $data = $data->where('exam_id', $request->exam);
            endif;
            $data = $data->get();
            return DataTables::of($data)
            ->editColumn('start_time', function($data){ $start_time = Carbon::createFromFormat('H:i:s', $data->start_time)->isoFormat('hh:mm A'); return $start_time; })
            ->editColumn('end_time', function($data){ $end_time = Carbon::createFromFormat('H:i:s', $data->end_time)->isoFormat('hh:mm A'); return $end_time; })
            ->rawColumns(['action'])
            // ->addColumn('subject_name', function($row) {return $row->subject.' - '.$row->examtype;})
            ->editColumn('count', function($data) { $count = hasExam::where('exam_schedule_id',$data->id)->count(); return $count;})
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
            'schedule_status'=> 'Scheduled',
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
        $scheduled_exams = hasExam::where('payment_id', $request->payment_id)->where('exam_schedule_id', '!=', null)->where('schedule_status', 'Scheduled')->get();
        if($scheduled_exams->isEmpty()):
            return response()->json(['status'=>'error', 'msg'=>'There are no scheduled exams.']);
        else:
            foreach($scheduled_exams as $exam):
                hasExam::where('id', $exam->id)->update(['schedule_status'=>'Approved']);
            endforeach;
            return response()->json(['status'=>'success']);
        endif;
    }

    public function approveAllScheduledExams(Request $request){
        $scheduled_exams = hasExam::where('exam_schedule_id', '!=', null)->where('schedule_status', 'Scheduled')->get();
        if($scheduled_exams->isEmpty()):
            return response()->json(['status'=>'error', 'title'=>'There are no scheduled exams to approve.', 'msg'=>'Please assign schedules first for the following students']);
        else:
            foreach($scheduled_exams as $exam):
                hasExam::where('id', $exam->id)->update(['schedule_status'=>'Approved']);
            endforeach;
            return response()->json(['status'=>'success']);
        endif;
    }
    // APPROVE SCHEDULED EXAMS
    // /FUNCTIONS IN EXAM APPLICATION/PAYMENT VIEW MODAL

    // MEDICALS
    // LOAD MEDICAL MODAL
    public function getMedicalDetails(Request $request)
    {
        $exam = hasExam::where('medical_id',$request->medical_id)->addSelect([
            'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id'),
            'held_date'=> Schedule::select('date')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
        ])->first();
        $student = Student::where('id', $exam->student_id)->first();
        $medical = Medical::where('id', $exam->medical_id)->first();
        return response()->json(['status'=> 'success', 'student'=> $student, 'exam'=>$exam, 'medical'=>$medical]);
    }
    // /LOAD MEDICAL MODAL

    // APPROVE MEDICAL
    public function approveMedical(Request $request)
    {
        $medical = Medical::where('id', $request->medical_id)->where('status', 'Pending')->first();
        if($medical->update(['status'=> 'Approved'])):
            return response()->json(['status'=>'success']);
        endif;
        return response()->json(['status'=>'error']);
    }
    // /APPROVE MEDICAL

    // DECLINE MEDICAL
    public function declineMedical(Request $request)
    {
        $medical = Medical::where('id', $request->medical_id)->where('status', 'Pending')->first();
        if($medical->update(['status'=> 'Declined'])):
            return response()->json(['status'=>'success']);
        endif;
        return response()->json(['status'=>'error']);
    }
    // /DECLINE MEDICAL

    // DECLINE TO RESUBMIT
    public function declineToResubmitMedical(Request $request)
    {
        $medical = Medical::where('id', $request->medical_id)->where('status', 'Pending')->first();
        if($medical->update(['status'=> 'Resubmit', 'declined_message'=>$request->message])):
            return response()->json(['status'=>'success']);
        endif;
        return response()->json(['status'=>'error']);
    }
    // /DECLINE TO RESUBMIT
    // /MEDICALS

    // RESCHEDULE EXAMS
    // GET DETAILS TO RESCHEDULE MODAL
    public function getRescheduleExamDetails(Request $request)
    {
        $exam = hasExam::where('id', $request->exam_id)->addSelect([
            'subject_code'=>Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'subject_name'=>Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
            'exam_type'=>Types::select('name')->whereColumn('exam_type_id', 'exam_types.id'),
            'previous_scheduled_date'=> Schedule::select('date')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
            'medical_approved_date'=>Medical::select('updated_at')->whereColumn('medical_id', 'medicals.id')
        ])->first();
        $student = Student::where('id', $exam->student_id)->first();
        return response()->json(['status'=>'success', 'student'=>$student ,'exam'=>$exam]);
    }
    // /GET DETAILS TO RESCHEDULE MODAL

    // SCHEDULES TABLE FOR RESCHEDULE EXAM
    public function schedulesTableForRescheduleExam(Request $request)
    {
        $today = Carbon::today();
        if($request->ajax()):
            $applied_exam = hasExam::where('id',$request->exam_id)->first();
            $data = Schedule::where('subject_id',$applied_exam->subject_id)->where('exam_type_id',$applied_exam->exam_type_id)->where('date', '>=', $today)->where('schedule_release', 1)->addSelect([
                'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
                'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')
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
    // /SCHEDULES TABLE FOR RESCHEDULE EXAM

    // RESCHEDULE
    public function rescheduleExam(Request $request)
    {
        $applied_exam = hasExam::where('id',$request->exam_id)->first();
        $exam = new hasExam();
        $exam->exam_schedule_id = $request->schedule_id;
        $exam->student_id = $applied_exam->student_id;
        $exam->subject_id = $applied_exam->subject_id;
        $exam->exam_type_id = $applied_exam->exam_type_id;
        $exam->requested_exam_id = $applied_exam->requested_exam_id;
        $exam->payment_id = $applied_exam->payment_id;
        $exam->payment_status = $applied_exam->payment_status;
        $exam->schedule_status = 'Approved';

        // Create new student exam
        if($exam->save()):
            // Update relevant previous student exam and medical
            if($applied_exam->update(['schedule_status'=> 'Rescheduled', 'exam_reschedule_id'=> $exam->id]) && Medical::where('id',$applied_exam->medical_id)->first()->update(['status'=> 'Rescheduled'])):
                return response()->json(['status'=>'success']);
            else:
                return response()->json(['status'=>'error']);
            endif;
        endif;
        return response()->json(['status'=>'error']);
    }
    // /RESCHEDULE
    // /RESCHEDULE EXAMS


    // RESCHEDULE REQUESTS
    // LOAD RESCHEDULE REQUEST MODAL
    public function getRescheduleRequestDetails(Request $request)
    {
        $medicals = Medical::where('payment_id', $request->payment_id)->select('student_exam_id')->get();
        $exams = hasExam::whereIn('id',$medicals)->addSelect([
            'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id'),
            'date'=> Schedule::select('date')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
            'time'=> Schedule::select('start_time')->whereColumn('exam_schedule_id', 'exam_schedules.id'),
        ])->get();
        $payment = Payment::where('id',$request->payment_id)->addSelect([
            'bank'=> Bank::select('name')->whereColumn('bank_id', 'banks.id'),
            'bank_branch'=> BankBranch::select('name')->whereColumn('bank_branch_id', 'bank_branches.id'),
            'bank_branch_code'=> BankBranch::select('code')->whereColumn('bank_branch_id', 'bank_branches.id'),
        ])->first();
        $student = Student::where('id', $payment->student_id)->first();
        $medical = Medical::where('payment_id', $request->payment_id)->first();
        return response()->json(['status'=> 'success', 'student'=> $student, 'payment'=>$payment, 'exams'=>$exams, 'medical'=>$medical]);
    }
    // /LOAD  RESCHEDULE REQUEST MODAL

    // APPROVE  RESCHEDULE REQUEST
    public function approveRescheduleRequest(Request $request)
    {
        $payment = Payment::where('id', $request->payment_id)->first();
        $medical = Medical::where('payment_id', $request->payment_id);
        if($medical->update(['status'=> 'Approved']) && $payment->update(['status' => 'Approve'])):
            $student = Student::where('id', Payment::where('id', $request->payment_id)->first()->student_id)->first();
            $details = [
                'subject' => 'Exam Reschedule Request Approved',
                'title' => 'Exam Reschedule Request Payment Approved',
                'body' => 'Exam Reschedule Request Payment Approved! <br> You will ne notified when it is re-scheduled',
                'color' => '#1b672a'
            ];
            Mail::to($student->user->email)->queue( new NotificationEmail($details) );
            return response()->json(['status'=>'success']);
        endif;
        return response()->json(['status'=>'error']);
    }
    // /APPROVE  RESCHEDULE REQUEST

    // DECLINE  RESCHEDULE REQUEST
    public function declineRescheduleRequest(Request $request)
    {
        $payment = Payment::where('id', $request->payment_id)->first();
        $medical = Medical::where('payment_id', $request->payment_id);
        if($medical->update(['status'=> 'Declined', 'declined_message' => $request->message]) && $payment->update(['status' => 'Declined'])):
            $student = Student::where('id', Payment::where('id', $request->payment_id)->first()->student_id)->first();
            if($request->message != NULL):
                $decline_msg = $request->message;
            else:
                $decline_msg = '';
            endif;
            $details = [
                'subject' => 'Exam Reschedule Request Declined',
                'title' => 'Exam Reschedule Request Payment Declined',
                'body' => $decline_msg,
                'color' => '#821919'
            ];
            Mail::to($student->user->email)->queue( new NotificationEmail($details) );
            return response()->json(['status'=>'success']);
        endif;
        return response()->json(['status'=>'error']);
    }
    // /DECLINE  RESCHEDULE REQUEST

    // /RESCHEDULE REQUESTS
}
