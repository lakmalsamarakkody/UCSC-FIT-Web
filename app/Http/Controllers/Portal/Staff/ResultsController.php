<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Imports\ResultsImport;
use App\Models\Student_Exam;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use App\Models\Exam\Types;
use App\Models\Student\Flag;
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
        // $schedules = Schedule::where('date', '<', $today)->addSelect([
        //     //'exam' => Exam::select(DB::raw("CONCAT(month, ' ', year) AS examname"))->whereColumn('exam_id','exams.id'),
        //     'year' => Exam::select('year')->whereColumn('exam_id', 'exams.id'),
        //     'month' => Exam::select(DB::raw("MONTHNAME(CONCAT(year,'-',month,'-01')) as monthname"))->whereColumn('exam_id', 'exams.id'),
        //     'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
        //     'subject_name'=> Subject::select('name')->whereColumn('subject_id','subjects.id'),
        //     'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')])->orderBy('date', 'desc')->get();

        // $previous_years_exams = Exam::where('year', '<', $today->year);
        // $previous_exams = Exam::where('year', $today->year)->where('month', '<', $today->month)->union($previous_years_exams)->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

        $previous_exams = Exam::where('year', '<=', $today->year)->where('month', '<=', $today->month)
                            ->join('exam_schedules', 'exams.id', 'exam_schedules.exam_id')
                            ->select('exams.id','exams.year','exams.month')
                            ->where('exam_schedules.date', '<', $today)
                            ->orderBy('exams.year', 'desc')->orderBy('exams.month', 'desc')
                            ->distinct()
                            ->get();
        
        $subjects = Subject::all();
        $exam_types = Types::all();

        return view('portal/staff/results',compact('years', 'months', 'previous_exams', 'exam_types', 'subjects'));
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
        $exam_id = $id;
        $subjects = Subject::all();
        $exam_types = Types::all();
        $schedules=Schedule::where('exam_id',$id)->get();
        $isReleased = NULL;

        (Exam::where('id', $exam_id)->where('result_released','released')->first()? $isReleased=TRUE : $isReleased=FALSE);

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
        return view('portal/staff/result/view', compact('exam_id', 'isReleased', 'subjects', 'exam_types' ,'students', 'schedule_ids'));
    }

    public function temporaryImport(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [     
                'exam'=> ['required'],
                'subject'=> ['required'],
                'examType'=> ['required'],
                'resultFile'=>['required', 'mimes:xlsx']
            ]
        );
        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()]);
        else:
            $file = $request->file('resultFile');
            $details = [
               'exam' =>  $request->exam,
               'subject' =>  $request->subject,
               'examType' =>  $request->examType
            ];

            // return response()->json($details);
            
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            if(TempResult::truncate()):
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                Excel::import(new ResultsImport($details), $file);
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
        $data = Schedule::where('exam_id', $request->exam)->where('subject_id', $request->subject)->where('exam_type_id', $request->examType)->addSelect([
            //'exam' => Exam::select(DB::raw("CONCAT(month, ' ', year) AS examname"))->whereColumn('exam_id','exams.id'),
            'year' => Exam::select('year')->whereColumn('exam_id', 'exams.id'),
            'month' => Exam::select(DB::raw("MONTHNAME(CONCAT(year,'-',month,'-01')) as monthname"))->whereColumn('exam_id', 'exams.id'),
            'subject_code'=> Subject::select('code')->whereColumn('subject_id', 'subjects.id'),
            'subject_name'=> Subject::select('name')->whereColumn('subject_id','subjects.id'),
            'exam_type'=> Types::select('name')->whereColumn('exam_type_id', 'exam_types.id')])->get();

            return response()->json($data);
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

    public function Import(Request $request)
    {
        // echo $request->selectedResults;
        $ids =  json_decode($request->selectedResults);        
        foreach ($ids as $id):
            $temp_data = TempResult::where('id', $id)->first();
            $schedules = Schedule::select('id')
                                    ->where('exam_id', $temp_data->exam_id)
                                    ->where('subject_id', $temp_data->subject_id)
                                    ->where('exam_type_id', $temp_data->exam_type_id)
                                    ->get();
            if ($temp_data->grade >= 50):
                $status = 'P';
            elseif ($temp_data->grade < 50):
                $status = 'F';
            else:
                $status = 'AB';
            endif;
            hasExam::where('student_id', $temp_data->student->id)
            ->where('subject_id', $temp_data->subject_id)
            ->where('exam_type_id', $temp_data->exam_type_id)
            ->whereIn('exam_schedule_id', $schedules)
            ->update([
                'raw_mark' => $temp_data->grade,
                'round_mark' => ceil($temp_data->grade),
                'mark' => ceil($temp_data->grade),
                'result' => 1,
                'status' => $status
            ]);

            /** 
             * Results Field of student_exam table
             * 
             * no result updated -> 0
             * imported but not released (hold) -> 1
             * released -> 2
             * 
             */

            TempResult::where('id', $id)->delete();
        endforeach;

        if (TempResult::all()->isEmpty()):
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            TempResult::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return response()->json(['success'=>'success']);
        else:
            return response()->json(['error'=>'error']);
        endif;
    }

    public function releaseResults(Request $request)
    {
        $schedules = Schedule::select('id')->where('exam_id', $request->id)->get();

        hasExam::whereIn('exam_schedule_id', $schedules)
            ->update([
                'result' => 2
            ]);

        Exam::where('id', $request->id)
            ->update([
                'result_released' => 'released'
            ]);

        //checking BIT eligibily and FIT certificate eligibility
        $students = hasExam::select('student_id')->whereIn('exam_schedule_id', $schedules)->get();
                // return $students;
        foreach ($students as $student) {
            $_103_eTest = hasExam::where('student_id', $student->student_id)->where('subject_id', 1)->where('exam_type_id', 1)->where('status', 'P')->get()->count();
            $_203_eTest = hasExam::where('student_id', $student->student_id)->where('subject_id', 2)->where('exam_type_id', 1)->where('status', 'P')->get()->count();
            $_303_eTest = hasExam::where('student_id', $student->student_id)->where('subject_id', 3)->where('exam_type_id', 1)->where('status', 'P')->get()->count();
            $_103_prac = hasExam::where('student_id', $student->student_id)->where('subject_id', 1)->where('exam_type_id', 2)->where('status', 'P')->get()->count();
            $_203_prac = hasExam::where('student_id', $student->student_id)->where('subject_id', 2)->where('exam_type_id', 2)->where('status', 'P')->get()->count();

            if ( $_103_eTest>0 || $_203_eTest>0 || $_303_eTest>0 ):
                Flag::where('student_id', $student->student_id)->update([
                    'bit_eligible' => 1
                ]);
                if ( $_103_prac>0 || $_203_prac>0 ):
                    Flag::where('student_id', $student->student_id)->update([
                        'fit_cert' => 1
                    ]);
                endif;
            endif;

        }
        // /checking BIT eligibily and FIT certificate eligibility

        return response()->json(['success'=>'success']);

            /** 
             * Results Field of student_exam table
             * 
             * no result updated -> 0
             * imported but not released (hold) -> 1
             * released -> 2
             * 
             */
    }

    public function holdResults(Request $request)
    {
        $schedules = Schedule::select('id')->where('exam_id', $request->id)->get();

        hasExam::whereIn('exam_schedule_id', $schedules)
            ->update([
                'result' => 1
            ]);

        Exam::where('id', $request->id)
            ->update([
                'result_released' => 'hold'
            ]);

        return response()->json(['success'=>'success']);
            /** 
             * Results Field of student_exam table
             * 
             * no result updated -> 0
             * imported but not released (hold) -> 1
             * released -> 2
             * 
             */
    }

    public function pushUpResults(Request $request){

        $examId = $request->examId;
        $subjectId = $request->subjectID;
        $examTypeID = $request->examTypeID;
        $pushUpMark = $request->pushUpMark;

        $schedules=Schedule::where('exam_id',$examId)->get();
        $schedule_ids = array();
        foreach($schedules as $schedule){
            $schedule_ids [] = $schedule->id;
        }

        $query = hasExam::whereIn('exam_schedule_id',$schedule_ids)->where('subject_id',$subjectId)->where('exam_type_id',$examTypeID)->where('mark', '<', 50)->where('mark', '>=', $pushUpMark);
        if($query->first()):
            if($query->update(['mark'=>50, 'status'=>'P'])):
                return response()->json(['status'=>'success']);
            endif;
        else:
            return response()->json(['status'=>'success']);
        endif;
        return response()->json(['status'=>'error']);
    }

}
