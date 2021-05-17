<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Imports\ResultsImport;
use App\Models\Student_Exam;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use App\Models\Exam\Types;
use App\Models\Student\hasExam;
use App\Models\Subject;
use App\Models\TempResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use SebastianBergmann\Environment\Console;
use Yajra\DataTables\Facades\DataTables;

class ResultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('staff.auth');
    }
    
    public function index()
    {

        $years = Exam::select('year')->groupBy('year')->get();
        $months = Exam::select('month')->groupBy('month')->get();

        $today = Carbon::today();
        $schedules = Schedule::where('date', '<', $today)->addSelect([
            //'exam' => Exam::select(DB::raw("CONCAT(month, ' ', year) AS examname"))->whereColumn('exam_id','exams.id'),
            'year' => Exam::select('year')->whereColumn('exam_id', 'exams.id'),
            'month' => Exam::select(DB::raw("MONTHNAME(CONCAT(year,'-',month,'-01')) as monthname"))->whereColumn('exam_id', 'exams.id'),
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'subject_name'=> Subject::select('name')->whereColumn('subject_id','subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')])->get();
        return view('portal/staff/results',compact('years','months','schedules'));
    }

    public function getExamList(Request $request)
    {
        if ($request->ajax()) {
            $data = Exam::orderby('id', 'asc');

            if($request->year!=null){
                $data = $data->where('year', $request->year);
            }            
            if($request->month!=null){
                $data = $data->where('month', $request->month);
            }
            $data = $data->get();
            return DataTables::of($data)
            ->editColumn('month', function ($data) {
                return $data->month ? with(Carbon::createFromDate($data->year,$data->month)->monthName) : '';
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function viewResults($id)
    {
        $schedules=Schedule::where('exam_id',$id)->get();

        
        $schedule_ids = array();
        foreach($schedules as $schedule){
            $schedule_ids [] = $schedule->id;
        }
        // $results = hasExam::whereIn('exam_schedule_id',$schedule_ids)->groupBy('student_id')->dd();
        $students = hasExam::whereIn('exam_schedule_id',$schedule_ids)->distinct()->select('student_id')->get();
        // $results = collect($results);
        // $results=$results->groupBy('student_id');
        // Log::debug($results);
        // foreach($results as $result){
        //     echo $result;
        // }
        // echo $results;
        return view('portal/staff/result/view', compact('students', 'schedule_ids'));
    }

    public function temporaryImport(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [     
                'schedule'=> ['required'],
                'resultFile'=>['required', 'mimes:xlsx']
            ]
        );
        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()]);
        else:
            $file = $request->file('resultFile');
            $exam_schedule_id = $request->schedule;

            
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            if(TempResult::truncate()):
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                Excel::import(new ResultsImport($exam_schedule_id), $file);
                return response()->json(['success'=>'success']);
            endif;
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return response()->json(['error'=>'error']);
        endif;
    }

    public function getTempResults(Request $request)
    {
        if ($request->ajax()) :
            $data = TempResult::join('students', 'temp_results.student_reg_no', '=', 'students.reg_no')
            ->select('temp_results.id', 'temp_results.student_reg_no', 'temp_results.grade', 'students.initials', 'students.last_name', 'students.full_name', 'students.nic_old', 'students.nic_new', 'students.postal', 'students.passport')
            ->get();
            return DataTables::of($data)

            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        endif;
    }

    public function getTempModalDetails(Request $request)
    {
        $schedules = Schedule::where('id', $request->id)->addSelect([
            //'exam' => Exam::select(DB::raw("CONCAT(month, ' ', year) AS examname"))->whereColumn('exam_id','exams.id'),
            'year' => Exam::select('year')->whereColumn('exam_id', 'exams.id'),
            'month' => Exam::select(DB::raw("MONTHNAME(CONCAT(year,'-',month,'-01')) as monthname"))->whereColumn('exam_id', 'exams.id'),
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'subject_name'=> Subject::select('name')->whereColumn('subject_id','subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')])->get();

            return response()->json($schedules);
    }

    public function temporaryDiscard()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        if(TempResult::truncate()):
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return response()->json(['success'=>'success']);
        endif;
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return response()->json(['error'=>'error']);
    }


}
