<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InformationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('student.auth');
        $this->middleware('student.info.view');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // GET STUDENT DETAILS
        $student = Student::where('user_id', Auth::user()->id)->first();
        return view('portal/student/information', compact('student'));
    }

    // UPLOAD PROFILE PIC
    public function uploadProfilePic(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [     
            'profileImage'=> ['required', 'image']
        ]);

        if($validator->fails()):
            return response()->json(['errors'=>$validator->errors()]);
        else:
            $user_id = Auth::user()->id;
            
            $image_ext = $request->file('profileImage')->getClientOriginalExtension();
            $img_name = $user_id.'_profile_pic_'.date('Y-m-d').'_'.time().'.'. $image_ext;


            //SAVE BC FRONT IMAGE
            if($path = $request->file('profileImage')->storeAs('public/portal/avatar/'.$user_id, $img_name)):
                //SAVE BC FRONT IMAGE DB RECORD
                $user = User::find($user_id);
                $user->profile_pic = $img_name;
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
