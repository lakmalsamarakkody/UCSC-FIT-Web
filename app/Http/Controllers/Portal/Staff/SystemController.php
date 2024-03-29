<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam\Duration;
use Illuminate\Http\Request;
use App\Models\User\Role;
use App\Models\Subject;
use App\Models\Exam\Types;
use App\Models\Student\Payment;
use App\Models\Student\Payment\Method;
use App\Models\Student\Payment\Type;
use App\Models\Student\Phase;
use App\Models\User\Permission;
use App\Models\Lab;
use App\Models\User\Role\hasPermission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Mail\Subscribe;
use App\Models\Student;
use App\Models\Subscriber;
use App\Models\Support\Bank;
use App\Models\Support\BankBranch;
use App\Models\Support\Fee;
use App\Models\Support\SlCity;
use App\Models\Support\SlDistrict;
use App\Models\TempStudent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function GuzzleHttp\Promise\all;
use function PHPUnit\Framework\isNull;

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
    $roles = Role::orderby('id')->get();
    $permissions = Permission::orderby('id')->get();
    $subjects = Subject::orderby('id')->get();
    $exam_types = Types::orderby('id')->get();
    $exam_durations = Duration::orderby('id')->get();
    $phases = Phase::orderby('id')->get();
    $payment_methods = Method::orderby('id')->get();
    $payment_types = Type::orderby('id')->get();
    $labs = Lab::orderby('id')->get();
    $banks = Bank::orderby('id')->get();
    $bank_branches = BankBranch::orderby('id')->get();
    $districts = SlDistrict::orderby('id')->get();
    return view('portal/staff/system',compact('roles','permissions','subjects','exam_types', 'exam_durations','payment_methods', 'payment_types', 'phases', 'labs', 'banks', 'bank_branches', 'districts'));
  }

  // PERMISSION
  // PERMISSION TABLE
  public function getPermissions(Request $request)
  {
    if($request->ajax()) {
      $data = Permission::get();
      
      return DataTables::of($data)
      ->rawColumns(['action'])
      ->make(true);
    }
  }
  // /PERMISSION TABLE

  // CREATE FUNCTION
  public function createPermission(Request $request)
  {
    //Validate permission form fields
    $permission_validator = Validator::make($request->all(), [
      'newPermissionName'=> ['required','alpha_dash','unique:App\Models\User\Permission,name'],
      'newPortalName'=> ['required', Rule::in(['staff', 'student'])],
      'newPermissionModule'=>['required', Rule::in(['dashboard', 'student', 'exam', 'result', 'user', 'system', 'website', 'information'])],
      'newPermissionDescription'=> ['required'],
    ]);

    //Check validation errors
    if($permission_validator->fails()):
      return response()->json(['errors'=>$permission_validator->errors()]);
    //Otherwise, Store data to the table
    else:
      $permission = new Permission();
      $permission->name = $request->newPermissionName;
      $permission->portal = $request->newPortalName;
      $permission->module = $request->newPermissionModule;
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
      //'permissionName'=>['required', 'alpha_dash'],
      'portalName'=> ['required', Rule::in(['staff', 'student'])],
      'permissionModule'=>['required', Rule::in(['dashboard', 'student', 'exam', 'result', 'user', 'system', 'website', 'information'])],
      'permissionDescription'=>['required'],
    ]);

    //Check validator fails
    if($edit_permission_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$edit_permission_validator->errors()]);
    else:
      if(Permission::where('id', $request->permissionID)->update([
        //'name' => $request->permissionName,
        'portal' => $request->portalName,
        'module' => $request->permissionModule,
        'description' => $request->permissionDescription,
      ])):
        return response()->json(['status'=> 'success']);
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

  // VIEW FUNCTION
  public function viewUserRoleGetDetails(Request $request)
  {
    $arrayPermissions = array();
    $permissions = Permission::get();
    $role = Role::find($request->role_id);
    foreach($permissions as $permission):
      $hasPermission = $role->hasPermission()->where('permission_id', $permission->id)->first();
      if($hasPermission != NULL):
        $currentPermission = array(array('permission_id' => $permission->id, 'permission_name'=> $permission->name, 'permission_status'=>true));
      else:
        $currentPermission = array(array('permission_id' => $permission->id, 'permission_name'=> $permission->name, 'permission_status'=>false));
      endif;
      $arrayPermissions = array_merge($arrayPermissions, $currentPermission);
    endforeach;
    return response()->json(['status'=>'success', 'role'=>$role, 'arrayPermissions'=>$arrayPermissions]);
  }
  // /VIEW FUNCTION

  // EDIT FUNCTION
  public function editUserRolePermissions(Request $request){
    $role = Role::where('id',$request->role_id)->first();

    //DELETE ALL CURRENT PERMISSIONS
    hasPermission::where('role_id', $role->id)->forceDelete();

    //UPDATE ROLE NAME
    $role->update(['name'=>$request->role_name]);

    // PERMISSION SAVE
    // LOOP HAS BEEND TERMINATED BEFORE LAST 2 ELEMENTS BECAUSE ROLE_ID AND ROLE_NAME COMES ALONG WITH PERMISSION LIST
    // so used array count and break foreach before last 2 elements
    $count = count($request->all());
    $currentCount = 0;
    foreach($request->all() as $permission):
      hasPermission::create(['role_id'=>$role->id, 'permission_id'=>$permission]);
      $currentCount = $currentCount+1;
      if($count == $currentCount+2) break;
    endforeach;
    // /PERMISSION SAVE 

    return response()->json(['status'=>'success', 'request'=>$request->all()]);
  }
  // /EDIT FUNCTION


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
      if(Subject::where('id',$request->subjectId)->update([
        'code' => $request->subjectCode,
        'name' => $request->subjectName
      ])):
        return response()->json(['status'=>'success']);
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
      'newExamTypeName'=> ['required','alpha_dash_space', 'unique:App\Models\Exam\Types,name'],
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
      if(Types::where('id',$request->examTypeId)->update([
        'name' => $request->examTypeName
      ])):
        return response()->json(['status'=>'success']);
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

  // EXAM DURATION
  // CREATE FUNCTION
  public function createExamDuration(Request $request)
  {
    //Validate exam duration form fields
    $exam_duration_validator = Validator::make($request->all(), [
      'newExamDurationSubject'=> ['required','integer'],
      'newExamDurationExamType'=> ['required', 'integer'],
      'newExamDurationHours'=>['required', 'integer', 'max:12', 'min:0'],
      'newExamDurationMinutes'=> ['required', 'integer', 'max:59', 'min:0'],
    ]);

    //Check if the selected exam already exists
    $exists_exam = Duration::where('subject_id',$request->newExamDurationSubject)->where('exam_type_id', $request->newExamDurationExamType)->first();

    //Check validation errors
    if($exam_duration_validator->fails()):
      return response()->json(['errors'=>$exam_duration_validator->errors()]);
    elseif($exists_exam != null):
      return response()->json(['status'=>'error', 'msg'=>'Selected exam already have a duration.']);

    //Otherwise, Store data to the table
    else:
      $duration = new Duration();
      $duration->subject_id = $request->newExamDurationSubject;
      $duration->exam_type_id = $request->newExamDurationExamType;
      $duration->hours = $request->newExamDurationHours;
      $duration->minutes = $request->newExamDurationMinutes;
      if($duration->save()):
        return response()->json(['status'=>'success', 'duration'=>$duration]);
      endif;
    endif;
  }
  // /CREATE FUNCTION

  // EDIT FUNCTION
  public function editExamDuration(Request $request){

    //Validate exam duration id
    $exam_duration_id_validator = Validator::make($request->all(), [
      'exam_duration_id' => ['required', 'integer', 'exists:App\Models\Exam\Duration,id'],
      'exam_duration_hours'  => ['required', 'integer', 'max:12', 'min:0'],
      'exam_duration_minutes'  => ['required', 'integer', 'max:59', 'min:0'],
    ]);

    //Check validator fails
    if($exam_duration_id_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$exam_duration_id_validator->errors()]);
    endif;

    //Update exam duration
      // Duration::where('id', $request->exam_duration_id)->update([
      //   'hours' => $request->exam_duration_hours,
      //   'minutes' => $request->exam_duration_minutes,
      // ]);
    $duration = Duration::find($request->exam_duration_id);
    $duration->hours = $request->exam_duration_hours;
    $duration->minutes = $request->exam_duration_minutes;
    if($duration->save()):
      return response()->json(['status'=>'success', 'hours'=>$request->exam_duration_hours, 'minutes'=>$request->exam_duration_minutes ]);
    endif;
    return response()->json(['status'=>'error', 'request'=>$request->all()]);
  }
  // /EDIT FUNCTION

  // DELETE FUNCTION
  public function deleteExamDuration(Request $request)
  {
    //Validate duration id
    $durationId_validator = Validator::make($request->all(), [
      'exam_duration_id' => ['required', 'integer', 'exists:exam_durations,id'],
    ]);

    //Check validator fails
    if($durationId_validator->fails()):
      return response()->json(['status'=>'errors', 'errors'=>$durationId_validator->errors()]);
    else:
      if(Duration::destroy($request->exam_duration_id)):
        return response()->json(['status'=> 'success']);
      endif;
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);
  }
  // /DELETE FUNCTION
  // /EXAM DURATION

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
      if(Phase::where('id',$request->phaseId)->update([
        'code' => $request->phaseCode,
        'name' => $request->phaseName,
        'description' => $request->phaseDescription
      ])):
        return response()->json(['status'=>'success']);
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
      if(Method::where('id', $request->paymentMethodId)->update([
        'name' => $request->paymentMethodName
      ])):
        return response()->json(['status'=>'success']);
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
      $payment_type->name = $request->newPaymentType;
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
      if(Type::where('id', $request->paymentTypeId)->update([
        'name' => $request->paymentTypeName
      ])):
        return response()->json(['status'=>'success']);
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

  // LAB
  // CREATE FUNCTION
  public function createLab(Request $request)
  {
    //Validatinng form data
    $lab_validator = Validator::make($request->all(), [
      'newLabName' => ['required', 'unique:labs,name'],
      'newLabCapacity' => ['required', 'integer'],
      'newLabStatus' => ['required', Rule::in(['Active', 'Deactive'])],
    ]);

    // Check validation errors
    if($lab_validator->fails()):
      return response()->json(['errors'=>$lab_validator->errors()]);
    else:
      $lab = new Lab();
      $lab->name = $request->newLabName;
      $lab->capacity = $request->newLabCapacity;
      $lab->status = $request->newLabStatus;
      if($lab->save()):
        return response()->json(['status'=>'success', 'lab'=>$lab]);
      endif;
    endif;
    return response()->json(['status'=>'error']);

  }
  // /CREATE FUNCTION
  // EDIT FUNCTIONS
  public function editLabGetDetails(Request $request)
  {
    //Validate lab id
    $lab_id_validator = Validator::make($request->all(), [
      'lab_id'=> ['required', 'integer', 'exists:labs,id']
    ]);

    //Check validator fails
    if($lab_id_validator->fails()):
      return response()->json(['status'=>'error']);
    else:
      if($lab = Lab::find($request->lab_id)):
        return response()->json(['status'=>'success', 'lab'=>$lab]);
      endif;
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);
    
  }

  public function editLab(Request $request)
  {
    //Validate lab data
    $edit_lab_validator = Validator::make($request->all(), [
      'labId'=> ['required', 'integer', 'exists:labs,id'],
      'labCapacity'=> ['required', 'integer'],
      'labStatus'=> ['required', Rule::in(['Active', 'Deactive'])],
    ]);

    //Check validator fails
    if($edit_lab_validator->fails()):
      return response()->json(['errors'=>$edit_lab_validator->errors()]);
    else:
      if(Lab::where('id', $request->labId)->update([
        'capacity' => $request->labCapacity,
        'status' => $request->labStatus,
      ])):
      return response()->json(['status'=>'success']);
      endif;
    endif;
  }
  // /EDIT FUNCTIONS
  // DELETE FUNCTION
  public function deletelab(Request $request)
  {
    // VALIDATE Payment type id
    $lab_id_validator = Validator::make($request->all(), [
      'lab_id' => ['required','integer','exists:App\Models\Lab,id'],
    ]);

    // CHECK VALIDATOR FAILS
    if($lab_id_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$lab_id_validator->errors()]);
    else:
      Lab::destroy($request->lab_id);
      return response()->json(['status'=>'success']);
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);
  }
  // /DELETE FUNCTION
  // /LAB

  // BANK
  // CREATE FUNCTION
  public function createBank(Request $request)
  {
    //Validatinng form data
    $bank_validator = Validator::make($request->all(), [
      'newBankName' => ['required', 'unique:banks,name'],
    ]);

    // Check validation errors
    if($bank_validator->fails()):
      return response()->json(['errors'=>$bank_validator->errors()]);
    else:
      $bank = new bank();
      $bank->name = $request->newBankName;
      if($bank->save()):
        return response()->json(['status'=>'success', 'bank'=>$bank]);
      endif;
    endif;
    return response()->json(['status'=>'error']);
  }
  // /CREATE FUNCTION
  // EDIT FUNCTIONS
  public function editBankGetDetails(Request $request)
  {
    //Validate payment type id
    $bankId_validator = Validator::make($request->all(), [
      'bank_id'=> ['required', 'integer', 'exists:App\Models\Support\Bank,id'],
    ]);

    //Check validator fails
    if($bankId_validator->fails()):
      return response()->json(['status'=> 'error', 'errors'=>$bankId_validator->errors()]);
    else:
      $bank = Bank::find($request->bank_id);
      return response()->json(['status'=>'success', 'bank'=>$bank]);
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);

  }

  public function editBank(Request $request)
  {
    //Validate form data
    $edit_bank_validator = Validator::make($request->all(), [
      'editBankId'=> ['required', 'integer', 'exists:App\Models\Support\Bank,id'],
      'editBankName'=> ['required', 'alpha_dash_space'],
    ]);

    //Check validator fails
    if($edit_bank_validator->fails()):
      return response()->json(['status'=> 'error', 'errors'=>$edit_bank_validator->errors()]);
    else:
      if(Bank::where('id', $request->editBankId)->update([
          'name' => $request->editBankName
        ])):
        return response()->json(['status'=>'success']);
      endif;
    endif;
  }
  // /EDIT FUNCTIONS
  // DELETE FUNCTION
  public function deleteBank(Request $request)
  {
    // VALIDATE Payment type id
    $bank_id_validator = Validator::make($request->all(), [
      'bank_id' => ['required','integer','exists:App\Models\Support\Bank,id'],
    ]);

    // CHECK VALIDATOR FAILS
    if($bank_id_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$bank_id_validator->errors()]);
    else:
      Bank::destroy($request->bank_id);
      return response()->json(['status'=>'success']);
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);
  }
  // /DELETE FUNCTION
  // /BANK

// BANK BRANCH
  // CREATE FUNCTION
  public function createBankBranch(Request $request)
  {
    //Validatinng form data
    $bankBranch_validator = Validator::make($request->all(), [
      'newBankBranchBank' => ['required', 'integer', 'exists:App\Models\Support\Bank,id'],
      'newBankBranchDistrict' => ['required', 'integer', 'exists:App\Models\Support\SlDistrict,id'],
      'newBankBranchCode' => ['required'],
      'newBankBranchName' => ['required'],
    ]);

    // Check validation errors
    if($bankBranch_validator->fails()):
      return response()->json(['errors'=>$bankBranch_validator->errors()]);
    else:
      $bankBranch = new BankBranch();
      $bankBranch->bank_id = $request->newBankBranchBank;
      $bankBranch->district_id = $request->newBankBranchDistrict;
      $bankBranch->code = $request->newBankBranchCode;
      $bankBranch->name = $request->newBankBranchName;
      if($bankBranch->save()):
        return response()->json(['status'=>'success', 'bankBranch'=>$bankBranch]);
      endif;
    endif;
    return response()->json(['status'=>'error']);
  }
  // /CREATE FUNCTION
  // EDIT FUNCTIONS
  public function editBankBranchGetDetails(Request $request)
  {
    //Validate payment type id
    $bank_branchId_validator = Validator::make($request->all(), [
      'bank_branch_id'=> ['required', 'integer', 'exists:App\Models\Support\BankBranch,id'],
    ]);

    //Check validator fails
    if($bank_branchId_validator->fails()):
      return response()->json(['status'=> 'error', 'errors'=>$bank_branchId_validator->errors()]);
    else:
      $bank_branch = BankBranch::find($request->bank_branch_id);
      return response()->json(['status'=>'success', 'bank_branch'=>$bank_branch]);
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);
  }

  public function editBankBranch(Request $request)
  {
    //Validate form data
    $edit_bank_branch_validator = Validator::make($request->all(), [
      'editBankBranchId'=> ['required', 'integer', 'exists:App\Models\Support\BankBranch,id'],
      'editBankBranchBank' => ['required', 'integer', 'exists:App\Models\Support\Bank,id'],
      'editBankBranchDistrict' => ['required', 'integer', 'exists:App\Models\Support\SlDistrict,id'],
      'editBankBranchCode' => ['required'],
      'editBankBranchName' => ['required'],
    ]);

    //Check validator fails
    if($edit_bank_branch_validator->fails()):
      return response()->json(['status'=> 'error', 'errors'=>$edit_bank_branch_validator->errors()]);
    else:
      if(BankBranch::where('id', $request->editBankBranchId)->update([
        'bank_id' => $request->editBankBranchBank,
        'district_id' => $request->editBankBranchDistrict,
        'code' => $request->editBankBranchCode,
        'name' => $request->editBankBranchName
      ])):
        return response()->json(['status'=>'success']);
      endif;
    endif;
  }
  // /EDIT FUNCTIONS
  // DELETE FUNCTION
  public function deleteBankBranch(Request $request)
  {
    // VALIDATE Payment type id
    $bank_branch_id_validator = Validator::make($request->all(), [
      'bank_branch_id' => ['required','integer','exists:App\Models\Support\BankBranch,id'],
    ]);

    // CHECK VALIDATOR FAILS
    if($bank_branch_id_validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$bank_branch_id_validator->errors()]);
    else:
      BankBranch::destroy($request->bank_branch_id);
      return response()->json(['status'=>'success']);
    endif;
    return response()->json(['status'=>'error', 'data'=>$request->all()]);
  }
  // /DELETE FUNCTION
// /BANK BRANCH

  // IMPORT STUDENTS
  public function StudentImport(Request $request)
  {
    // ================
    TempStudent::truncate();
    // ================
    $validator = Validator::make($request->all(), 
      [
        'studentImportFile'=>['required', 'mimes:xls,xlsx']
      ]
    );
    if($validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$validator->errors()]);
    else:
      $file = $request->file('studentImportFile');
      // IMPORT EXCEL SHEET TO TEMPORARY
      if(Excel::import(new StudentsImport, $file)):

        // INITIALIZE CREATING RECORDS
        $tempStudents = TempStudent::get();
        if($tempStudents):

          // VALIDATE BEFORE CREATING RECORDS
            foreach($tempStudents as $tempStudent):

              set_time_limit(0);

              // CHECK FOR MANDATORY FILEDS
              if(!$tempStudent->reg_no || !$tempStudent->unique_id /*|| !$tempStudent->email*/):
                return response()->json(['status'=>'error', 'errors'=> [ 'Insufficient Data' => 'RegNo, NIC and Email fields are mandatory for all students']]);
              endif;

              // CHECK FOR INVALID REGISTRATION NUMBERS
              if(!preg_match('/^[F][0-9]{2}(0[1-9]|10|11|12)([0-2][0-9]|30|31)[0-9]{3}$/',$tempStudent->reg_no)):
                return response()->json(['status'=>'error', 'errors'=> [ 'Invalid Registration Number' => 'error on : '.$tempStudent->reg_no]]);
              endif;

              // CHECK FOR UNIQUES
              if( TempStudent::where('reg_no', $tempStudent->reg_no)->get()->count() > 1 ||
                  TempStudent::where('unique_id', $tempStudent->unique_id)->get()->count() > 1 /*||
                  TempStudent::where('email', $tempStudent->email)->get()->count() > 1 */
              ):
              return response()->json(['status'=>'error', 'errors'=> [ 'Aborted' => 'Duplicate found in your data sheet regarding : '.$tempStudent->reg_no]]);
            endif;

              // CHECK FOR EXISTING RECORDS
              if( Student::where('reg_no', $tempStudent->reg_no)->first() ||
                  Student::where('nic_old', $tempStudent->unique_id)->first() ||
                  Student::where('nic_new', $tempStudent->unique_id)->first() ||
                  Student::where('postal', $tempStudent->unique_id)->first() ||
                  Student::where('passport', $tempStudent->unique_id)->first() ||
                  User::where('email', $tempStudent->email)->first() ||
                  User::where('email', strtolower($tempStudent->reg_no)."@fit.ucsc.ac.lk")->first()
              ):
                return response()->json(['status'=>'error', 'errors'=> [ 'Aborted' => 'Existing record found in the database regarding : '.$tempStudent->reg_no]]);
              endif;
            endforeach;
          // /VALIDATE BEFORE CREATING RECORDS

          // CREATE RECORDS
            foreach($tempStudents as $tempStudent):
              
              // CONFIGURE DETAILS
              set_time_limit(0);

                // USER RECORD
                if(TempStudent::where('email', $tempStudent->email)->get()->count() > 1 || $tempStudent->email == NULL):
                  $userEmail = strtolower($tempStudent->reg_no)."@fit.ucsc.ac.lk";
                else:
                 $userEmail = $tempStudent->email;
                endif;

                // STUDENT RECORD
                  $title = $first_name = $middle_name = $last_name = $full_name = $initials = $dob = $gender = $unique_type = $telephone_country_code = $telephone = $reg_year = $permanent_city_id = $citizenship = $permanent_country_id = $designation = $bank_branch_id = NULL;
                  $dt = now();

                  // SET NAMES
                    $full_name = ucwords(strtolower($tempStudent->full_name));
                    $last_name = ucwords(strtolower($tempStudent->last_name));
                    $initials = strtoupper($tempStudent->initials);
                    $title = ucfirst(strtolower($tempStudent->title));

                    //FIRST, MIDDLE
                    if(str_word_count($full_name)>2):
                      $names = explode(" ", $full_name);
                      $first_name = $names[count($names)-2];
                      for($x=0; $x<=count($names)-3; $x++):
                        $middle_name .= $names[$x]." ";
                      endfor;
                    elseif(str_word_count($full_name)==2):
                      $names = explode(" ", $full_name,2);
                      $first_name = $names[0];
                    else:
                      $first_name = $full_name;
                    endif;
                  // SET NAMES

                  //DOB, GENDER
                  if($tempStudent->dob): 
                    $dob=$tempStudent->dob;
                  endif;
                  if($tempStudent->gender):
                    if($tempStudent->gender == "M"):
                    $gender = "Male";
                    else:
                    $gender = "Female";
                    endif;
                  endif;

                  //TELEPHONE
                  if($tempStudent->telephone):
                    if(strlen($tempStudent->telephone)>=9)
                    $telephone_country_code = 94;
                    $telephone = $tempStudent->telephone;
                  endif;

                  //CITY
                  $city = SlCity::where('name','like', '%'.$tempStudent->city.'%')->first();
                  if($city):
                    $permanent_city_id = $city->id;
                  endif;

                  // CITIZENSHIP
                  if($tempStudent->citizenship):
                    if($tempStudent->citizenship == "SL"):
                      $citizenship = 'Sri Lankan';
                      $permanent_country_id = 67;
                    else:
                      $citizenship = $tempStudent->citizenship;
                    endif;
                  else:
                    $citizenship = 'Sri Lankan';
                    $permanent_country_id = 67;
                  endif;
                  // /CITIZENSHIP

                  // DESIGNATION
                  $designation = ucwords(strtolower($tempStudent->designation));

                  //REG YEAR
                  $reg_year = '20'.substr($tempStudent->reg_no, 1, 2);
                  
                  // CHECK UNIQUE TYPE
                    if(preg_match('/^[0-9]{9}[V|v]$/',$tempStudent->unique_id)):
                      $unique_type = 'nic_old';
                    elseif(preg_match('/^[0-9]{12}$/',$tempStudent->unique_id)):
                      $unique_type = 'nic_new';
                    elseif(preg_match('/^[N|n][0-9]{7}$/',$tempStudent->unique_id)):
                      $unique_type = 'passport';
                    else:
                      $unique_type = 'postal';
                    endif;
                  // /CHECK UNIQUE TYPE
                // /STUDENT RECORD

                // STUDENT REGISTRATION RECORD
                  $registeredAt = Carbon::createFromFormat('Ymd','20'.substr($tempStudent->reg_no, 1, 6))->isoFormat('Y-MM-DD');
                  $registrationExpireAt = Carbon::create($registeredAt)->addYear()->subDay()->isoFormat('Y-MM-DD');
                // /STUDENT REGISTRATION RECORD

                // PAYMENT RECORD
                  // AMOUNT
                  if($tempStudent->reg_fee):
                    $registrationFee = $tempStudent->reg_fee;
                  else:
                    if(Fee::where('purpose', 'registration')->first()):
                      $registrationFee = Fee::where('purpose', 'registration')->first()->amount;
                    else:
                      $registrationFee = 2750;
                    endif;
                  endif;

                  //BRANCH
                  if($tempStudent->paid_branch):
                    $branchID = BankBranch::where('name', 'like', '%'.$tempStudent->paid_branch.'%')->first();
                    if($branchID):
                      $bank_branch_id = $branchID->id;
                    endif;
                  endif;
                // /PAYMENT RECORD

              // /CONFIGURE DETAILS

              // CREATE USER
                $user = new User();
                $user->name = $first_name;
                $user->email = $userEmail;
                $user->password = Hash::make($tempStudent->unique_id);

                if($user->save()):

                  // CREATE SUBSCRIBER RECORD
                  $existingSubscriber = Subscriber::where('email', $userEmail)->first();
                  if(!$existingSubscriber):
                    $token = Str::random(32);
                    $subscriber = new Subscriber();
                    $subscriber->email = $userEmail;
                    $subscriber->token = $token;
                    $subscriber->save();
                  endif;
                  
                  // CREATE STUDENT
                    $student = new Student();
                    $student->reg_no = $tempStudent->reg_no;
                    $student->user_id = $user->id;
                    $student->title = $title;
                    $student->first_name = $first_name;
                    $student->middle_names = $middle_name;
                    $student->last_name = $last_name;
                    $student->full_name = $full_name;
                    $student->initials = $initials;
                    $student->dob = $dob;
                    $student->gender = $gender;
                    $student->citizenship = $citizenship;
                    $student->$unique_type = $tempStudent->unique_id;
                    $student->permanent_house = ucwords(strtolower($tempStudent->permanent_address_line1));
                    $student->permanent_address_line1 = ucwords(strtolower($tempStudent->permanent_address_line2));
                    $student->permanent_address_line2 = ucwords(strtolower($tempStudent->permanent_address_line3));
                    $student->permanent_city_id = $permanent_city_id;
                    $student->permanent_country_id = $permanent_country_id;
                    $student->designation = $designation;
                    $student->telephone_country_code = $telephone_country_code;
                    $student->telephone = $telephone;
                    $student->reg_year = $reg_year;

                    if($student->save()):

                      // CREATE STUDENT FLAG RECORD
                        if($student->flag()->create(['info_complete'=>1, 'info_editable'=>0, 'declaration'=>1, 'bit_eligible'=>0, 'fit_cert'=>0, 'phase_id'=>1, 'enrollment'=>'existing',])):
                          
                          // CREATE STUDENT REGISTRATION RECORD
                            // REGISTRATION PAYMENT
                            $payment = new Payment();
                            $payment->method_id = 2;
                            $payment->type_id = 1;
                            $payment->student_id = $student->id;
                            $payment->amount = $registrationFee;
                            $payment->bank_id = 1;
                            $payment->bank_branch_id = $bank_branch_id;
                            $payment->paid_date = $tempStudent->paid_date;
                            $payment->status = 'Approved';
                            if($payment->save() && $student->registration()->create(['registered_at'=>$registeredAt, 'registration_expire_at'=>$registrationExpireAt, 'application_submit'=>1, 'application_status'=>'Approved', 'document_submit'=>1, 'document_status'=>'Approved', 'payment_id'=>$payment->id, 'payment_status'=> 'Approved', 'status'=>1])):
                              TempStudent::destroy($tempStudent->id);
                              continue;
                            else:
                              return response()->json(['status'=>'error', 'errors'=> [ 'Error occured' => 'while creating student registration record for '.$tempStudent->reg_no]]);
                            endif;
                          // /CREATE STUDENT REGISTRATION RECORD
                        else:
                          return response()->json(['status'=>'error', 'errors'=> [ 'Error occured' => 'while creating student flag record for '.$tempStudent->reg_no]]);
                        endif;
                      // /CREATE STUDENT FLAG RECORD
                    else:
                      return response()->json(['status'=>'error', 'errors'=> [ 'Error occured' => 'while creating student record for '.$tempStudent->reg_no]]);
                    endif;
                  // /CREATE STUDENT
                else:
                  return response()->json(['status'=>'error', 'errors'=> [ 'Error occured' => 'while creating user record for '.$tempStudent->reg_no]]);
                endif;
            endforeach;
            set_time_limit(60);
            return response()->json(['status'=>'success']);
          // /CREATE RECORDS

        endif;
        // /INITIALIZE CREATING RECORDS
      else:
        return response()->json(['status'=>'error', 'errors'=> [ 'Aborted' => 'Please check your data sheet for duplicates']]);
      endif;
    endif;
    return response()->json(['status'=>'error']);
  }
  // /IMPORT STUDENTS

  // IMPORT STUDENTS - OLD STRUCTURE
  /*public function StudentImportOld(Request $request)
  {
    ================
    TempStudent::truncate();
    ================
    $validator = Validator::make($request->all(), 
      [
        'studentImportFile'=>['required', 'mimes:xls,xlsx']
      ]
    );
    if($validator->fails()):
      return response()->json(['status'=>'error', 'errors'=>$validator->errors()]);
    else:
      $file = $request->file('studentImportFile');
      IMPORT EXCEL SHEET TO TEMPORARY
      if(Excel::import(new StudentsImport, $file)):

        INITIALIZE CREATING RECORDS
        $tempStudents = TempStudent::get();
        if($tempStudents):

          VALIDATE BEFORE CREATING RECORDS
            foreach($tempStudents as $tempStudent):
              CHECK FOR MANDATORY FILEDS
              if(!$tempStudent->reg_no || !$tempStudent->unique_id || !$tempStudent->email):
                return response()->json(['status'=>'error', 'errors'=> [ 'Insufficient Data' => 'RegNo, NIC and Email fields are mandatory for all students']]);
              endif;

              CHECK FOR INVALID REGISTRATION NUMBERS
              if(!preg_match('/^[F][0-9]{2}(0[1-9]|10|11|12)([0-2][0-9]|30|31)[0-9]{3}$/',$tempStudent->reg_no)):
                return response()->json(['status'=>'error', 'errors'=> [ 'Invalid Registration Number' => 'error on : '.$tempStudent->reg_no]]);
              endif;

              CHECK FOR EXISTING RECORDS
              if( Student::where('reg_no', $tempStudent->reg_no)->first() ||
                  Student::where('nic_old', $tempStudent->unique_id)->first() ||
                  Student::where('nic_new', $tempStudent->unique_id)->first() ||
                  Student::where('postal', $tempStudent->unique_id)->first() ||
                  Student::where('passport', $tempStudent->unique_id)->first() ||
                  User::where('email', $tempStudent->email)->first()
              ):
                return response()->json(['status'=>'error', 'errors'=> [ 'Aborted' => 'Existing record found regarding : '.$tempStudent->reg_no]]);
              endif;
            endforeach;
          /VALIDATE BEFORE CREATING RECORDS

          CREATE RECORDS
            foreach($tempStudents as $tempStudent):

              CONFIGURE DETAILS
                STUDENT RECORD
                  $title = $first_name = $middle_name = $last_name = $full_name = $initials = $dob = $gender = $unique_type = $telephone_country_code = $telephone = $reg_year = NULL;
                  $dt = now();

                  SET NAMES
                    FULL NAME
                    $full_name = strtolower($tempStudent->full_name);
                    $full_name = ucwords($full_name);

                    FIRST, MIDDLE, LAST NAMES
                    if(str_word_count($full_name)>2):
                      $names = explode(" ", $full_name);
                      $first_name = $names[count($names)-2];
                      for($x=0; $x<=count($names)-3; $x++):
                        $middle_name .= $names[$x]." ";
                      endfor;
                      $last_name = $names[count($names)-1];
                    elseif(str_word_count($full_name)==2):
                      $names = explode(" ", $full_name,2);
                      $first_name = $names[0];
                      $last_name = $names[1];
                    else:
                      $first_name = $full_name;
                    endif;

                    INITIALS
                    for($y=0; $y<= count($names)-2;$y++):
                      $initials.=$names[$y][0];
                    endfor;
                  SET NAMES

                  TELEPHONE
                  if($tempStudent->telephone):
                    if(strlen($tempStudent->telephone)>=9)
                    $telephone_country_code = 94;
                    $telephone = $tempStudent->telephone;
                  endif;

                  DESIGNATION
                  $designation = strtolower($tempStudent->designation);
                  $designation = ucwords($designation);

                  REG YEAR
                  $reg_year = '20'.substr($tempStudent->reg_no, 1, 2);
                  
                  CHECK UNIQUE TYPE
                    if(preg_match('/^[0-9]{9}[V|v]$/',$tempStudent->unique_id)):
                      TITLE, GENDER, DOB, UNIQUE TYPE
                      $unique_type = 'nic_old';
                      $year = '19'.substr($tempStudent->unique_id, 0, 2);
                      $days = substr($tempStudent->unique_id, 2, 3);
                      if($days>500): 
                        $days -=500;
                        $gender = 'Female';
                        $title = 'Miss';
                      else:
                        $gender = 'Male';
                        $title = 'Mr';
                      endif;
                      $dt->set('year', $year);
                      $isLeapYear = $dt->isLeapYear();
                      if($isLeapYear):
                        $dob = $dt->dayOfYear($days)->isoFormat('Y-MM-DD');
                      else:
                        $dob = $dt->dayOfYear($days-1)->isoFormat('Y-MM-DD');
                      endif;
                    elseif(preg_match('/^[0-9]{12}$/',$tempStudent->unique_id)):
                      TITLE, GENDER, DOB, UNIQUE TYPE
                      $unique_type = 'nic_new';
                      $year = substr($tempStudent->unique_id, 0, 4);
                      $days = substr($tempStudent->unique_id, 4, 3);
                      if($days>500): 
                        $days -=500;
                        $gender = 'Female';
                        $title = 'Miss';
                      else:
                        $gender = 'Male';
                        $title = 'Mr';
                      endif;
                      $dt->set('year', $year);
                      $isLeapYear = $dt->isLeapYear();
                      if($isLeapYear):
                        $dob = $dt->dayOfYear($days)->isoFormat('Y-MM-DD');
                      else:
                        $dob = $dt->dayOfYear($days-1)->isoFormat('Y-MM-DD');
                      endif;
                    elseif(preg_match('/^[N|n][0-9]{7}$/',$tempStudent->unique_id)):
                      $unique_type = 'passport';
                    else:
                      $unique_type = 'postal';
                    endif;
                  /CHECK UNIQUE TYPE
                /STUDENT RECORD

                STUDENT REGISTRATION RECORD
                  $registeredAt = Carbon::createFromFormat('Ymd','20'.substr($tempStudent->reg_no, 1, 6))->isoFormat('Y-MM-DD');
                  $registrationExpireAt = Carbon::create($registeredAt)->addYear()->subDay()->isoFormat('Y-MM-DD');
                /STUDENT REGISTRATION RECORD

                PAYMENT RECORD
                if(Fee::where('purpose', 'registration')->first()):
                  $registrationFee = Fee::where('purpose', 'registration')->first()->amount;
                else:
                  $registrationFee = '2750';
                endif;
                /PAYMENT RECORD

              /CONFIGURE DETAILS

              CREATE USER
                $user = new User();
                $user->name = $first_name;
                $user->email = $tempStudent->email;
                $user->password = Hash::make($tempStudent->unique_id);

                if($user->save()):
                  
                  CREATE STUDENT
                    $student = new Student();
                    $student->reg_no = $tempStudent->reg_no;
                    $student->user_id = $user->id;
                    $student->title = $title;
                    $student->first_name = $first_name;
                    $student->middle_names = $middle_name;
                    $student->last_name = $last_name;
                    $student->full_name = $full_name;
                    $student->initials = $initials;
                    $student->dob = $dob;
                    $student->gender = $gender;
                    $student->citizenship = 'Sri Lankan';
                    $student->$unique_type = $tempStudent->unique_id;
                    $student->permanent_country_id = 67;
                    $student->designation = $designation;
                    $student->telephone_country_code = $telephone_country_code;
                    $student->telephone = $telephone;
                    $student->reg_year = $reg_year;

                    if($student->save()):

                      CREATE STUDENT FLAG RECORD
                        if($student->flag()->create(['info_complete'=>1, 'info_editable'=>0, 'declaration'=>1, 'bit_eligible'=>0, 'fit_cert'=>0, 'phase_id'=>1, 'enrollment'=>'existing',])):
                          
                          CREATE STUDENT REGISTRATION RECORD
                            REGISTRATION PAYMENT
                            $payment = new Payment();
                            $payment->method_id = 2;
                            $payment->type_id = 1;
                            $payment->student_id = $student->id;
                            $payment->amount = $registrationFee;
                            $payment->bank_id = 1;
                            $payment->paid_date = $registeredAt;
                            $payment->status = 'Approved';
                            if($payment->save() && $student->registration()->create(['registered_at'=>$registeredAt, 'registration_expire_at'=>$registrationExpireAt, 'application_submit'=>1, 'application_status'=>'Approved', 'document_submit'=>1, 'document_status'=>'Approved', 'payment_id'=>$payment->id, 'payment_status'=> 'Approved', 'status'=>1])):
                              TempStudent::destroy($tempStudent->id);
                              continue;
                            else:
                              return response()->json(['status'=>'error', 'errors'=> [ 'Error occured' => 'while creating student registration record for '.$tempStudent->reg_no]]);
                            endif;
                          /CREATE STUDENT REGISTRATION RECORD
                        else:
                          return response()->json(['status'=>'error', 'errors'=> [ 'Error occured' => 'while creating student flag record for '.$tempStudent->reg_no]]);
                        endif;
                      /CREATE STUDENT FLAG RECORD
                    else:
                      return response()->json(['status'=>'error', 'errors'=> [ 'Error occured' => 'while creating student record for '.$tempStudent->reg_no]]);
                    endif;
                  /CREATE STUDENT
                else:
                  return response()->json(['status'=>'error', 'errors'=> [ 'Error occured' => 'while creating user record for '.$tempStudent->reg_no]]);
                endif;
            endforeach;
            return response()->json(['status'=>'success']);
          /CREATE RECORDS

        endif;
        /INITIALIZE CREATING RECORDS
      else:
        return response()->json(['status'=>'error', 'errors'=> [ 'Aborted' => 'Please check your data sheet for duplicates']]);
      endif;
    endif;
    return response()->json(['status'=>'error']);
  }*/
  // /IMPORT STUDENTS - OLD STRUCTURE
}
