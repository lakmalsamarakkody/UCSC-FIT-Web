<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Role;
use App\Models\Subject;
use App\Models\Exam\Types;
use App\Models\Student;
use App\Models\Student\Payment\Method;
use App\Models\Student\Payment\Type;
use App\Models\Student\Phase;
use App\Models\User\Permission;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

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
    $payment_methods = Method::orderby('id')->get();
    $payment_types = Type::orderby('id')->get();
    $phases = Phase::orderby('code')->get();
    return view('portal/staff/system',compact('roles','permissions','subjects','exam_types','payment_methods', 'payment_types', 'phases'));
  }

  public function createUserRole(Request $request)
  {
    // Validate role fields
    $user_role_validator = Validator::make($request->all(), [
      'newRoleName' => ['required','alpha_space','unique:App\Models\User\Role,name'],
      'newRoleDescription' => ['nullable'],
    ]);
    //Check validation errors
    if($user_role_validator->fails()):
      return response()->json(['errors'=>$user_role_validator->errors()]);
    //Otherwise, Store data to table
    else:
      $role = new Role();
      $role->name = $request->newRoleName;
      $role->description = $request->newRoleDescription;
      if($role->save()):
        return response()->json(['status'=>'success', 'role'=>$role]);
      endif;
    endif;
  }

  public function createStudentPhase(Request $request)
  {
    //Validate phase fields
    $student_phase_validator = Validator::make($request->all(), [
      'newPhaseCode' => ['required','numeric','unique:App\Models\Student\Phase,code'],
      'newPhaseName' => ['required','alpha_space','unique:App\Models\Student\Phase,name'],
      'newPhaseDescription' => ['nullable'],
    ]);
    //Check validation errors
    if($student_phase_validator->fails()):
      return response()->json(['errors'=>$student_phase_validator->errors()]);
    //Otherwise, Store data to table
    else:
      $phase = new Phase();
      $phase->code = $request->newPhaseCode;
      $phase->name = $request->newPhaseName;
      $phase->description = $request->newPhaseDescription;
      if($phase->save()):
        return response()->json(['status'=>'success', 'phase'=>$phase]);
      endif;
    endif;
  }

  public function createPermission(Request $request)
  {
    //Validate permission fields
    $permission_validator = Validator::make($request->all(), [
      'newPermissionName'=> ['required','alpha_space','unique:App\Models\User\Permission,permission'],
      'newPermissionDescription'=> ['nullable'],
    ]);

    //Check validation errors
    if($permission_validator->fails()):
      return response()->json(['errors'=>$permission_validator->errors()]);
    //Otherwise, Store data to table
    else:
      $permission = new Permission();
      $permission->permission = $request->newPermissionName;
      $permission->description = $request->newPermissionDescription;
      if($permission->save()):
        return response()->json(['status'=>'success', 'permission'=>$permission]);
      endif;
    endif;
  }
}
