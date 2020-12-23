<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('revalidate');
    $this->middleware('staff.auth');
  }
  
  public function index()
  {
    return view('portal/staff/system');
  }
}
