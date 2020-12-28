<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\StudentRegistration;
use App\Mail\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Email_Token;
use App\Models\Subscriber;

class Registration extends Controller
{
    public function index(){
        return view('website/registration', [
            'title' => 'Registration'
        ]);
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
                    if($email_token->save()):
                        return response()->json(['success'=>'success']);
                    endif;
                endif;

            endif;
        endif;   
        return response()->json(['error'=>'error']);    
              
    }

    public function subscribe(Request $request){
        // validate subscriberEmail
        $validator = Validator::make($request->all(), [
            'subscriberEmail' => ['required', 'email', 'unique:App\Models\Subscriber,email'],
        ]);
        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()->all()]);
        else:
            $email = $request->subscriberEmail;
            $token = Str::random(32);
            $subscriber = new Subscriber();
            $subscriber->email = $email;
            $subscriber->token = $token;

            $details = [
                'email' => $subscriber->email,
                'token' => $subscriber->token
            ];

            if(Mail::to($email)->send(new Subscribe($details))):
                return response()->json(['error'=>'error']);
            else:
                if($subscriber->save()):
                    return response()->json(['status'=>'success']);
                endif;
            endif;
 
        endif;
        return response()->json(['error'=>'error']);
        
    }

    public function unsubscribe($email, $token)
    {
        $validator = Validator::make(
            [
                'email'=>$email
            ],
            [            
                'email'=> ['required', 'email']      
            ]
        );
        if($validator->fails()):
            return view('website/error');
        else:
            $email_token = Subscriber::where('email', $email)->get()->first();
            if(is_Null($email_token['token'])):
                return abort(403);
            else:
                if($token==$email_token['token']):
                    if(Subscriber::where('email', $email)->delete()):
                        return view('website/unsubscribed', compact('email'));
                    else:
                        return abort(403);
                    endif;
                else:
                    return abort(403);
                endif;
            endif;
        endif;
    }

}
