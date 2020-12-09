<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student_Registration\Academic_Year;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::orderBy('id', 'desc');

        if ($request->year != null) {
            $students = $students->where('reg_year', $request->year);
        }

        $students = $students->paginate(10);
        $years=Academic_Year::select('year')->get();
        return view('portal/staff/students', compact('years', 'students'));
    }

    public function getStudentList(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::join('student_flags', 'students.id', '=', 'student_flags.id')->get();
            
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a onclick="view_student();" title="View Profile" data-tooltip="tooltip"  data-placement="bottom"  type="button" class="btn btn-outline-primary"><i class="fas fa-user"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function viewStudent()
    {
        return view('portal/staff/student/profile');
    }
}
