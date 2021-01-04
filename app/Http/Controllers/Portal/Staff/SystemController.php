<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Models\User\Role;
use App\Models\Subject;
use App\Models\Exam\Types;
use App\Models\Student\Payment;
use App\Models\Student\Payment\Method;
use App\Models\Student\Payment\Type;
use App\Models\Student\Phase;
use App\Models\User\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

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
    $permissions = Permission::orderby('name')->get();
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
      'newPermissionName'=> ['required','alpha_space','unique:App\Models\User\Permission,name'],
      'newPermissionDescription'=> ['required'],
    ]);

    //Check validation errors
    if($permission_validator->fails()):
      return response()->json(['errors'=>$permission_validator->errors()]);
    //Otherwise, Store data to the table
    else:
      $permission = new Permission();
      $permission->name = $request->newPermissionName;
      $permission->description = $request->newPermissionDescription;
      if($permission->save()):
        return response()->json(['status'=>'success', 'permission'=>$permission]);
      endif;
    endif;
  }
  // /CREATE FUNCTION

  // EDIT FUNCTIONS
  public function editPermissionGetDetails(Request $request){

    //Validate permission id
    $permissionId_validator = Validator::make($request->all(), [
      'permission_id' => ['required', 'integer', 'exists:App\Models\User\Permission,id'],
    ]);

    //Check validator fails
    if($permissionId_validator->fails()):
      return response()->json(['status'=> 'error', 'errors'=>$permissionId_validator->errors()]);
    else:
      $permission = Permission::find($request->permission_id);
      return response()->json(['status'=>'success', 'permission'=>$permission]);
    endif;
    return response()->json(['status'=> 'error', 'data'=>$request->all()]);
  }

  public function editPermission(Request $request)
  {
    //Validating form data
    $edit_permission_validator = Validator::make($request->all(), [
      'permissionID'=>['required', 'integer', 'exists:App\Models\User\Permission,id'],
      'permissionName'=>['required', 'alpha_space'],
      'permissionDescription'=>['required'],
    ]);

    //Check validator fails
    if($edit_permission_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$edit_permission_validator->errors()]);
    else:
      $permission = Permission::find($request->permissionID);
      $permission->name = $request->permissionName;
      $permission->description = $request->permissionDescription;
      if($permission->save()):
        return response()->json(['status'=> 'success', 'permission'=>$permission]);
      endif;
    endif;
  }
  // /EDIT FUNCTIONS

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

  // EDIT FUNCTIONS
  public function editSubjectGetDetails(Request $request)
  {
    //Validate subject id
    $subjectId_validator = Validator::make($request->all(), [
      'subject_id'=> ['required', 'integer', 'exists:App\Models\Subject,id'],
    ]);

    //Check validator fails
    if($subjectId_validator->fails()):
      return response()->json(['status'=> 'error', 'errors'=>$subjectId_validator->errors()]);
    else:
      if($subject = Subject::find($request->subject_id)):
        return response()->json(['status'=>'success', 'subject'=>$subject]);
      endif;
    endif;
    return response()->json(['status'=> 'error', 'data'=>$request->all()]);
  }

  public function editSubject(Request $request)
  {
    //Validate form data
    $edit_subject_validator = Validator::make($request->all(), [
      'subjectId'=> ['required','integer', 'exists:App\Models\Subject,id'],
      'subjectCode'=> ['required', 'integer'],
      'subjectName'=> ['required', 'alpha_space'],
    ]);

    //Check validator fails
    if($edit_subject_validator->fails()):
      return response()->json(['status'=> 'error', 'errors'=>$edit_subject_validator->errors()]);
    else:
      $subject = Subject::find($request->subjectId);
      $subject->code = $request->subjectCode;
      $subject->name = $request->subjectName;
      if($subject->save()):
        return response()->json(['status'=>'success', 'subject'=>$subject]);
      endif;
    endif;
  }
  // /EDIT FUNCTIONS

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
      $exam_type->name = $request->newExamTypeName;
      if($exam_type->save()):
        return response()->json(['status'=>'success', 'exam_type'=>$exam_type]);
      endif;
    endif;
    return response()->json(['status'=>'error']);
  }
  // /CREATE FUNCTION

  // EDIT FUNCTIONS
  public function editExamTypeGetDetails(Request $request)
  {
    //Validate exam type id
    $exam_typeId_validator = Validator::make($request->all(), [
      'exam_type_id' => ['required', 'integer', 'exists:App\Models\Exam\Types,id'],
    ]);

    //Check validator fails
    if($exam_typeId_validator->fails()):
      return response()->json(['status'=> 'error', 'errors'=>$exam_typeId_validator->errors()]);
    else:
      $exam_type = Types::find($request->exam_type_id);
      return response()->json(['status'=>'success', 'exam_type'=>$exam_type]);
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);
  }

  public function editExamType(Request $request)
  {
    //Validate form data
    $edit_exam_type_validator = Validator::make($request->all(), [
      'examTypeId'=> ['required', 'integer', 'exists:App\Models\Exam\Types,id'],
      'examTypeName'=> ['required', 'alpha_dash_space'],
    ]);

    //Check validator fails
    if($edit_exam_type_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$edit_exam_type_validator->errors()]);
    else:
      $exam_type = Types::find($request->examTypeId);
      $exam_type->name = $request->examTypeName;
      if($exam_type->save()):
        return response()->json(['status'=>'success', 'exma_type'=>$exam_type]);
      endif;
    endif;

  }
  // EDIT FUNCTIONS

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
      'newPhaseCode' => ['required','integer','unique:App\Models\Student\Phase,code'],
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

  // EDIT FUNCTIONS
  public function editStudentPhaseGetDetails(Request $request)
  {
    //Validate student phase id
    $student_phaseId_validator = Validator::make($request->all(), [
      'student_phase_id'=> ['required', 'integer', 'exists:App\Models\Student\Phase,id'],
    ]);

    //Check validator fails
    if($student_phaseId_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$student_phaseId_validator->errors()]);
    else:
      if($student_phase = Phase::find($request->student_phase_id)):
        return response()->json(['status'=>'success', 'student_phase'=>$student_phase]);
      endif;
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);
  }

  public function editStudentPhase(Request $request)
  {
    //Validate form data
    $phase = Phase::find($request->phaseId);
    $edit_student_phase_validator = Validator::make($request->all(), [
      'phaseId'=> ['required', 'integer', 'exists:App\Models\Student\Phase,id'],
      'phaseCode'=> ['required', 'integer'],
      'phaseName'=> ['required', 'alpha_space'],
      'phaseDescription'=> ['nullable'],
    ]);

    //Chack validator fails
    if($edit_student_phase_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$edit_student_phase_validator->errors()]);
    else:
      $student_phase = Phase::find($request->phaseId);
      $student_phase->code = $request->phaseCode;
      $student_phase->name = $request->phaseName;
      $student_phase->description = $request->phaseDescription;
      if($student_phase->save()):
        return response()->json(['status'=>'success', 'student_phase'=>$student_phase]);
      endif;
    endif;

  }
  // /EDIT FUNCTIONS

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
      'newPaymentMethod' => ['required','alpha_space','unique:App\Models\Student\Payment\Method,name'],
    ]);
    //Check validation errors
    if($payment_method_validator->fails()):
      return response()->json(['errors'=>$payment_method_validator->errors()]);
    //Otherwise, Store data to the table
    else:
      $payment_method = new Method();
      $payment_method->name = $request->newPaymentMethod;
      if($payment_method->save()):
        return response()->json(['status'=>'success', 'payment_method'=>$payment_method]);
      endif;
    endif;
    return response()->json(['status'=>'error']);
  }
  // /CREATE FUNCTION

  // EDIT FUNCTIONS
  public function editPaymentMethodGetDetails(Request $request)
  {
    //Validate payment method id
    $payment_methodId_validator = Validator::make($request->all(), [
      'payment_method_id'=> ['required', 'integer', 'exists:App\Models\Student\Payment\Method,id'],
    ]);

    //Check validator fails
    if($payment_methodId_validator->fails()):
      return response()->json(['status'=>'erros', 'errors'=>$payment_methodId_validator->errors()]);
    else:
      if($payment_method = Method::find($request->payment_method_id)):
        return response()->json(['status'=>'success', 'payment_method'=>$payment_method]);
      endif;
    endif;
    return response()->json(['status'=> 'error', 'data'=>$request->all()]);
  }

  public function editPaymentMethod(Request $request)
  {
    //Validate form data
    $edit_payment_method_validator = Validator::make($request->all(), [
      'paymentMethodId'=> ['required', 'integer', 'exists:App\Models\Student\Payment\Method,id'],
      'paymentMethodName'=> ['required', 'alpha_space'],
    ]);

    //Check validator fails
    if($edit_payment_method_validator->fails()):
      return response()->json(['status'=> 'error', 'errors'=>$edit_payment_method_validator->errors()]);
    else:
      $payment_method = Method::find($request->paymentMethodId);
      $payment_method->name = $request->paymentMethodName;
      if($payment_method->save()):
        return response()->json(['status'=>'success', 'payment_method'=>$payment_method]);
      endif;
    endif;

  }
  // /EDIT FUNCTIONS

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
      'newPaymentType' => ['required','alpha_dash_space','unique:App\Models\Student\Payment\Type,name'],
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

  // EDIT FUNCTIONS
  public function editPaymentTypeGetDetails(Request $request)
  {
    //Validate payment type id
    $payment_typeId_validator = Validator::make($request->all(), [
      'edit_payment_type_id'=> ['required', 'integer', 'exists:App\Models\Student\Payment\Type,id'],
    ]);

    //Check validator fails
    if($payment_typeId_validator->fails()):
      return response()->json(['status'=> 'error', 'errors'=>$payment_typeId_validator->errors()]);
    else:
      $edit_payment_type = Type::find($request->edit_payment_type_id);
      return response()->json(['status'=>'success', 'edit_payment_type'=>$edit_payment_type]);
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);

  }

  public function editPaymentType(Request $request)
  {
    //Validate form data
    $edit_payment_type_validator = Validator::make($request->all(), [
      'paymentTypeId'=> ['required', 'integer', 'exists:App\Models\Student\Payment\Type,id'],
      'paymentTypeName'=> ['required', 'alpha_dash_space'],
    ]);

    //Check validator fails
    if($edit_payment_type_validator->fails()):
      return response()->json(['status'=> 'error', 'errors'=>$edit_payment_type_validator->errors()]);
    else:
      $payment_type = Type::find($request->paymentTypeId);
      $payment_type->name = $request->paymentTypeName;
      if($payment_type->save()):
        return response()->json(['status'=>'success', 'payment_type'=>$payment_type]);
      endif;
    endif;
  }
  // /EDIT FUNCTIONS

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
