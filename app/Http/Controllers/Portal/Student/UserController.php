<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Email_Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function setPassword($email, $token)
    {
        $validator = Validator::make(
            [
                'email'=>$email
            ],
            [            
                'email'=> ['required', 'email']      
            // 'email'=> ['required', 'email', 'unique:users']
            ]
        );
        if($validator->fails()):
            return view('website/error');
        else:
            $user = Email_Token::where('email', $email)->get()->first();
            if(is_Null($user['token'])):
                return view('website/error');
            else:
                if($token==$user['token']):
                    return view('portal/student/guest');
                else:
                    return view('website/error');
                endif;
            endif;
        endif;
    }

    public function updateAccount(Request $request)
    {
        # code...
    }
}
