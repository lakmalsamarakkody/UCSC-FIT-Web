<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('staff.auth');
    }

    public function index(Request $request)
    {
        $students = Student::orderBy('id', 'desc');

        if ($request->year != null) {
            $students = $students->where('reg_year', $request->year);
        }

        $students = $students->paginate(10);
        return view('portal/staff/students', compact('students'));
    }

    public function getStudentList(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::join('student_flags', 'students.id', '=', 'student_flags.id');
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
                ->orWhere('Passport','like', '%'. $request->nic.'%');
            }
            if($request->fit!=null){
                $data = $data->where('fit_cert',$request->fit);
            }
            if($request->bit!=null){
                $data = $data->where('bit_eligible',$request->bit);
            }
            if($request->search!=null){
                $data = $data->where('first_name','like', '%'. $request->search.'%')
                ->orWhere('last_name','like', '%'. $request->search.'%')
                ->orWhere('full_name','like', '%'. $request->search.'%')
                ->orWhere('initials','like', '%'. $request->search.'%')
                ->orWhere('middle_names','like', '%'. $request->search.'%')
                ->orWhere('reg_year', $request->search)
                ->orwhere('nic_old','like','%'. $request->search.'%')
                ->orWhere('nic_new','like', '%'. $request->search.'%')
                ->orWhere('postal','like', '%'. $request->search.'%')
                ->orWhere('Passport','like', '%'. $request->search.'%')
                ->orWhere('dob','like', '%'. $request->search.'%')
                ->orWhere('gender','like', '%'. $request->search.'%')
                ->orWhere('citizenship','like', '%'. $request->search.'%')
                ->orWhere('permanent_house','like', '%'. $request->search.'%')
                ->orWhere('current_house','like', '%'. $request->search.'%')
                ->orwhere('designation','like','%'. $request->search.'%')
                ->orWhere('telephone','like', '%'. $request->search.'%')
                ->orWhere('title',$request->search)
                ->orWhere('education','like', '%'. $request->search.'%');
              }
            $data = $data->get();
            return DataTables::of($data)
            ->addIndexColumn()
            // ->addColumn('action', function($row){
            //     $actionBtn = '<a onclick="view_student();" title="View Profile" data-tooltip="tooltip"  data-placement="bottom"  type="button" class="btn btn-outline-primary"><i class="fas fa-user"></i></a>';
            //     return $actionBtn;
            // })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function viewStudent($id)
    {
        $student = Student::find($id);
        return view('portal/staff/student/profile', compact('student'));
    }
}
