<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\StudentRegistration;
use App\Models\Email_Token;
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
        $validator = Validator::make($request->all(), 
            [     
                'email'=> ['required', 'email', 'unique:email_tokens']
            ],
            $messages=[
                'unique'=>'Registration link already emailed, please check Your email'
            ]
        );
        
        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()->all()]);
        else:
            $revalidator = Validator::make($request->all(),
                [
                    'email'=>'unique:users'
                ],
                $messages=[
                    'unique'=>'User account exist! Please login to continue registration'
                ]
            );
            if($revalidator->fails()):
                return response()->json(['errors'=>$revalidator->errors()->all()]);
            else:
                $email = $request->email;
                $token = Str::random(32);
                $email_token = new Email_Token();
                $email_token->email = $email;
                $email_token->token = $token;
    
    
                $details = [
                    'email' => $email_token->email,
                    'token' => $email_token->token
                ];
                
    
                if(Mail::to($email)->send(new StudentRegistration($details))):
                    return response()->json(['error'=>'error']);
                else:
                    $email_token->save();
                    return response()->json(['success'=>'success']);
                endif;

            endif;
        endif;       
              
    }

}
