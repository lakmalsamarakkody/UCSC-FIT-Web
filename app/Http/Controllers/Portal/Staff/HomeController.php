<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Exam;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $upcomings=Exam::where('date', '>=', date('Y-m-d'))->orderby('date')->get();
        $dones=Exam::where('date', '<', date('Y-m-d'))->orderby('date', 'desc')->take(5)->get();
        return view('portal/staff/home',[
            'upcomings' => $upcomings,
            'dones' => $dones
        ]);
    }
}
