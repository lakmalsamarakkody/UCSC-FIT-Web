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
    $phases = Phase::orderby('code')->get();
    $payment_methods = Method::orderby('id')->get();
    $payment_types = Type::orderby('id')->get();
    return view('portal/staff/system',compact('roles','permissions','subjects','exam_types','payment_methods', 'payment_types', 'phases'));
  }

  // USER ROLE
  // CREATE FUNCTION
  public function createUserRole(Request $request)
  {
    // Validate role form fields
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

  // PERMISSION
  // CREATE FUNCTION
  public function createPermission(Request $request)
  {
    //Validate permission form fields
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

  // DELETE FUNCTION 
  public function deletePermission(Request $request)
  {
    //Validate permission id
    $permissionId_validator = Validator::make($request->all(), [
      'permission_id' => ['required', 'integer', 'exists:App\Models\User\Permission,id'],
    ]);

    //Check validator fails
    if($permissionId_validator->fails()):
      return response()->json(['status'=> 'error', 'errors'=>$permissionId_validator->errors()]);
    else:
      Permission::destroy($request->permission_id);
      return response()->json(['status'=>'success']);
    endif;
    return response()->json(['status'=> 'error', 'data'=>$request->all()]);
  }
  // /DELETE FUNCTION
  // /PERMISSION

  // SUBJECT
  // CREATE FUNCTION
  public function createSubject(Request $request)
  {
    // Validate subject form fields
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

  // DELETE FUNCTION
  public function deleteSubject(Request $request)
  {
    //Validate subject id
    $subjectId_validator = Validator::make($request->all(), [
      'subject_id'=> ['required', 'integer', 'exists:App\Models\Subject,id'],
    ]);

    //Check validator fails
    if($subjectId_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$subjectId_validator->errors()]);
    else:
      if(Subject::destroy($request->subject_id)):
        return response()->json(['status'=> 'success']);
      endif;
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);
  }
  // /DELETE FUNCTION
  // /SUBJECT

  // EXAM TYPE
  // CREATE FUNCTION
  public function createExamType(Request $request)
  {
    //Validate exam type form fields
    $exam_type_validator = Validator::make($request->all(), [
      'newExamTypeName'=> ['required','alpha_dash_space'],
    ]);
    //Check validation errors
    if($exam_type_validator->fails()):
      return response()->json(['errors'=>$exam_type_validator->errors()]);
      //Otherwise, Store data to the table
    else:
      $exam_type = new Types();
      $exam_type->exam_type = $request->newExamTypeName;
      if($exam_type->save()):
        return response()->json(['status'=>'success', 'exam_type'=>$exam_type]);
      endif;
    endif;
    return response()->json(['status'=>'error']);
  }
  // /CREATE FUNCTION

  // DELETE FUNCTION
  public function deleteExamType(Request $request)
  {
    //Validate exam type id
    $exam_type_id_validator = Validator::make($request->all(), [
      'exam_type_id' => ['required', 'integer', 'exists:App\Models\Exam\Types,id'],
    ]);

    //Check validator fails
    if($exam_type_id_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$exam_type_id_validator->errors()]);
    else:
      if(Types::destroy($request->exam_type_id)):
        return response()->json(['status'=>'success']);
      endif;
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);
  }
  // /DELETE FUNCTION
  // /EXAM TYPE

  // STUDENT PHASE
  // CREATE FUNCTION
  public function createStudentPhase(Request $request)
  {
    //Validate phase form fields
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

  // DELETE FUNCTION
  public function deleteStudentPhase(Request $request)
  {
    //Validate phase id
    $phaseId_validator = Validator::make($request->all(), [
      'phase_id' => ['required', 'integer', 'exists:App\Models\Student\Phase,id'],
    ]);

    //Check validator fails
    if($phaseId_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$phaseId_validator->errors()]);
    else:
      Phase::destroy($request->phase_id);
      return response()->json(['status'=> 'success']);
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);
  }
  // /DELETE FUNCTION
  // /STUDENT PHASE

  // PAYMENT METHOD
  // CREATE FUNCTION
  public function createPaymentMethod(Request $request)
  {
    // Validate payment method form fields
    $payment_method_validator = Validator::make($request->all(), [
      'newPaymentMethod' => ['required','alpha_space','unique:App\Models\Student\Payment\Method,method'],
    ]);
    //Check validation errors
    if($payment_method_validator->fails()):
      return response()->json(['errors'=>$payment_method_validator->errors()]);
    //Otherwise, Store data to the table
    else:
      $payment_method = new Method();
      $payment_method->method = $request->newPaymentMethod;
      if($payment_method->save()):
        return response()->json(['status'=>'success', 'payment_method'=>$payment_method]);
      endif;
    endif;
    return response()->json(['status'=>'error']);
  }
  // /CREATE FUNCTION

  // DELETE FUNCTION
  public function deletePaymentMethod(Request $request)
  {
    // VALIDATE payment method id
    $payment_method_id_validator = Validator::make($request->all(), [
      'payment_method_id' => ['required','integer','exists:App\Models\Student\Payment\Method,id'],
    ]);

    // CHECK VALIDATOR FAILS
    if($payment_method_id_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$payment_method_id_validator->errors()]);
    else:
      if(Method::destroy($request->payment_method_id)):
        return response()->json(['status'=>'success']);
      endif;
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);
  }
  // /DELETE FUNCTION
  // /PAYMENT METHOD

  // PAYMENT TYPE
  // CREATE FUNCTION
  public function createPaymentType(Request $request)
  {
    // Validate payment type form fields
    $payment_type_validator = Validator::make($request->all(), [
      'newPaymentType' => ['required','alpha_space','unique:App\Models\Student\Payment\Type,type'],
    ]);
    //Check validation errors
    if($payment_type_validator->fails()):
      return response()->json(['errors'=>$payment_type_validator->errors()]);
    //Otherwise, Store data to the table
    else:
      $payment_type = new Type();
      $payment_type->type = $request->newPaymentType;
      if($payment_type->save()):
        return response()->json(['status'=>'success', 'payment_type'=>$payment_type]);
      endif;
    endif;
    return response()->json(['status'=>'error']);
  }
  // /CREATE FUNCTION

  // DELETE FUNCTION
  public function deletePaymentType(Request $request)
  {
    // VALIDATE Payment type id
    $payment_type_id_validator = Validator::make($request->all(), [
      'payment_type_id' => ['required','integer','exists:App\Models\Student\Payment\Type,id'],
    ]);

    // CHECK VALIDATOR FAILS
    if($payment_type_id_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$payment_type_id_validator->errors()]);
    else:
      Type::destroy($request->payment_type_id);
      return response()->json(['status'=>'success']);
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);
  }
  // /DELETE FUNCTION
  // /PAYMENT TYPE
}
