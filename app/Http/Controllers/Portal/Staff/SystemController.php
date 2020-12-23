<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Role;
use App\Models\User\Role\Role_Permission\Permission;
use App\Models\Subject;
use App\Models\Exam\Types;
use App\Models\Student_Registration\Academic_Year;
use App\Models\Student\Payment\Method;
use App\Models\Student\Payment\Type;
use App\Models\Student\Phase;

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
    $roles = Role::orderby('name')->get();
    $permissions = Permission::orderby('permission')->get();
    $subjects = Subject::orderby('code')->get();
    $exam_types = Types::orderby('id')->get();
    $years = Academic_Year::orderby('year')->get();
    $payment_methods = Method::orderby('id')->get();
    $payment_types = Type::orderby('id')->get();
    $phases = Phase::orderby('code')->get();
    return view('portal/staff/system',compact('roles','permissions','subjects','exam_types','years','payment_methods', 'payment_types', 'phases'));
  }

  // public function getUserRoles()
  // {
  //   $roles = Role::select('name')->get();
  //   return view('portal/staff/system',compact('roles'));
  // }

}
