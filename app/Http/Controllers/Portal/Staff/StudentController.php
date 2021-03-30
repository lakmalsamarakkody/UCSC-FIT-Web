<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Mail\ChangeEmail;
use App\Models\Student;
use App\Models\Student\Registration;
use App\Models\Student\hasExam;
use App\Models\Student\Medical;
use App\Models\Exam\Schedule;
use App\Models\Exam\Types;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('staff.auth');
    }

    public function index(Request $request)
    {
        $students = Student::orderBy('id', 'desc');

        if ($request->year != null) {
            $students = $students->where('reg_year', $request->year);
        }

        $students = $students->paginate(10);
        return view('portal/staff/students', compact('students'));
    }

    public function getStudentList(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::join('student_flags', 'students.id', '=', 'student_flags.student_id');
            if($request->name!=null){
                $data = $data->where('first_name','like', '%'. $request->name.'%')
                ->orWhere('last_name','like', '%'. $request->name.'%')
                ->orWhere('full_name','like', '%'. $request->name.'%')
                ->orWhere('initials','like', '%'. $request->name.'%')
                ->orWhere('middle_names','like', '%'. $request->name.'%');
            }
            if($request->regNo!=null){
                $data = $data->where('reg_no','like', '%'. $request->regNo.'%');
            }
            if($request->year!=null){
                $data = $data->where('reg_year',$request->year);
            }
            if($request->nic!=null){
                $data = $data->where('nic_old','like','%'. $request->nic.'%')
                ->orWhere('nic_new','like', '%'. $request->nic.'%')
                ->orWhere('postal','like', '%'. $request->nic.'%')
                ->orWhere('Passport','like', '%'. $request->nic.'%');
            }
            if($request->fit!=null){
                $data = $data->where('fit_cert',$request->fit);
            }
            if($request->bit!=null){
                $data = $data->where('bit_eligible',$request->bit);
            }
            if($request->search!=null){
                $data = $data->where('first_name','like', '%'. $request->search.'%')
                ->orWhere('last_name','like', '%'. $request->search.'%')
                ->orWhere('full_name','like', '%'. $request->search.'%')
                ->orWhere('initials','like', '%'. $request->search.'%')
                ->orWhere('middle_names','like', '%'. $request->search.'%')
                ->orWhere('reg_year', $request->search)
                ->orwhere('nic_old','like','%'. $request->search.'%')
                ->orWhere('nic_new','like', '%'. $request->search.'%')
                ->orWhere('postal','like', '%'. $request->search.'%')
                ->orWhere('Passport','like', '%'. $request->search.'%')
                ->orWhere('dob','like', '%'. $request->search.'%')
                ->orWhere('gender','like', '%'. $request->search.'%')
                ->orWhere('citizenship','like', '%'. $request->search.'%')
                ->orWhere('permanent_house','like', '%'. $request->search.'%')
                ->orWhere('current_house','like', '%'. $request->search.'%')
                ->orwhere('designation','like','%'. $request->search.'%')
                ->orWhere('telephone','like', '%'. $request->search.'%')
                ->orWhere('title',$request->search)
                ->orWhere('education','like', '%'. $request->search.'%');
              }
            $data = $data->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function viewStudent($id)
    {
        $student = Student::find($id);
        $registration = Registration::where('student_id', $id)->latest()->first();
        $medical_submitted_exams = hasExam::where('student_id', $id)->where('medical_id', '!=', null)->get();
        return view('portal/staff/student/profile', compact('student', 'registration', 'medical_submitted_exams'));
    }

        // UPDATE EMAIL
        public function emailUpdateRequest(Request $request)
        {
           
            $validator = Validator::make($request->all(), 
                [     
                    'email'=> ['required', 'email', 'unique:users']
                ],
                [
                    'unique'=>'Email already in use'
                ]
            );
            if($validator->fails()):
                return response()->json(['errors'=>$validator->errors()->all()]);
            else:
                $email =  $request->email;
                $token = Str::random(32);
                $user_id = Student::where('id', $request->id)->first()->user_id;
    
                $details = [
                    'id' => $user_id,
                    'email' => $email,
                    'token' => $token
                ];
    
                if(Mail::to($email)->send(new ChangeEmail($details))):
                    return response()->json(['error'=>'error']);
                else:
                    if(User::where('id',$user_id)->update(['email_change_token'=> $token,'email_change'=> $email])):
                        activity()->withProperties(['student_id' => $request->id, 'email' => $email])->log('Email Change Request');
                        return response()->json(['success'=>'success']);
                    endif;
                endif;
    
            endif;
            return response()->json(['error'=>'error']);
        }
        // /UPDATE EMAIL

        public function deactivateAccount(Request $request)
        {
            $user_id = Student::where('id', $request->id)->first()->user_id;
            $validator = Validator::make($request->all(), 
                [     
                    'message'=> ['required']
                ]
            );
            if($validator->fails()):
                return response()->json(['errors'=>$validator->errors()->all()]);
            else:
                if(User::where('id', $user_id)->update(['status' => 0, 'message' => $request->message])):
                    return response()->json(['success'=>'success']);
                endif;
            endif;
            return response()->json(['error'=>'error']);
        }

        public function reactivateAccount(Request $request)
        {
            $user_id = Student::where('id', $request->id)->first()->user_id;
            $validator = Validator::make($request->all(), 
                [     
                    'message'=> ['required']
                ]
            );
            if($validator->fails()):
                return response()->json(['errors'=>$validator->errors()->all()]);
            else:
                if(User::where('id', $user_id)->update(['status' => 1, 'message' => $request->message])):
                    return response()->json(['success'=>'success']);
                endif;
            endif;
            return response()->json(['error'=>'error']);
        }
}
