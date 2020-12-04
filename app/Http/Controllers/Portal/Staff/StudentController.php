<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student_Registration\Academic_Year;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        $years=Academic_Year::select('year')->get();
        return view('portal/staff/students',[
            'years'=>$years
        ]);
    }

    public function getStudentList(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::join('student_flags', 'students.id', '=', 'student_flags.id')->get();
            
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<button data-toggle="modal" data-target="#exampleModal" title="View Profile" data-toggle="tooltip" data-placement="bottom"  type="button" class="btn btn-outline-primary"><i class="fas fa-user"></i></button>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
