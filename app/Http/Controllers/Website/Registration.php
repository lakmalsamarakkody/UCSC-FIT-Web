<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\StudentRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Registration extends Controller
{
    public function index(){
        return view('website/registration');
    }

    public function emailLink(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'email'=> ['required', 'email']      
            // 'email'=> ['required', 'email', 'unique:users']
        ]);
        // $request->validate([
        //     'email'=> ['required', 'email', 'unique:users']
        // ]);
        
        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()->all()]);
        else:
            $email = $request->email;
            $token = Str::random(32);
            $user = new User();
            $user->email = $email;
            $user->token = $token;
            $user->role_id = '1';

            $user->save();

            $details = [
                'email' => $email,
                'token' => $token
            ];
            
            if(Mail::to($email)->send(new StudentRegistration($details))):
                return response()->json(['success'=>'success']);
            else:
                return response()->json(['success'=>'success']);
            endif;
        endif;       
              
        // return view('website/registration', compact('msg'));
    }
    public function updateAccount($email)
    {
        // $validator = Validator::make($request->all(), [            
        //     'email'=> ['required', 'email']      
        //     // 'email'=> ['required', 'email', 'unique:users']
        // ]);
        return view('portal/student/guest');
    }
}
