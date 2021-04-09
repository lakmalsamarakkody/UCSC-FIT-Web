<?php

namespace App\Http\Controllers\Portal\Staff\Exams;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use App\Models\Subject;
use App\Models\Exam\Types;
use Illuminate\Support\Carbon;
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
}