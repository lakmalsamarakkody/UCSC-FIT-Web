<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
                'dimensions'=>'image must be cropped to a square shape (Ratio= 1:1)'
            ]
        );

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()]);
        else:
            $user_id = Auth::user()->id;
            
            $image_ext = $request->file('profileImage')->getClientOriginalExtension();
            $img_name = $user_id.'_profile_pic_'.date('Y-m-d').'_'.time().'.'. $image_ext;


            //SAVE BC FRONT IMAGE
            if($path = $request->file('profileImage')->storeAs('public/portal/avatar/'.$user_id, $img_name)):
                //SAVE BC FRONT IMAGE DB RECORD
                $user = User::find($user_id)->update(['profile_pic'=> $img_name]);
                // $user->profile_pic = $img_name;
                if($user->save()):
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

        $user = User::find($user_id);
        $user = User::find($user_id);
        $user->profile_pic = $img_name;
        if($user->save()):
                return response()->json(['success'=>'success']);
        endif;        
        return response()->json(['error'=>'error']);
    }
    // /SELECT PROFILE PIC
}
