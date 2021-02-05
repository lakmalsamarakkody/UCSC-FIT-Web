<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Models\Email_Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    public function setPassword($email, $token, $role)
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
            if(is_Null($email_token['token'])):
                return abort(403);
            else:
                if($token==$email_token['token']):
                    return view('portal/staff/guest', compact('email', 'role'));
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
                'name'=> ['required'],
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
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role;

            $email_token = Email_Token::where('email', $email)->get()->first();
            if(is_Null($email_token['token'])):
                return abort(403);
            else:
                if( $email_token['role'] == $request->role && $email_token['email'] == $request->email ):
                    if($user->save()):
                        if(Email_Token::where('email', $email)->delete()):
                            return response()->json(['success'=>'success']);
                        endif;
                    endif;
                endif;
            endif;
            
        endif;
        return response()->json(['error'=>'error']);
    }
}
