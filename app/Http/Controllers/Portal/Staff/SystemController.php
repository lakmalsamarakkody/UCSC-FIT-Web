<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Role;
use App\Models\Subject;
use App\Models\Exam\Types;
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

  // USER ROLE
  // CREATE FUNCTION
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
    //Otherwise, Store data to the table
    else:
      $role = new Role();
      $role->name = $request->newRoleName;
      $role->description = $request->newRoleDescription;
      if($role->save()):
        return response()->json(['status'=>'success', 'role'=>$role]);
      endif;
    endif;
    return response()->json(['status'=>'error']);
  }
  // /CREATE FUNCTION

  // DELETE FUNCTION
  public function deleteUserRole(Request $request)
  {
    // VALIDATE ROLE ID
    $roleID_validator = Validator::make($request->all(), [
      'role_id' => ['required','integer','exists:App\Models\User\Role,id'],
    ]);

    // CHECK VALIDATOR FAILS
    if($roleID_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$roleID_validator->errors()]);
    else:
      Role::destroy($request->role_id);
      return response()->json(['status'=>'success']);
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);
  }
  // /DELETE FUNCTION
  // /USER ROLE

  // STUDENT PHASE
  // CREATE FUNCTION
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
    //Otherwise, Store data to the table
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
  // /CREATE FUNCTION
  // /STUDENT PHASE


  // PERMISSION
  // CREATE FUNCTION
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
    //Otherwise, Store data to the table
    else:
      $permission = new Permission();
      $permission->permission = $request->newPermissionName;
      $permission->description = $request->newPermissionDescription;
      if($permission->save()):
        return response()->json(['status'=>'success', 'permission'=>$permission]);
      endif;
    endif;
  }
  // /CREATE FUNCTION

  // DELETE FUNTION 
  public function deletePermission(Request $request){
    $permission_id_validator = Validator::make($request->all(), [
      'permission_id' => ['required', 'integer', 'exists:App\Models\User\Permission,id'],
    ]);

    //Check validator fails
    if($permission_id_validator->fails()):
      return response()->json(['status'=> 'error', 'errors'=>$permission_id_validator->errors()]);
    else:
      Permission::destroy($request->permission_id);
      return response()->json(['status'=>'success']);
    endif;
    return response()->json(['status'=> 'error', 'data'=>$request->all()]);
  }
  // /DELETE FUNTION
  // /PERMISSION

  // SUBJECT
  // CREATE FUNCTION
  public function createSubject(Request $request)
  {
    // Validate subject fields
    $subject_validator = Validator::make($request->all(), [
      'newSubjectCode' => ['required','numeric', 'unique:App\Models\Subject,code'],
      'newSubjectName' => ['required', 'alpha_space','unique:App\Models\Subject,name'],
    ]);
    // Check validation errors
    if($subject_validator->fails()):
      return response()->json(['errors'=>$subject_validator->errors()]);
      //Otherwise, Store data to the table
    else:
      $subject = new Subject();
      $subject->code = $request->newSubjectCode;
      $subject->name = $request->newSubjectName;
      if($subject->save()):
        return response()->json(['status'=>'success', 'subject'=>$subject]);
      endif;
    endif;
  }
  // /CREATE FUNCTION
  // /PERMISSION
}
