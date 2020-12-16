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
      'title' => ['required', 'exists:titles,title'],
      'firstName' => ['required', 'alpha','min:3'],
      'middleNames' => ['required', 'regex:/^[a-zA-Z\s]*$/'],
      'lastName' => ['required', 'alpha', 'min:3'],
      'fullName' => ['required', 'regex:/^[a-zA-Z\s]*$/'],
      'nameInitials' => ['required', 'regex:/^([A-Z]{1}\s)+[a-zA-Z]{3,}$/'],
      'dob' => ['required' , 'date','before:today'],
      'gender' => ['required', 'exists:students,gender'],
      // 'citizenship' => ['required'],
      //'unique_id' => ['required', 'regex:/^[0-9]{12}$/', 'regex:/^[0-9]{9}V$/'],

      //'qualification' => ['required', 'exists:'],

      'house' => ['required', 'regex:/^[a-zA-Z]{2,}\s*[:|.]?[a-zA-Z0-9\s]*$/'],
      'addressLine1' => ['required', 'regex:/^[a-zA-Z0-9\s]*$/'],
      'addressLine2' => ['required', 'regex:/^[a-zA-Z0-9\s]*$/'],
      'addressLine3' => ['required', 'regex:/^[a-zA-Z0-9\s]*$/'],
      'addressLine4' => ['required', 'regex:/^[a-zA-Z0-9\s]*$/'],
      //'city' => ['required', 'exists: world_cities,name'],
      //'selectDistrict' => ['required', 'exists: sl_districts,name'],
      //'selectState' => ['required', 'exists: world_divisions,name'],
      'country' => ['required', 'exists:world_countries,id'],

      'currentHouse' => ['required', 'regex:/^[a-zA-Z]{2,}\s*[:|.]?[a-zA-Z0-9\s]*$/'],
      'currentAddressLine1' => ['required', 'regex:/^[a-zA-Z0-9\s]*$/'],
      'currentAddressLine2' => ['required', 'regex:/^[a-zA-Z0-9\s]*$/'],
      'currentAddressLine3' => ['required', 'regex:/^[a-zA-Z0-9\s]*$/'],
      'currentAddressLine4' => ['required', 'regex:/^[a-zA-Z0-9\s]*$/'],
      //'currentCity' => ['required', 'exists: world_cities,name'],
      //'selectCurrentDistrict' => ['required', 'exists: sl_districts,name'],
      //'selectCurrentState' => ['required', 'exists: world_divisions,name'],
      'currentCountry' => ['required', 'exists: world_countries,name'],

      'telephone' => ['required', 'regex:/^0[0-9]{9}$/'],
      //'email' => ['required', 'email', 'unique:users'],
      'designation' => ['required', 'regex:/^[a-zA-Z\s]*$/', 'min:3'],
    ]);
    
    if($validator->fails()):
        return response()->json(['errors'=>$validator->errors()]);
    else:
        return response()->json(['success'=>'success']);
    endif;
  }
}
