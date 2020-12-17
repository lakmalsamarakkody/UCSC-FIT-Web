<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Student\Title;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Unique;

class RegistrationController extends Controller
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
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $student_titles = Title::select('title')->get();
    $countries_list = DB::table('world_countries')->orderBy('name')->get();
    return view('portal/student/registration', [
      'student_titles' => $student_titles,
      'countries_list' => $countries_list,
    ]);
  }

  public function saveInfo(Request $request)
  {
    // dd($request->all());
    $validator = Validator::make($request->all(), [            
      // 'email'=> ['required', 'email', 'unique:users'],
      'title' => ['nullable', 'exists:titles,title'],
      'firstName' => ['nullable', 'alpha','min:3'],
      'middleNames' => ['nullable', 'alpha_dash_space'],
      'lastName' => ['nullable', 'alpha', 'min:3'],
      'fullName' => ['nullable', 'alpha_dash_space'],
      'initials' => ['nullable', 'alpha_capital'],
      'dob' => ['nullable' , 'date','before:today'],
      'gender' => ['nullable', 'exists:students,gender'],
      // 'citizenship' => ['nullable'],
      //'nic_old' => ['nullable', 'regex:/^[0-9]{9}[V|v]$/'],
      //'nic_nw' => ['nullable', 'digits:12'],
      //'postal' => ['nullable', 'regex:/^[A-Z]{1}\-[A-Z]{1}[0-6]{6}$/'],
      //'unique_id' => ['nullable', 'regex:/^[A-Z]{1}\-[A-Z]{1}[0-6]{6}$/'],

      //'qualification' => ['required', 'exists:'],

      'house' => ['nullable', 'address'],
      'addressLine1' => ['nullable', 'address'],
      'addressLine2' => ['nullable', 'address'],
      'addressLine3' => ['nullable', 'address'],
      'addressLine4' => ['nullable', 'address'],
      //'city' => ['nullable', 'exists: world_cities,name'],
      //'selectDistrict' => ['nullable', 'exists: sl_districts,name'],
      //'selectState' => ['nullable', 'exists: world_divisions,name'],
      'country' => ['nullable', 'exists:world_countries,id'],

      'currentHouse' => ['nullable', 'address'],
      'currentAddressLine1' => ['nullable', 'address'],
      'currentAddressLine2' => ['nullable', 'address'],
      'currentAddressLine3' => ['nullable', 'address'],
      'currentAddressLine4' => ['nullable', 'address'],
      //'currentCity' => ['nullable', 'exists: world_cities,name'],
      //'selectCurrentDistrict' => ['nullable', 'exists: sl_districts,name'],
      //'selectCurrentState' => ['nullable', 'exists: world_divisions,name'],
      'currentCountry' => ['nullable', 'exists: world_countries,name'],

      'telephone' => ['nullable', 'digits:10'],
      //'email' => ['nullable', 'email', 'unique:users'],
      'designation' => ['nullable', 'regex:/^[a-zA-Z\s]*$/', 'min:3'],
    ]);
    
    if($validator->fails()):
        return response()->json(['errors'=>$validator->errors()]);
    else:
        return response()->json(['success'=>'success']);
    endif;
  }

  public function getCountries(Request $request)
  {
    // validate citizenship
    $validator = Validator::make($request->all(), [
      'citizenship' => ['required', 'alpha_spaces'],
    ]);

    if($validator->fails()):
        return response()->json(['status' => 'error','errors'=>$validator->errors()->all()]);
    else:
      if ( $request->citizenship == 'Sri Lankan' ):
        $countries_list = DB::table('world_countries')->select('id','name')->where('name', 'Sri Lanka')->orderBy('name')->get();
      elseif ( $request->citizenship == 'Foreign National' ):
        $countries_list = DB::table('world_countries')->select('id','name')->where('name', '!=', 'Sri Lanka')->orderBy('name')->get();
      endif;
      return response()->json(['status'=>'success', 'country_list'=>$countries_list ]);
    endif;
  }
}
