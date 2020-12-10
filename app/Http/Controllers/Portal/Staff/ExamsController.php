<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExamsController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }
    
    public function index()
    {
        $exams=Schedule::orderby('date')->take(6)->get();
        return view('portal/staff/exams',[
            'exams' => $exams,
        ]);
    }

    public function getExamList(Request $request)
    {
        if ($request->ajax()) {
            $data = Schedule::latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> 
                <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['sction'])
            ->make(true);
        }
    }

    
}
