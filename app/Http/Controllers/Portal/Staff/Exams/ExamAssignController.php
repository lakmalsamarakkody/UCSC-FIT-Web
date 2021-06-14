<?php

namespace App\Http\Controllers\Portal\Staff\Exams;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use App\Models\Subject;
use App\Models\Exam\Types;
use App\Models\Student;
use App\Models\Student\hasExam;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class ExamAssignController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $exam_years = Exam::select('year')->where('year', '>=', $today->year)->groupBy('year')->orderBy('year', 'asc')->get();
        $next_years_exams = Exam::where('year', '>', $today->year);
        $upcoming_exams = Exam::where('year', $today->year)->where('month', '>=', $today->month)->union($next_years_exams)->orderBy('year', 'asc')->orderBy('month', 'asc')->get();
        $subjects = Subject::orderBy('id')->get();
        $exam_types = Types::orderBy('id')->get();

        return view('portal/staff/exams/exam_assign', [
            'exam_years' => $exam_years,
            'upcoming_exams' => $upcoming_exams,
            'subjects' => $subjects,
            'exam_types' => $exam_types
        ]);
    }

    // EXAM SCHEDULES TABLE
    public function getSchedulesToAssign(Request $request)
    {
        $today = Carbon::today();
        if ($request->ajax()):
            $data = Schedule::where('date', '>', $today)->where('schedule_release', 1)->addSelect([
                'year' => Exam::select('year')->whereColumn('exam_id', 'exams.id'),
                'month' => Exam::select(DB::raw("MONTHNAME(CONCAT(year,'-',month,'-01')) as monthname"))->whereColumn('exam_id', 'exams.id'),
                'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
                'subject_name'=> Subject::select('name')->whereColumn('subject_id','subjects.id'),
                'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')]);

            if($request->year != null || $request->exam != null || $request->date != null || $request->subject != null || $request->type != null):

                if($request->year != null):
                    $data = $data->whereYear('date', $request->year);
                endif;
                
                if($request->exam != null): 
                    $data = $data->where('exam_id',$request->exam);
                endif;
                if($request->date != null):
                    $data = $data->where('date', $request->date);
                endif;
                if($request->subject != null):
                    $data = $data->where('subject_id', $request->subject);
                endif;
                if($request->type != null):
                    $data = $data->where('exam_type_id', $request->type);
                endif;
            endif;
            $data = $data->get();
            return DataTables::of($data)
            ->editColumn('start_time', function($data){ $start_time = Carbon::createFromFormat('H:i:s', $data->start_time)->isoFormat('hh:mm A'); return $start_time; })
            ->editColumn('end_time', function($data){ $end_time = Carbon::createFromFormat('H:i:s', $data->end_time)->isoFormat('hh:mm A'); return $end_time; })
            ->rawColumns(['action'])
            ->make(true);
        endif;
    }
    // /EXAM SCHEDULES TABLE

    // STUDENT LIST MODAL DETAILS
    public function getExamScheduleDetails(Request $request)
    {
        $schedule = Schedule::where('id',$request->schedule_id)->addSelect([
            'subject_name'=> Subject::select('name')->whereColumn('subject_id', 'subjects.id'),
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')
        ])->first();
        $start_time = \Carbon\Carbon::parse($schedule->start_time)->format('h:i A');
        $end_time = \Carbon\Carbon::parse($schedule->end_time)->format('h:i A');
        return response()->json(['status'=>'success', 'schedule'=>$schedule, 'start_time'=>$start_time, 'end_time'=>$end_time]);
    }

    // STUDENT LIST
    public function getStudentList(Request $request)
    {
        if($request->ajax()) {
            $scheduled_student_ids = hasExam::select('student_id')->where('exam_schedule_id', $request->schedule_id)->get();
            $student_ids_array = [];

            foreach($scheduled_student_ids as $scheduled_student_id):
                array_push($student_ids_array, $scheduled_student_id->student_id);
            endforeach;

            // $student_ids_array = json_decode($scheduled_student_ids, true);
            $data  = Student::join('student_registrations', 'students.id', '=', 'student_registrations.student_id')->where('student_registrations.status', 1)->whereNotIn('students.id', $student_ids_array);
            // $data  = Student::join('student_registrations', 'students.id', '=', 'student_registrations.student_id')->where('student_registrations.status', 1);


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
                ->orWhere('passport','like', '%'. $request->nic.'%');
            }
            if($request->search!=null){
                $data = $data->where('first_name','like', '%'. $request->search.'%')
                ->orWhere('last_name','like', '%'. $request->search.'%')
                ->orWhere('full_name','like', '%'. $request->search.'%')
                ->orWhere('initials','like', '%'. $request->search.'%')
                ->orWhere('middle_names','like', '%'. $request->search.'%')
                ->orWhere('reg_year', $request->search)
                ->orWhere('nic_old','like','%'. $request->search.'%')
                ->orWhere('nic_new','like', '%'. $request->search.'%')
                ->orWhere('postal','like', '%'. $request->search.'%')
                ->orWhere('passport','like', '%'. $request->search.'%');
              }
            $data = $data->get();
            return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
        }
    }
    // /STUDENT LIST
    // /STUDENT LIST MODAL DETAILS

    // ASSIGN STUDENTS FOR THE EXAM
    public function assignStudentsForExam(Request $request)
    {
        $schedule = Schedule::where('id', $request->schedule_id)->first();
        $students_array = json_decode($request->assign_students);
        $isExists = NULL;
        if($students_array == null):
            return response()->json(['status'=>'unselected']);
        else:
            foreach($students_array as $student):
                $isRecordExists = hasExam::where('student_id',$student)->where('exam_schedule_id',$request->schedule_id)->where('subject_id',$schedule->subject_id)->where('exam_type_id',$schedule->exam_type_id)->first();
                if($isRecordExists):
                    $isExists = TRUE;
                else:
                    $exam = hasExam::create([
                        'student_id'=> $student,
                        'exam_schedule_id'=> $request->schedule_id,
                        'subject_id'=> $schedule->subject_id,
                        'exam_type_id'=> $schedule->exam_type_id,
                        'schedule_status'=> 'Approved',
                        'payment_status'=> 'Approved'
                    ]);
                endif;
            endforeach;
            if($isExists) return response()->json(['status'=>'success', 'exists'=>'Skipped some existing records']);
            return response()->json(['status'=>'success', 'exists'=>""]);
    endif;
    }
    // /ASSIGN STUDENTS FOR THE EXAM
}