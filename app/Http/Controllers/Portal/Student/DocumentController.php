<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function __construct() 
    {
        $this->middleware('payment.submit.check');
    }
    public function index()
    {
        $student = Student::where('user_id', Auth::user()->id)->first();
        return view('portal/student/documents', compact('student'));
    }
}
