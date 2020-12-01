<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use DataTables;
use Illuminate\Http\Request;

class ExamsController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }
    
    public function index()
    {
        $upcomings=Exam::where('date', '>=', date('Y-m-d'))->orderby('date')->take(6)->get();
        return view('portal/staff/exams',[
            'upcomings' => $upcomings,
        ]);
    }

    public function getExamList(Request $request)
    {
        if ($request->ajax()) {
            $data = Exam::latest()->get();
            return Datatables::of($data)
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
