<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Student\Title;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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

  public function saveInfoValidator(Request $request)
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
      'citizenship' => ['required', 'alpha_space'],
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

  public function getStates(Request $request)
  {
    //Set using country
    if(isset($request->country)):
      // validate country
      $validator = Validator::make($request->all(), [
        'country' => ['required', 'integer', 'exists:world_countries,id'],
      ]);

      if($validator->fails()):
          return response()->json(['status' => 'error','errors'=>$validator->errors()->all()]);
      else:
        if ( $request->country == '67' ):
          $state_type = 'districts';
          $state_list = DB::table('sl_districts')->select('id','name')->orderBy('name')->get();
          $city_list = NULL;
        else:
          $state_type = 'divisions';
          $state_list = DB::table('world_divisions')->select('id','name')->where('country_id', $request->country)->orderBy('name')->get();
          $city_list = DB::table('world_cities')->select('id','name')->where('country_id', $request->country)->orderBy('name')->get();
        endif;
        return response()->json(['status'=>'success', 'state_type'=>$state_type, 'state_list'=>$state_list, 'city_list'=>$city_list]);
      endif;
    //Set using current country
    elseif(isset($request->currentCountry)):
      // validate current country
      $validator = Validator::make($request->all(), [
        'currentCountry' => ['required', 'integer', 'exists:world_countries,id'],
      ]);

      if($validator->fails()):
          return response()->json(['status' => 'error','errors'=>$validator->errors()->all()]);
      else:
        if ( $request->currentCountry == '67' ):
          $state_type = 'districts';
          $state_list = DB::table('sl_districts')->select('id','name')->orderBy('name')->get();
          $city_list = NULL;
        else:
          $state_type = 'divisions';
          $state_list = DB::table('world_divisions')->select('id','name')->where('country_id', $request->currentCountry)->orderBy('name')->get();
          $city_list = DB::table('world_cities')->select('id','name')->where('country_id', $request->currentCountry)->orderBy('name')->get();
        endif;
        return response()->json(['status'=>'success', 'state_type'=>$state_type, 'state_list'=>$state_list, 'city_list'=>$city_list]);
      endif;
    endif;
  }

  public function getCities(Request $request)
  {
    // VALIDATE STATE TYPE
    $validator = Validator::make($request->all(), [
      'stateType' => ['required', Rule::in(['foreignState', 'sriLanka'])],
      'selectState' => ['nullable', 'alpha_num'],
      'selectDistrict' => ['nullable', 'alpha_num'],
    ]);

    if($validator->fails()):
      return response()->json(['status' => 'error','errors'=>$validator->errors()->all(), $request->selectState, $request->selectDistrict]);
    else:
      //GET CITIES
      if ($request->stateType == 'foreignState'):
        $city_list = DB::table('world_cities')->select('id','name')->where('division_id', $request->selectState)->orderBy('name')->get();
      elseif ($request->stateType == 'sriLanka'):
        $city_list = DB::table('sl_cities')->select('id','name')->where('district_id', $request->selectDistrict)->orderBy('name')->get();
      endif;
      return response()->json(['status'=>'success', 'city_list'=>$city_list]);
    endif;
  }
}
