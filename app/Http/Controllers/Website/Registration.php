<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\StudentRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Registration extends Controller
{
    public function index(){
        return view('website/registration');
    }

    public function emailLink(Request $request)
    {
        $email = $request->email;
        Mail::to($email)->send(new StudentRegistration($email));
    }
}
