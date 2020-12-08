<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Student_Exam;
use App\Models\Exam;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }
    
    public function index()
    {
        $months = Exam::latest();
        $months = $months->paginate(7);
        return view('portal/staff/results',compact('months'));
    }

    public function viewResults($id)
    {
        // $results=Student_Exam::where('result_id',$id)->get();
        // return view('portal/staff/result/view', compact('results'));
    }
}
