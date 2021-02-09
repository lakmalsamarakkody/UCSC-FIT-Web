<?php

namespace App\Http\Controllers\Portal\Staff\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Exam;

class ExamListController extends Controller
{
    //Exam list view
    public function index()
    {
        $exams = Exam::orderby('year', 'desc')->orderBy('id', 'desc')->get();
        return view('portal/staff/exams/exam_list', compact('exams'));
    }
    
    //Create
    public function createExam(Request $request)
    {
        //Validate form data
        $exam_validator = Validator::make($request->all(), [
            'examYear'=>['required', 'integer'],
            'examMonth'=>['required', 'alpha', Rule::in(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])],
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
