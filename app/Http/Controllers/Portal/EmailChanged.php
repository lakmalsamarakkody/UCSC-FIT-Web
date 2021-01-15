<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailChanged extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }

    public function index()
    {
        $role = Auth::user()->role->name;
        switch ($role):
            case 'Student':
                return view('/portal/student/changed_email');
                break;
            default:
                return view('/portal/staff/changed_email');
                break;
        endswitch;
    }
}
