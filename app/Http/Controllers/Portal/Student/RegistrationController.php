<?php

namespace App\Http\Controllers\Portal\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Student\Title;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
      'firstName' => ['required', 'alpha'],
      //'middleNames' => ['required'],
      'lastName' => ['required', 'alpha'],
      // 'fullName' => ['required'],
      // 'nameInitials' => ['required'],
      'dob' => ['required' , 'date','before:today'],
      'gender' => ['required', 'exists:students,gender'],
      // 'citizenship' => ['required'],
      // 'unique_id' => ['required'],

      // 'qualification' => ['required'],

      // 'house' => ['required'],
      // 'addressLine1' => ['required'],
      // 'addressLine2' => ['required'],
      // 'addressLine3' => ['required'],
      // 'addressLine4' => ['required'],
      //'city' => ['required', 'exists: world_cities,name'],
      //'selectDistrict' => ['required', 'exists: sl_districts,name'],
      //'selectState' => ['required', 'exists: world_divisions,name'],
      'country' => ['required', 'exists:world_countries,name'],

      // 'currentHouse' => ['required'],
      // 'currentAddressLine1' => ['required'],
      // 'currentAddressLine2' => ['required'],
      // 'currentAddressLine3' => ['required'],
      // 'currentAddressLine4' => ['required'],
      //'currentCity' => ['required', 'exists: world_cities,name'],
      //'selectCurrentDistrict' => ['required', 'exists: sl_districts,name'],
      //'selectCurrentState' => ['required', 'exists: world_divisions,name'],
      'currentCountry' => ['required', 'exists: world_countries,name'],

      // 'telephone' => ['required'],
      // 'email' => ['required'],
      // 'designation' => ['required'],
    ]);
    
    if($validator->fails()):
        return response()->json(['errors'=>$validator->errors()]);
    else:
        return response()->json(['success'=>'success']);
    endif;
  }
}
