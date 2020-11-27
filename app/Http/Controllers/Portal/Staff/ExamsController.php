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
        return view('portal/staff/exams');
    }

    public function getExamList(Request $request)
    {
        if ($request->ajax()) {
            $data = Exam::get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> 
                <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })->rawColumns(['sction'])->make(true);
        }
    }
}
