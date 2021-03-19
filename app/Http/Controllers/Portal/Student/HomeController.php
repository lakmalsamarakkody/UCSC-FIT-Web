<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Anouncements;
use App\Models\Exam\Schedule;
use App\Models\Student;
use App\Models\Student\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('student.auth');
        $this->middleware('student.info.view');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // GET STUDENT DETAILS
        $announcements = Anouncements::orderBy('created_at', 'desc')->take(6)->get();
        $student = Student::where('user_id', Auth::user()->id)->first();
        $registration = Registration::where('student_id', $student->id)->latest()->first();
        $upcomingExams=Schedule::where('date', '>=', date('Y-m-d'))->orderby('date')->take(6)->get();
        $heldExams=Schedule::where('date', '<', date('Y-m-d'))->orderby('date', 'desc')->take(6)->get();
        return view('portal/student/home', compact('student', 'registration','upcomingExams','heldExams', 'announcements'));
    }
}
