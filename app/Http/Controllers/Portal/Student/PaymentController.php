<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
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
          'paidBankCode'=>['required','integer'],
          'paidDate'=>['required', 'before_or_equal:today'],
          'paidAmount'=>['required', 'numeric'],
          'bankSlip'=>['required', 'image']
      ]
    );
    if($validator->fails()):
      return response()->json(['errors'=>$validator->errors()]);
    else:
      $student_id = Auth::user()->student->id;
      $payment = new Payment();
      $payment->method_id = 2;
      $payment->type_id = 1;
      $payment->student_id = $student_id;
      $payment->amount = $request->paidAmount;
      $payment->bank_branch = $request->paidBank;
      $payment->branch_code = $request->paidBankCode;
      $payment->paid_date = $request->paidDate;

      $file_ext = $request->file('bankSlip')->getClientOriginalExtension();
      $file_name = $student_id.'_'.date('Y-m-d').'_'.time().'.'. $file_ext;

      $payment->payment_image = $file_name;

      if($path = $request->file('bankSlip')->storeAs('public/cover_images',$file_name)):
        if($payment->save()):
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
