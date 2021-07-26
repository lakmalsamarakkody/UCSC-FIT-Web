<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student\Payment;
use App\Models\Support\Bank;
use App\Models\Support\Fee;
use Illuminate\Http\Request;
use App\Models\Student\hasExam;
use App\Models\Student\Registration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
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
    $this->middleware('student.payment.view');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */

  public function registration()
  {
    $student = Auth::user()->student;
    $registration = $student->registration()->where('registered_at', NULL)->where('status', NULL)->first();
    if($registration->payment_id != NULL):
      $payment = $registration->payment;
    else:
      $payment = NULL;
    endif;
    $reg_fee = Fee::where('purpose', 'registration')->first();
    $banks = Bank::orderBy('name')->get();
    return view('portal/student/payment/registration', compact( 'reg_fee', 'banks', 'student', 'registration', 'payment'));
  }

  // REGISTRATION PAYMENT SUBMIT
  public function saveRegPayment(Request $request)
  {
    $student = Auth::user()->student;
    $registration = $student->registration()->where('registered_at', NULL)->where('status', NULL);
    $reg_fee = Fee::where('purpose', 'registration')->first()->amount;

    // VALIDATIONS
    $detailsValidator = Validator::make($request->all(), 
      [     
          'paidBank'=> ['required', 'numeric', 'exists:App\Models\Support\Bank,id', 'size:1'],
          'paidBankBranch'=>['required', 'numeric', 'exists:App\Models\Support\BankBranch,id'],
          'paidDate'=>['required', 'before_or_equal:today'],
          'paidAmount'=>['required', 'numeric', 'size:'.$reg_fee],
      ]
    );
    if(!$request->noPaymentSlip):
      $bankSlipValidator = Validator::make($request->all(),
        [
          'bankSlip'=>['required', 'image', 'max:5120'],
          'bankSlip2'=>['required', 'image', 'max:5120']
        ],
        [
          'max'=>'Image may not be greater than 5MB'
        ]
      );
    endif;
    // /VALIDATIONS

    if($detailsValidator->fails()):
      return response()->json(['errors'=>$detailsValidator->errors()]);
    elseif(isset($bankSlipValidator) && $bankSlipValidator->fails()):
      return response()->json(['errors'=>$bankSlipValidator->errors()]);
    else:
      $payment = new Payment();
      $payment->method_id = 2;
      $payment->type_id = 1;
      $payment->student_id = $student->id;
      $payment->amount = $request->paidAmount;
      $payment->bank_id = $request->paidBank;
      $payment->bank_branch_id = $request->paidBankBranch;
      $payment->paid_date = $request->paidDate;

      // CHECK FOR ENROLLMENT AND SET PAYMENT SLIP
      if(!$request->noPaymentSlip):
        $file_ext = $request->file('bankSlip')->getClientOriginalExtension();
        $file_name = $student->id.'_'.date('Y-m-d').'_'.time().'.'. $file_ext;
        $payment->image = $file_name;
        if(!$request->file('bankSlip')->storeAs('public/payments/registration/'.$student->id,$file_name)):
          return response()->json(['error'=>'error']);
        endif;

        $file_ext2 = $request->file('bankSlip2')->getClientOriginalExtension();
        $file_name2 = $student->id.'_2_'.date('Y-m-d').'_'.time().'.'. $file_ext2;
        $payment->image_two = $file_name2;
        if(!$request->file('bankSlip2')->storeAs('public/payments/registration/'.$student->id,$file_name2)):
          return response()->json(['error'=>'error']);
        endif;
      else:
        $payment->image = NULL;
      endif;
      // /CHECK FOR ENROLLMENT AND SET PAYMENT SLIP

      // SAVE PAYMENT
      if($payment->save()):
        $registration->update([
          'payment_id' => $payment->id,
          'payment_status' => NULL,
          'declined_msg' => NULL,
        ]);
        return response()->json(['success'=>'success']);
      endif;
      // /SAVE PAYMENT
    endif;
    return response()->json(['error'=>'error']);
  }
  // /REGISTRATION PAYMENT SUBMIT

  // RE-REGISTRATION CONTROLLER
  public function reregistration()
  {
    $student = Auth::user()->student;
    $reg_fee = Fee::where('purpose', 'reregistration')->first();
    $banks = Bank::orderBy('name')->get();
    $payment = NULL;
    $registration = NULL;
    
    //CHECK FOR PROCESSING REGISTRATION PAYMENT
    $processingRegistration = $student->processing_registration();
    if($processingRegistration):
      $registration = $student->processing_registration()->id;
      $payment = Payment::where('id', $processingRegistration->payment_id)->first();
    endif;


    $lastRegistration = Registration::where('id',$student->last_registration()->id)->first();
    $lastRegExpired = $student->last_registration()->registration_expire_at;
    $dueRegistrations = 1;
    $regStart = Carbon::create($lastRegExpired)->addDay()->isoFormat('YYYY-MM-DD');
    $regEnd = Carbon::create($lastRegExpired)->addYear()->isoFormat('YYYY-MM-DD');

    while($regEnd<Carbon::now()->isoFormat('YYYY-MM-DD')){
      $dueRegistrations = $dueRegistrations+1;
      $regStart = Carbon::create($regStart)->addYear()->isoFormat('YYYY-MM-DD');
      $regEnd = Carbon::create($regEnd)->addYear()->isoFormat('YYYY-MM-DD');
    };

    return view('portal/student/payment/reregistration', compact( 'reg_fee', 'banks', 'student', 'registration', 'payment', 'lastRegistration', 'regStart', 'regEnd', 'dueRegistrations'));
  }
  // /RE-REGISTRATION CONTROLLER

  // RE-REGISTRATION PAYMENT SUBMIT
  public function saveReRegPayment(Request $request)
  {
    $student = Auth::user()->student;
    $reg_fee = Fee::where('purpose', 'reregistration')->first()->amount;
    $lastRegistration = Registration::where('id',$student->last_registration()->id)->first();
    $lastRegExpired = $student->last_registration()->registration_expire_at;

    // CHECK FOR PROCESSING REGISTRATION PAYMENT
    $processingRegistration = $student->processing_registration();
    if($processingRegistration):
      $registration = $student->processing_registration()->id;
      $payment = Payment::where('id', $processingRegistration->payment_id)->first();
    endif;
    // CHECK FOR PROCESSING REGISTRATION PAYMENT

    $dueRegistrations = 1;
    $regStart = Carbon::create($lastRegExpired)->addDay()->isoFormat('YYYY-MM-DD');
    $regEnd = Carbon::create($lastRegExpired)->addYear()->isoFormat('YYYY-MM-DD');

    while($regEnd<Carbon::now()->isoFormat('YYYY-MM-DD')){
      $dueRegistrations = $dueRegistrations+1;
      $regStart = Carbon::create($regStart)->addYear()->isoFormat('YYYY-MM-DD');
      $regEnd = Carbon::create($regEnd)->addYear()->isoFormat('YYYY-MM-DD');
    };

    $totalFee = $reg_fee * $dueRegistrations;

    // VALIDATIONS
    $detailsValidator = Validator::make($request->all(), 
      [     
          'paidBank'=> ['required', 'numeric', 'exists:App\Models\Support\Bank,id', 'size:1'],
          'paidBankBranch'=>['required', 'numeric', 'exists:App\Models\Support\BankBranch,id'],
          'paidDate'=>['required', 'before_or_equal:today'],
          'paidAmount'=>['required', 'numeric', 'size:'.$totalFee],
          'bankSlip'=>['required', 'image', 'max:5120'],
          'bankSlip2'=>['required', 'image', 'max:5120']
      ],
      [
        'max'=>'Image may not be greater than 5MB'
      ]
    );
    // /VALIDATIONS

    if($detailsValidator->fails()):
      return response()->json(['errors'=>$detailsValidator->errors()]);
    else:
      $payment = new Payment();
      $payment->method_id = 2;
      $payment->type_id = 1;
      $payment->student_id = $student->id;
      $payment->amount = $request->paidAmount;
      $payment->bank_id = $request->paidBank;
      $payment->bank_branch_id = $request->paidBankBranch;
      $payment->paid_date = $request->paidDate;

      // SET PAYMENT SLIP
      $file_ext = $request->file('bankSlip')->getClientOriginalExtension();
      $file_name = $student->id.'_'.date('Y-m-d').'_'.time().'.'. $file_ext;
      $payment->image = $file_name;
      if(!$request->file('bankSlip')->storeAs('public/payments/registration/'.$student->id,$file_name)):
        return response()->json(['error'=>'error']);
      endif;

      $file_ext2 = $request->file('bankSlip2')->getClientOriginalExtension();
      $file_name2 = $student->id.'_2_'.date('Y-m-d').'_'.time().'.'. $file_ext2;
      $payment->image_two = $file_name2;
      if(!$request->file('bankSlip2')->storeAs('public/payments/registration/'.$student->id,$file_name2)):
        return response()->json(['error'=>'error']);
      endif;
      // /SET PAYMENT SLIP

      // SAVE REGISTRATION
      if($payment->save()):

        // CHECK FOR CURRENT REGISTRATION PROCESS
        if($processingRegistration):
          // UPDATE PAYMENT ID
          $updateRegistration = Registration::where('id', $registration);
          if($updateRegistration->update(['payment_id' => $payment->id,'payment_status' => NULL,'declined_msg' => NULL,'status' => NULL,])):
            return response()->json(['success'=>'success']);
          endif;

        else:
          // CREATE NEW REGISTRATION
          $newRegistration = new Registration();
          $newRegistration->student_id = $student->id;
          $newRegistration->registered_at = $regStart;
          $newRegistration->registration_expire_at = $regEnd;
          $newRegistration->application_submit = 1;
          $newRegistration->application_status = 'Approved';
          $newRegistration->document_submit = 1;
          $newRegistration->document_status = 'Approved';
          $newRegistration->payment_id = $payment->id;
          $newRegistration->payment_status = NULL;
          $newRegistration->declined_msg = NULL;
          $newRegistration->status = NULL;

          if($newRegistration->save()):
            return response()->json(['success'=>'success']);
          endif;
        endif;
        // /CHECK FOR CURRENT REGISTRATION PROCESS
      endif;
      // /SAVE REGISTRATION
    endif;
    return response()->json(['error'=>'error']);
  }
  // /RE-REGISTRATION PAYMENT SUBMIT
}
