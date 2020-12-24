<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    endif;
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
