<?php

namespace App\Http\Controllers\Portal\Staff\Exams;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use App\Models\Subject;
use App\Models\Exam\Types;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

    // EXAM SCHEDULE TABLE
    public function getSchedulesToAssign(Request $request)
    {
        $today = Carbon::today();
        if ($request->ajax()):
            $data = Schedule::where('date', '>', $today)->addSelect([
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
            ->rawColumns(['action'])
            ->make(true);
        endif;
    }
    // EXAM SCHEDULE TABLE
}