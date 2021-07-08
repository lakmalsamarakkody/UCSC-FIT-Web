<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Exports\StudentDetailsExport;
use App\Http\Controllers\Controller;
use App\Mail\ChangeEmail;
use App\Models\Student;
use App\Models\Student\Registration;
use App\Models\Student\hasExam;
use App\Models\Student\Medical;
use App\Models\Subject;
use App\Models\Exam\Schedule;
use App\Models\Exam\Types;
use App\Models\Exam;
use App\Models\Student\Flag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('revalidate');         // Removed Due To Error When Exporting Excels
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
        $medicals = Medical::where('student_id', $id)->orderBy('created_at','desc')->get();
        $exams = hasExam::where('student_id', $id)->join('exam_schedules', 'student_exams.exam_schedule_id', '=', 'exam_schedules.id')->groupBy('exam_id')->select('exam_id')->get();
        
        $exam_ids = array();
        foreach($exams as $exam){
            $exam_ids [] = $exam->exam_id;
        }

        // echo response()->json($exam_ids);

        $schedules = hasExam::where('student_id', $id)->join('exam_schedules', 'student_exams.exam_schedule_id', '=', 'exam_schedules.id')->whereIn('exam_schedules.exam_id', $exam_ids)->get();

        // $schedules=Schedule::where('exam_id',$id)->get();

        
        $schedule_ids = array();
        foreach($schedules as $schedule){
            $schedule_ids [] = $schedule->id;
        }


        return view('portal/staff/student/profile', compact('student', 'registration', 'medicals', 'exams', 'schedule_ids'));
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

    // ACCOUNT BLOCK
    public function blockActivities(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [     
                'id'=> ['required','integer']
            ]
        );
        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()->all()]);
        else:
            if(Flag::where('student_id', $request->id)->update(['phase_id' => 2])):
                return response()->json(['success'=>'success']);
            endif;
        endif;
        return response()->json(['error'=>'error']);
    }
    // /ACCOUNT BLOCK

    // ACCOUNT UNBLOCK
    public function unBlockActivities(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [     
                'id'=> ['required','integer']
            ]
        );
        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()->all()]);
        else:
            if(Flag::where('student_id', $request->id)->update(['phase_id' => 1])):
                return response()->json(['success'=>'success']);
            endif;
        endif;
        return response()->json(['error'=>'error']);
    }
    // /ACCOUNT UNBLOCK


    // ACCOUNT DEACTIVATE
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
    // /ACCOUNT DEACTIVATE

    // ACCOUNT ACTIVATE
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
    // /ACCOUNT ACTIVATE

    // MEDICAL MODAL LOAD
    public function getMedicalDetails(Request $request)
    {
        $medical = Medical::where('id', $request->medical_id)->first();
        $exam = hasExam::where('id',$medical->student_exam_id)->addSelect([
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id'),
            'held_date'=> Schedule::select('date')->whereColumn('exam_schedule_id', 'exam_schedules.id')
        ])->first();
        $student = Student::where('id', $medical->student_id)->first();
        return response()->json(['status'=>'success', 'medical'=>$medical, 'exam'=>$exam, 'student'=>$student]);
    }
    // /MEDICAL MODAL LOAD

    public function exportStudentDetails($duration)
    {

        if($duration=='lastday'):
            $date = Carbon::now()->subdays(1)->format('Y-m-d');
            // echo $date;
        elseif($duration=='lastweek'):
            $date = Carbon::now()->subdays(7)->format('Y-m-d');
            // echo $date;
        elseif($duration=='lastmonth'):
            $date = Carbon::now()->subdays(30)->format('Y-m-d');
            // echo $date;
        endif;
        
        $registrations = Registration::where('registered_at', '>=', $date)->get();
           
        foreach($registrations as $registration):
            $student_array[] = array(
                $registration->student->id,
                $registration->student->reg_no,
                $registration->student->full_name,
                $registration->student->nic_old.$registration->student->nic_new.$registration->student->postal.$registration->student->passport,
                $registration->student->user->email,
            );
        endforeach;

        

        $student_array = new StudentDetailsExport($student_array);
        return Excel::download($student_array, 'students_'.$duration.'_created_at_'.date('Y-m-d H:i:s').'.xlsx');

        return redirect()->route('students');
        
    }
}
