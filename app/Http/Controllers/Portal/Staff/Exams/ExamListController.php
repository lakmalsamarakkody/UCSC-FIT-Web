<?php

namespace App\Http\Controllers\Portal\Staff\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\Support\Fee;
use Carbon\Carbon;
use App\Exports\StudentExamListExport;
use App\Models\Exam\Types;
use Maatwebsite\Excel\Facades\Excel;

class ExamListController extends Controller
{
    //Exam list view
    public function index()
    {
        $exams = Exam::orderby('year', 'desc')->orderby('month', 'desc')->paginate(10);
        $examTypes = Fee::where('purpose', 'exam')->get();
        return view('portal/staff/exams/exam_list', compact('exams', 'examTypes'));
    }

    // GET EXAM LIST
    public function getExamList(Request $request)
    {
        if ($request->ajax()) {
            $data = Exam::get();
            $subjects = Fee::where('purpose', 'exam')->get();
            return DataTables::of($data,$subjects)
            ->editColumn('month', function ($data) {
                return $data->month ? with(Carbon::createFromDate($data->year,$data->month)->monthName) : '';
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }
    }
    // /GET EXAM LIST

    // DOWNLOAD EXAM LIST
    public function export($eid,$sid,$etid) 
    {
        $exam = Exam::where('id',$eid)->first();
        $subject = Subject::where('id',$sid)->first();
        $examType = Types::where('id',$etid)->first();
        if($exam && $subject && $examType):
        return (new StudentExamListExport)->forExam($eid)->forSubject($sid)->forExamType($etid)->download($exam->year.'-'.$exam->month.'-'.$subject->name.'-'.$examType->name.'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        else:
            return (new StudentExamListExport)->forExam($eid)->forSubject($sid)->forExamType($etid)->download('StudentExamListExport.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        endif;
    }
    // /DOWNLOAD EXAM LIST
    
    //Create
    public function createExam(Request $request)
    {
        //Validate form data
        $exam_validator = Validator::make($request->all(), [
            'examYear'=>['required', 'integer'],
            'examMonth'=>['required', 'numeric', 'min:1', 'max:12'],
        ]);

        $exists_exam = Exam::where('year',$request->examYear)->where('month', $request->examMonth);
        if($exists_exam->exists()):
            $exists_exam_validator = Validator::make($request->all(), [
                'exam' => ['multicolumn_unique'],
            ]);
        endif;
        
        //Check validator fails
        if($exam_validator->fails()):
            return response()->json(['errors'=>$exam_validator->errors()]);
        elseif(isset($exists_exam_validator) && $exists_exam_validator->fails()):
            return response()->json(['errors'=>$exists_exam_validator->errors()]);
        else:
            $exam = new Exam();
            $exam->year = $request->examYear;
            $exam->month = $request->examMonth;
            if($exam->save()):
                return response()->json(['status'=>'success', 'exam'=>$exam]);
            endif;
        endif;
        return response()->json(['status'=>'error']);
    }
    // /Create

    // Delete
    public function deleteExam(Request $request)
    {
        //Validate exam id
        $exam_id_validator = Validator::make($request->all(), [
            'exam_id' => ['required', 'integer', 'exists:App\Models\Exam,id'],
        ]);

        //Check validator fails
        if($exam_id_validator->fails()):
            return response()->json(['status'=>'error', 'errors'=>$exam_id_validator->errors()]);
        else:
            if($exam = Exam::destroy($request->exam_id)):
                return response()->json(['status'=>'success']);
            endif;
        endif;
        return response()->json(['status'=>'error', 'data'=>$request->all()]);
    }

    // /Delete
}
