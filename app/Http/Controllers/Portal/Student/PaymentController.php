<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
