<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use App\Mail\ChangeEmail;
use App\Mail\StaffRegistration;
use App\Models\Email_Token;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\User\Role;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsersController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('revalidate');
      $this->middleware('staff.auth');
  }

  public function index()
  {
    $roles = Role::all();
    return view('portal/staff/users',compact('roles'));
  }

  public function getUserList(Request $request)
  {
    if ($request->ajax()) {
      $data = User::addSelect(['role_name' => Role::select('name')->whereColumn('role_id', 'roles.id')]);
      if($request->name!=null){
        $data = $data->where('name','like', '%'. $request->name.'%');
      }
      if($request->email!=null){
        $data = $data->where('email','like', '%'. $request->email.'%');
      }      
      if($request->role!=null){
        $data = $data->where('role_id', $request->role);
      }
      if($request->status!=null){
        $data = $data->where('status', $request->status);
      }
      if($request->search!=null){
        $data = $data->where('name','like', '%'. $request->search.'%')
        ->orWhere('email','like', '%'. $request->search.'%');
      }
      $data = $data->get();
      return DataTables::of($data)

      ->addIndexColumn()
      ->rawColumns(['action'])
      ->make(true);
    }
  }

  public function viewUser($id)
  {
    $user = User::find($id);
    $roles = Role::all();
    return view('portal/staff/user/profile', compact('user', 'roles'));
  }

  // UPDATE USER ROLE
  public function updateRole(Request $request){

    $validator = Validator::make($request->all(), 
        [     
            'id'=> ['required', 'exists:users'],
            'roleID' => ['required', 'exists:roles,id']
        ]
    );
    if(!$validator->fails()):
        if(User::where('id', $request->id)->update(['role_id' => $request->roleID])):
            return response()->json(['status' => "success"]);
        endif;
    endif;
    return response()->json(['status' => "error"]);
  }

  // UPDATE EMAIL
  public function emailUpdateRequest(Request $request)
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
          $user_id = $request->id;

          $details = [
              'id' => $user_id,
              'email' => $email,
              'token' => $token
          ];

          if(Mail::to($email)->send(new ChangeEmail($details))):
              return response()->json(['error'=>'error']);
          else:
              if(User::where('id',$user_id)->update(['email_change_token'=> $token,'email_change'=> $email])):
                  activity()->withProperties(['student_id' => $request->id, 'email' => $email])->log('Email Change Request');
                  return response()->json(['success'=>'success']);
              endif;
          endif;

      endif;
      return response()->json(['error'=>'error']);
  }
  // /UPDATE EMAIL

  public function deactivateAccount(Request $request)
  {
      $user_id = $request->id;
      $validator = Validator::make($request->all(), 
          [     
              'message'=> ['required']
          ]
      );
      if($validator->fails()):
          return response()->json(['errors'=>$validator->errors()->all()]);
      else:
          if(User::where('id', $user_id)->update(['status' => 0, 'message' => $request->message])):
              return response()->json(['success'=>'success']);
          endif;
      endif;
      return response()->json(['error'=>'error']);
  }

  public function reactivateAccount(Request $request)
  {
      $user_id = $request->id;
      $validator = Validator::make($request->all(), 
          [     
              'message'=> ['required']
          ]
      );
      if($validator->fails()):
          return response()->json(['errors'=>$validator->errors()->all()]);
      else:
          if(User::where('id', $user_id)->update(['status' => 1, 'message' => $request->message])):
              return response()->json(['success'=>'success']);
          endif;
      endif;
      return response()->json(['error'=>'error']);
  }

  public function createUser(Request $request)
  {
    $validator = Validator::make($request->all(), 
        [     
            'userEmail'=> ['required', 'email', 'unique:users,email'],
            'reTypeEmail' => ['required', 'same:userEmail'],
            'userRole' => ['required', 'exists:roles,id']
        ]
    );
    if($validator->fails()):
        return response()->json(['errors'=>$validator->errors()]);
    else:
        $email = $request->userEmail;
        $token = Str::random(64);

        if(Email_Token::where('email', $email)->first()):
            $email_token = Email_Token::where('email', $email)->first();
        else:
            $email_token = new Email_Token();
        endif;
        $email_token->email = $email;
        $email_token->token = $token;
        $email_token->role = $request->userRole;


        $details = [
            'email' => $email_token->email,
            'token' => $email_token->token,
            'role' => $request->userRole
        ];


        

        if(Mail::to($email)->send(new StaffRegistration($details))):
            return response()->json(['error'=>'error']);
        else:
            if($email_token->save()):
                return response()->json(['success'=>'success']);
            endif;
        endif;
    endif;
  }
}
