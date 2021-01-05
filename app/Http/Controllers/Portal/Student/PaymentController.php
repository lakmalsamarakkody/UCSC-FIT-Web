<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student\Payment;
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
    return view('portal/student/payment/registration');
  }

  public function saveRegPayment(Request $request)
  {
    $validator = Validator::make($request->all(), 
      [     
          'paidBank'=> ['required'],
          'paidBankCode'=>['required','numeric'],
          'paidDate'=>['required', 'before_or_equal:today'],
          'paidAmount'=>['required', 'numeric'],
          'bankSlip'=>['required', 'image']
      ]
    );
    if($validator->fails()):
      return response()->json(['errors'=>$validator->errors()]);
    else:
      $student = Student::where('user_id', Auth::user()->id)->first();
      $payment = new Payment();
      $payment->method_id = 2;
      $payment->type_id = 1;
      $payment->student_id = $student->id;
      $payment->amount = $request->paidAmount;  
      $payment->bank = "peoples bank";
      $payment->bank_branch = $request->paidBank;
      $payment->branch_code = $request->paidBankCode;
      $payment->paid_date = $request->paidDate;

      $file_ext = $request->file('bankSlip')->getClientOriginalExtension();
      $file_name = $student->id.'_'.date('Y-m-d').'_'.time().'.'. $file_ext;

      $payment->image = $file_name;

      if($path = $request->file('bankSlip')->storeAs('public/payments/registration/'.$student->id,$file_name)):
        if($payment->save()):
          $student->registration()->update([
            'payment_id' => $payment->id,
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
