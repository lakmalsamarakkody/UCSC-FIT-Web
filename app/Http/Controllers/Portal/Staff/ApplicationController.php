<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function getApplicantList()
    {
        return view('portal/staff/registration/applications');
    }
}
