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
      'middleNames' => ['nullable', 'alpha_dash_spaces'],
      'lastName' => ['nullable', 'alpha', 'min:3'],
      'fullName' => ['nullable', 'alpha_dash_spaces'],
      'initials' => ['nullable', 'initials'],
      'dob' => ['nullable' , 'date','before:today'],
      'gender' => ['nullable', 'exists:students,gender'],
      // 'citizenship' => ['nullable'],
      //'unique_id' => ['nullable', 'regex:/^[0-9]{12}$/', 'regex:/^[0-9]{9}V$/'],

      //'qualification' => ['required', 'exists:'],

      'house' => ['nullable', 'house_name'],
      'addressLine1' => ['nullable', 'address_line'],
      'addressLine2' => ['nullable', 'address_line'],
      'addressLine3' => ['nullable', 'address_line'],
      'addressLine4' => ['nullable', 'address_line'],
      //'city' => ['nullable', 'exists: world_cities,name'],
      //'selectDistrict' => ['nullable', 'exists: sl_districts,name'],
      //'selectState' => ['nullable', 'exists: world_divisions,name'],
      'country' => ['nullable', 'exists:world_countries,id'],

      'currentHouse' => ['nullable', 'house_name'],
      'currentAddressLine1' => ['nullable', 'address_line'],
      'currentAddressLine2' => ['nullable', 'address_line'],
      'currentAddressLine3' => ['nullable', 'address_line'],
      'currentAddressLine4' => ['nullable', 'address_line'],
      //'currentCity' => ['nullable', 'exists: world_cities,name'],
      //'selectCurrentDistrict' => ['nullable', 'exists: sl_districts,name'],
      //'selectCurrentState' => ['nullable', 'exists: world_divisions,name'],
      'currentCountry' => ['nullable', 'exists: world_countries,name'],

      'telephone' => ['nullable', 'regex:/^0[0-9]{9}$/'],
      //'email' => ['nullable', 'email', 'unique:users'],
      'designation' => ['nullable', 'regex:/^[a-zA-Z\s]*$/', 'min:3'],
    ]);
    
    if($validator->fails()):
        return response()->json(['errors'=>$validator->errors()]);
    else:
        return response()->json(['success'=>'success']);
    endif;
  }
}
