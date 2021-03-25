<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Email_Token;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PharIo\Manifest\Email;
use Illuminate\Support\Str;

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
            $email_token = Email_Token::where('email', $email)->get()->first();
            if(is_Null($email_token)):
                return abort(403);
            else:
                if($token==$email_token->token):
                    return view('portal/student/guest', compact('email'));
                else:
                    return abort(403);
                endif;
            endif;
        endif;
    }

    public function updateAccount(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [     
                'password'=> ['required', 'string', 'min:8'],
                'rePassword'=>['required', 'string', 'same:password']
            ],
            [
                'same'=>'The password must match with re-type password<br>'
            ]
        );
        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()]);
        else:
            $email = $request->email;
            $user = new User();
            $user->email = $email;
            $user->password = Hash::make($request->password);
            $user->role_id = '1';

            $email_token = Email_Token::where('email', $email)->get()->first();
            if(is_Null($email_token['token'])):
                return abort(403);
            else:
                if($user->save()):
                    if(Email_Token::where('email', $email)->delete()):
                        $subscriber_check = Subscriber::where( 'email', $email )->first();
                        if (is_Null($subscriber_check['email'])) {
                            $token = Str::random(32);
                            $subscriber = new Subscriber();
                            $subscriber->email = $email;
                            $subscriber->token = $token;
                            $subscriber->save();
                        }
                        return response()->json(['success'=>'success']);
                    else:                        
                        return response()->json(['error'=>'error']);
                    endif;
                else:
                    return response()->json(['error'=>'error']);
                endif;
            endif;
            
        endif;
    }
}
