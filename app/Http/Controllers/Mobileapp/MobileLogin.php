<?php

namespace App\Http\Controllers\Mobileapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\User\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

class MobileLogin extends Controller
{

   public function login(Request $request){

        $validator=Validator::make($request->all(),[
              "name"=>"required|name",
              "password"=>"required"

        ]);


      if($validator->failed()){

          return response()->json(['status_code'=>400, 'message'=>"Bad Request", 'islogin'=>false,],400);

      }

       if(!Auth::attempt($request->only('name','password'))){
             return response()->json([
                 'status_code'=>500,
                  'message'=>'Unauthorized',
                  'islogin'=>false,
             ],500);
       }
        $user=User::
       where('name',$request->name)
        ->select(
            'id',
            'name',
             'email',
             'status',
               'role_id',
               'profile_pic'

        )
        ->first();
        $roletype=Role::where('id',$user->role_id)->select(
             'name'
        )->first();
      
            $pro=Storage::url('portal/avatar/'.$user->id.'/'.$user->profile_pic);
        
        Arr::add($user,'rolename',$roletype->name);
        Arr::add($user,'profile',$user->profile_pic!=null ?asset($pro):'');
        if($user->rolename=="Co-Ordinator" || $user->rolename=="Director" ||$user->rolename=="Super Administrator"){
            $token = $user->createToken('user-token',[$user->rolename])->plainTextToken;
        Arr::add($user,'token',$token);
        Arr::add($user,'islogin',true);

        return response()->json($user);

        }
         else{
             return response()->json(
                 [
                     'status_code'=>500,
                     'islogin'=>false,
                     'message'=>'Unauthorized'
                 ],500
                 );
         }


   }
   public function logout(Request $request){
       $user=$request->user();
       $user->currentAccessToken()->delete();
       return response()->json([
           'status'=>200,
            'message'=>"User logout",
            'islogin'=>false,
       ],200);
   }

}
