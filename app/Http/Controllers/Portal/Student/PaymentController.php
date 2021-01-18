<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student\Payment;
use App\Models\Support\Bank;
use App\Models\Support\Fee;
use Illuminate\Http\Request;
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
    $this->middleware('student.payment');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function exam()
  {
    return view('portal/student/payment/exam');
  }  
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

  public function saveRegPayment(Request $request)
  {
    $student = Auth::user()->student;
    $registration = $student->registration()->where('registered_at', NULL)->where('status', NULL);
    $reg_fee = Fee::where('purpose', 'registration')->first()->amount;
    $validator = Validator::make($request->all(), 
      [     
          'paidBank'=> ['required', 'numeric', 'exists:App\Models\Support\Bank,id', 'size:1'],
          'paidBankBranch'=>['required', 'numeric', 'exists:App\Models\Support\BankBranch,id'],
          'paidDate'=>['required', 'before_or_equal:today'],
          'paidAmount'=>['required', 'numeric', 'size:2800'],
          'bankSlip'=>['required', 'image']
      ]
    );
    if($validator->fails()):
      return response()->json(['errors'=>$validator->errors()]);
    else:
      $payment = new Payment();
      $payment->method_id = 2;
      $payment->type_id = 1;
      $payment->student_id = $student->id;
      $payment->amount = $request->paidAmount;
      $payment->bank_id = $request->paidBank;
      $payment->bank_branch_id = $request->paidBankBranch;
      $payment->paid_date = $request->paidDate;

      $file_ext = $request->file('bankSlip')->getClientOriginalExtension();
      $file_name = $student->id.'_'.date('Y-m-d').'_'.time().'.'. $file_ext;

      $payment->image = $file_name;

      if($path = $request->file('bankSlip')->storeAs('public/payments/registration/'.$student->id,$file_name)):
        if($payment->save()):
          $registration->update([
            'payment_id' => $payment->id,
            'payment_status' => NULL,
            'declined_msg' => NULL,
          ]);
          return response()->json(['success'=>'success']);
        endif;

      endif;

    endif;
    return response()->json(['error'=>'error']);
  }

  public function saveExamPayment(Request $request)
  {
    $validator = Validator::make($request->all(), 
      [     
          'paidBank'=> ['required'],
          'paidBankCode'=>['required'],
          'paidDate'=>['required', ],
          'paidAmount'=>['required', 'numeric']
      ]
    );
    if($validator->fails()):
      return response()->json(['errors'=>$validator->errors()]);
    else:

    endif;
  }
}
