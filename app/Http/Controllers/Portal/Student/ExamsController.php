<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Student\hasExam;
use App\Models\Student\Payment;
use App\Models\Student\Medical;
use App\Models\Student\Payment\Type;
use App\Models\Support\Bank;
use App\Models\Support\Fee;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;

class ExamsController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('revalidate');
    $this->middleware('student.auth');
    $this->middleware('student.info.view');
    $this->middleware('student.registration.active');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $today = Carbon::today();

    // $schedules=Schedule::orderby('date')->take(6)->get();
    $exams_to_apply = Fee::where('purpose', 'exam')->get();
    $next_years_exams = Exam::where('year', '>', $today->year);
    $exams = Exam::where('year', $today->year)->where('month', '>=', $today->month)->union($next_years_exams)->orderBy('year', 'asc')->orderBy('month', 'asc')->get();
    $student = Student::where('user_id',Auth::user()->id)->first();
    $selected_exams = hasExam::where('student_id', $student->id)->where('exam_schedule_id', null)->where('payment_id', null)->get();
    $applied_exams = hasExam::where('student_id', $student->id)->where('exam_schedule_id', null)->where('payment_id', '!=', null)->get();
    $scheduled_exams = hasExam::where('student_id', $student->id)->where('exam_schedule_id', '!=', null)->where('schedule_status', 'Approved')->get();
    $held_exams = hasExam::where('student_id', $student->id)->where('exam_schedule_id', '!=', null)->where('schedule_status', 'Approved')->get();
    ($student->flag->phase_id == 2) ? $isBlocked=true : $isBlocked=false;
    
    return view('portal/student/exams',[
      // 'schedules' => $schedules,
      'exams' =>$exams,
      'exams_to_apply' => $exams_to_apply,
      'student' => $student,
      'selected_exams' => $selected_exams,
      'applied_exams' => $applied_exams,
      'scheduled_exams' => $scheduled_exams,
      'held_exams' => $held_exams,
      'isBlocked' => $isBlocked
    ]);
  }

  public function selectStudentExams(Request $request)
  {
    $checked_exam_array = $request->applyExamCheck;
    $exams_to_apply = Fee::where('purpose', 'exam')->get();
    $student_id = Auth::user()->student->id;
    // echo $exams_to_apply;

    if ( $checked_exam_array == NULL ):
      return response()->json(['status'=>'unselected']);
    else:
      foreach ($exams_to_apply as $exam_to_apply) :
        // echo $exam_to_apply;
        $id = $exam_to_apply->id;
        $requested_month = $id.'-requestedExam';
          
        if ( $request->$id == 1 ) :
          // echo $request->$id;
          if ( $request->$requested_month ) :
            // echo $request->$requested_month;
  
            $similar_exam = hasExam::where( 'student_id', $student_id )
                              ->where( 'subject_id', $exam_to_apply->subject_id )
                              ->where( 'exam_type_id', $exam_to_apply->exam_type_id )
                              ->where( 'requested_exam_id', $request->$requested_month )
                              ->first(); 

            $same_exam = hasExam::where( 'student_id', $student_id )
                                ->where( 'subject_id', $exam_to_apply->subject_id )
                                ->where( 'exam_type_id', $exam_to_apply->exam_type_id )
                                ->where( 'exam_schedule_id', null )
                                ->where( 'mark', null )
                                ->first(); 
  
            $passed_exam = hasExam::where( 'student_id', $student_id )
                              ->where( 'subject_id', $exam_to_apply->subject_id )
                              ->where( 'exam_type_id', $exam_to_apply->exam_type_id )
                              ->where( 'result', 2 )
                              ->where( 'status', 'P' )
                              ->first(); 

            $scheduled_exam = hasExam::where( 'student_id', $student_id )
                                    ->where( 'subject_id', $exam_to_apply->subject_id )
                                    ->where( 'exam_type_id', $exam_to_apply->exam_type_id )
                                    ->whereHas('schedule', function($query) {
                                      $query->where('date', '>=', date('Y-m-d'));
                                    })->first();
            // echo $scheduled_exam;
            // echo $same_exam;
            // echo $similar_exam;

            if( $similar_exam != Null || $same_exam != Null || $scheduled_exam != Null ):
              return response()->json(['status'=>'exist']);
            else:
              if( $passed_exam != Null ):
                return response()->json(['status'=>'passed']);
              else:
                $applied_exam = new hasExam();
      
                $applied_exam->student_id = $student_id;
                $applied_exam->subject_id = $exam_to_apply->subject_id;
                $applied_exam->exam_type_id = $exam_to_apply->exam_type_id;
                $applied_exam->requested_exam_id = $request->$requested_month;
      
                $applied_exam->save();

              endif;
            endif;
  
          else:
            return response()->json(['status'=>'nomonth']);
          endif;
        else:
          if( $request->$requested_month ):
            continue;
          endif;
        endif;
      endforeach;
      return response()->json(['status'=>'success']);
    endif;



    // Check if exams are selected
    // if($checked_exam_array == null):
    //   return response()->json(['status'=>'unselected']);
    // else:
    //   foreach($request->applySubject as $key=>$value):
    //     if(in_array($request->applySubject[$key], $checked_exam_array)):
    //       $applied_exam = new hasExam();
    //       $subject = Fee::where('id',$request->applySubject[$key])->first();

    //       $applied_exam->student_id = $request->student_id;
    //       $applied_exam->subject_id = $subject->subject_id;
    //       $applied_exam->exam_type_id = $request->applyExamType[$key];
    //       $applied_exam->requested_exam_id = $request->requestedExam[$key];
    //       $applied_exam->save();
    //     endif;
    //   endforeach;
    //   return response()->json(['status'=>'success']);
    // endif;

    // dd($request->all());
  }

  public function deleteStudentExams(Request $request)
  {
    if(hasExam::where('id', $request->student_exam_id)->forceDelete()):
      return response()->json(['status'=>'success']);
    endif;
    return response()->json(['status'=>'error']);
  }

  public function examPayment()
  {
    $student = Auth::user()->student;
    $selected_exams = hasExam::where('student_id', $student->id)->where('exam_schedule_id', null)->where('payment_id', null)->get();
    $total_amount = null;
    if(count($selected_exams)<1):
      return redirect()->route('student.exam');
    endif;
    foreach ($selected_exams as $selected_exam) {
      $total_amount = $total_amount+Fee::select('amount')->where('subject_id', $selected_exam->subject->id)->where('exam_type_id', $selected_exam->type->id)->first()->amount;
    }
    
    $banks = Bank::orderBy('name')->get();
    return view('portal/student/payment/exam', compact('student', 'selected_exams', 'total_amount', 'banks'));
  } 
  
  public function saveExamPayment(Request $request)
  {
    $validator = Validator::make($request->all(), 
      [     
        'paidBank'=> ['required', 'numeric', 'exists:App\Models\Support\Bank,id', 'size:1'],
        'paidBankBranch'=>['required', 'numeric', 'exists:App\Models\Support\BankBranch,id'],
        'paidDate'=>['required', 'before_or_equal:today'],
        'paidAmount'=>['required', 'numeric'],
        'bankSlip'=>['required', 'image']
      ]
    );
    $student = Auth::user()->student;
    $selected_exams = hasExam::where('student_id', $student->id)->where('exam_schedule_id', null)->where('payment_id', null)->get();
    $total_amount = null;
    foreach ($selected_exams as $selected_exam) {
      $total_amount = $total_amount+Fee::select('amount')->where('subject_id', $selected_exam->subject->id)->where('exam_type_id', $selected_exam->type->id)->first()->amount;
    }

    if ( $request->paidAmount != $total_amount ) {
      $validator->errors()->add(
        'paidAmount', 'Invalid amount'
      );
      return response()->json(['errors'=>$validator->errors()]);
    }

    if($validator->fails()):
      return response()->json(['errors'=>$validator->errors()]);
    else:
      $payment = new Payment();
      $payment->method_id = 2;      
      $payment->type_id = 2;
      $payment->student_id = $student->id;
      $payment->amount = $request->paidAmount;
      $payment->bank_id = $request->paidBank;
      $payment->bank_branch_id = $request->paidBankBranch;
      $payment->paid_date = $request->paidDate;

      $file_ext = $request->file('bankSlip')->getClientOriginalExtension();
      $file_name = $student->id.'_'.date('Y-m-d').'_'.time().'.'. $file_ext;

      $payment->image = $file_name;

      if($path = $request->file('bankSlip')->storeAs('public/payments/exam/'.$student->id,$file_name)):
        if($payment->save()):

          foreach ($selected_exams as $selected_exam) {
            $student_exam = hasExam::where('id',$selected_exam->id);
            $student_exam->update([              
              'payment_id' => $payment->id
            ]);

          }

          return response()->json(['success'=>'success']);
        endif;

      endif;
    endif;
    return response()->json(['error'=>'error']);
  }

  // EXAM DECLINED MESSAGE
  public function getExamDeclinedMessage(Request $request) 
  {
    if($declined_exam = hasExam::where('id', $request->id)->first()):
      return response()->json(['status'=>'success', 'declined_exam'=>$declined_exam]);
    else:
      return response()->json(['status'=>'error']);
    endif;
  }
  // /EXAM DECLINED MESSAGE

  public function uploadExamMedical(Request $request)
  {
    $validator = Validator::make($request->all(), 
      [     
          'reason'=> ['required'],
          'medical'=> ['required', 'image']
      ]
    );

    if($validator->fails()):
      return response()->json(['errors'=>$validator->errors()]);
    else:
      // echo $request->id;
      $student_id = Auth::user()->student->id;
      $medical = new Medical();
      $medical->student_id = $student_id;
      $medical->student_exam_id = $request->id;
      $medical->reason = $request->reason;
      $medical->status = 'Pending';

      $medical_ext = $request->file('medical')->getClientOriginalExtension();
      $medical_name = $student_id.'_medical_'.date('Y-m-d').'_'.time().'.'. $medical_ext;
      
      $medical->image = $medical_name;
      
      if($path = $request->file('medical')->storeAs('public/medicals/'.$student_id, $medical_name)):
        if($medical->save()):
          $student_exam = hasExam::where('id',$request->id);
          if($student_exam->update(['medical_id'=>$medical->id])):
            return response()->json(['status'=>'success']);
          endif;
        endif;
      endif;
    endif;
    return response()->json(['error'=>'error']);
  }

  public function deleteExamMedical(Request $request)
  {
    $student_id = Auth::user()->student->id;
    $student_exam = hasExam::where('id',$request->id)->first();
    $medical = Medical::where('id', $student_exam->medical_id);

    $medical_image = ($medical->first())->image;

    if( $medical->forceDelete() && Storage::delete('public/medicals/'.$student_id.'/'.$medical_image) && $student_exam->update(['medical_id'=>null])):     

      return response()->json(['status'=>'success']);

    endif;
    return response()->json(['error'=>'error']);
  }
}
