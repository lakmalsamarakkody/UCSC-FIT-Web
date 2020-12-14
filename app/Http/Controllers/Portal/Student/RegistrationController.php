<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrationController extends Controller
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
  public function index()
  {
    return view('portal/student/registration');
  }

  public function SaveInformation(Request $request)
  {
    // Validate and store Student Information
    $validatedData = $request->validate([
      'title' => ['required', 'max:255'],
      'firstName' => ['required'],
  ]);
  }
}
