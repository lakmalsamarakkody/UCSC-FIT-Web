<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\StudentRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Registration extends Controller
{
    public function index(){
        return view('website/registration');
    }

    public function emailLink(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'email'=> ['required', 'email', 'unique:users']
        ]);
        // $request->validate([
        //     'email'=> ['required', 'email', 'unique:users']
        // ]);
        
        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()->all()]);
        endif;
        $email = $request->email;
        if(Mail::to($email)->send(new StudentRegistration($email))):
            return response()->json(['success'=>'success']);
        else:
            return response()->json(['success'=>'success']);
        endif;
        
              
        // return view('website/registration', compact('msg'));
    }
}
