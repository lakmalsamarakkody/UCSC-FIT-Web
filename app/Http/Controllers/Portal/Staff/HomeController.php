<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam\Schedule;
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
      $upcomings=Schedule::where('date', '>=', date('Y-m-d'))->orderby('date')->take(6)->get();
      $dones=Schedule::where('date', '<', date('Y-m-d'))->orderby('date', 'desc')->take(6)->get();
      return view('portal/staff/home',[
          'upcomings' => $upcomings,
          'dones' => $dones
      ]);
    }
}
