<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam\Schedule;
use App\Models\Student\hasExam;
use App\Models\Student\Medical;
use App\Models\Student\Registration;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('revalidate');
      $this->middleware('staff.auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      // CARD COUNTS
      // Registration
      $applicationCount = Registration::where('registered_at', NULL)->where('application_submit', '1')->where('application_status', NULL)->where('payment_id', NULL)->get()->count();
      $paymentReviewCount = Registration::where('registered_at', NULL)->where('application_submit', '1')->where('payment_id', '!=', NULL)->where('payment_status', NULL)->get()->count();
      $documentPendingCount = Registration::where('registered_at', NULL)->where('application_submit', '1')->where('payment_id', '!=', NULL)->where('payment_status', 'Approved')->where('document_submit', '0')->get()->count();
      $documentReviewCount = Registration::where('registered_at', NULL)->where('application_submit', '1')->where('payment_id', '!=', NULL)->where('payment_status', 'Approved')->where('document_submit', '1')->where('document_status', NULL)->get()->count();
      $pendingRegistration = Registration::where('registered_at', NULL)->where('application_submit', '1')->where('payment_id', '!=', NULL)->where('payment_status', 'Approved')->where('document_submit', '1')->where('document_status',  'Approved')->get()->count();
      $totalRegistered = Registration::where('registered_at', '!=', NULL)->where('registration_expire_at', '>=', now())->where('application_submit', '1')->where('payment_id', '!=', NULL)->where('payment_status', 'Approved')->where('document_submit', '1')->where('document_status', 'Approved')->where('status', 1)->get()->count();

      //Exams
      $examPaymentReviewCount = hasExam::where('payment_id', '!=', null)->where('payment_status', null)->where(function ($query) {
        $query->where('schedule_status', 'Pending')->orWhere('schedule_status', 'Scheduled');
      })->get()->unique('payment_id')->count();
      $revieweExamsToScheduleCount = hasExam::where('payment_id', '!=', null)->where('payment_status', 'Approved')->where(function ($query) {
        $query->where('schedule_status', 'Pending')->orWhere('schedule_status', 'Scheduled');
      })->get()->unique('payment_id')->count();
      $medicalReviewCount = Medical::where('status', 'Pending')->get()->count();
      // /CARD COUNTS
      
      $upcomingExams=Schedule::where('date', '>=', date('Y-m-d'))->orderby('date')->take(6)->get();
      $heldExams=Schedule::where('date', '<', date('Y-m-d'))->orderby('date', 'desc')->take(6)->get();
      return view('portal/staff/home',compact(
        'applicationCount',
        'paymentReviewCount',
        'documentPendingCount',
        'documentReviewCount',
        'pendingRegistration',
        'totalRegistered',
        'upcomingExams',
        'heldExams',
        'examPaymentReviewCount',
        'revieweExamsToScheduleCount',
        'medicalReviewCount'
      ));
    }
}
