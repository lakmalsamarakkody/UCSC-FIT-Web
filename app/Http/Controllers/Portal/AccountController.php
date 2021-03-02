<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Mail\ChangeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AccountController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }

    // UPLOAD PROFILE PIC
    public function uploadProfilePic(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [     
                'profileImage'=> ['required', 'image', 'dimensions:ratio=1/1']
            ],
            [
                'dimensions'=>'image must be cropped to a square shape (Ratio 1:1)'
            ]
        );

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()]);
        else:
            $user_id = Auth::user()->id;
            
            $image_ext = $request->file('profileImage')->getClientOriginalExtension();
            $img_name = $user_id.'_profile_pic_'.date('Y-m-d').'_'.time().'.'. $image_ext;


            //SAVE PROFILE IMAGE
            if($path = $request->file('profileImage')->storeAs('public/portal/avatar/'.$user_id, $img_name)):
                //SAVE PROFILE IMAGE DB RECORD
                
                // $user->profile_pic = $img_name;
                if(User::where('id',$user_id)->update(['profile_pic'=> $img_name])):
                        return response()->json(['success'=>'success']);
                endif;
            endif;
        endif;
        return response()->json(['error'=>'error']);
    } 
    // /UPLOAD PROFILE PIC

    // SELECT PROFILE PIC
    public function selectProfilePic(Request $request)
    {
        $user_id = Auth::user()->id;
        $path = $request->path;
        $img_name = str_replace('storage/portal/avatar/'.$user_id.'/','',$path);

        
        if(User::where('id',$user_id)->update(['profile_pic'=> $img_name])):
                return response()->json(['success'=>'success']);
        endif;        
        return response()->json(['error'=>'error']);
    }
    // /SELECT PROFILE PIC

    // UPDATE EMAIL
    public function updateEmail(Request $request)
    {
       
        $validator = Validator::make($request->all(), 
            [     
                'email'=> ['required', 'email', 'unique:users']
            ],
            [
                'unique'=>'Email already in use'
            ]
        );
        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()->all()]);
        else:
            $email =  $request->email;
            $token = Str::random(32);
            $user_id = Auth::user()->id;

            $details = [
                'id' => $user_id,
                'email' => $email,
                'token' => $token
            ];

            if(Mail::to($email)->send(new ChangeEmail($details))):
                return response()->json(['error'=>'error']);
            else:
                if(User::where('id',$user_id)->update(['email_change_token'=> $token,'email_change'=> $email])):
                    return response()->json(['success'=>'success']);
                endif;
            endif;

        endif;
        return response()->json(['error'=>'error']);
    }
    // /UPDATE EMAIL

    // CHANGE EMAIL
    public function verifyEmail($email, $token, $id)
    {
        $user = User::find($id);
        $token_old = $user->email_change_token;
        $email_change = $user->email_change;
        if($token == $token_old && $email == $email_change):
            if(User::where('id',$user->id)->update(['email'=>$email_change, 'email_change_token'=>NULL, 'email_change'=>NULL])):
                return redirect('/email/changed/success');
            endif;
        else:
            return abort(419);
        endif;
        return abort(403);
    }
    // /CHANGE EMAIL

    // CHANGE PASSWORD
    public function changePassword(Request $request)
    {
        if(Hash::check($request->currentPassword, Auth::user()->password)):
            $validator = Validator::make($request->all(), 
                [     
                    'newPassword'=> ['required', 'string', 'min:8', 'different:currentPassword'],
                    'reNewPassword'=> ['required', 'string', 'same:newPassword']
                ],
                [
                    'same'=>'The password must match with re-type password<br>'
                ]
            );
            if($validator->fails()):
                return response()->json(['errors'=>$validator->errors()]);
            else:
                $password = Hash::make($request->newPassword);
                if(User::where('id', Auth::user()->id)->update(['password'=>$password])):
                    return response()->json(['success'=>'success']);
                endif;
            endif;
        else:
            $errors = [
                'currentPassword'=> 'Current Password Does Not Match'
            ];
            return response()->json(['errors'=>$errors]);
        endif;
        return response()->json(['error'=>'error']);
        
    }
    // /CHANGE PASSWORD
}
