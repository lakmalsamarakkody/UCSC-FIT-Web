<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        $students=Student::take(10)->get();
        return view('portal/staff/students',[
            'students'=>$students
        ]);
    }

    public function getStudentList(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::join('student_flags', 'students.id', '=', 'student_flags.id')->get();
            
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-view-role"><i class="fas fa-user"></i></button>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
